<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Position extends _Base_Model
{
    public function _get_position($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['position_name']) {
            $where .= "AND a.position_name = '" . $data['position_name'] . "'";
        }
        if (@$data['kode']) {
            $where .= "AND a.kode = '" . $data['kode'] . "'";
        }
        $query = $this->db->query("SELECT * FROM position AS a WHERE a.id IS NOT NULL " . $where);
        $result = $query->result_array();
        return $result;
    }
    public function _add_position($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['position_name']) {
            $where .= " AND a.position_name = '" . $data['position_name'] . "'";
        }
        if (@$data['kode']) {
            $where .= " OR a.kode = '" . $data['kode'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM position AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nama Posisi atau Kode Posisi';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('position', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah posisi';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _update_position($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['position_name']) {
            $where .= " AND a.position_name = '" . $data['position_name'] . "'";
        }
        if (@$data['kode']) {
            $where .= " OR a.kode = '" . $data['kode'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM position AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 1) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nama Posisi atau Kode Posisi';
            $response['data'] = '';
        } else {
            $this->db->where('id', @$data['id']);
            $query = $this->db->update('position', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses ubah posisi';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _delete_position($data)
    {
        $query = $this->db->query("DELETE FROM position WHERE id='" . $data['id'] . "'");
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        if ($query) {
            $query = $this->db->query("DELETE FROM uac_permission WHERE position_id='" . $data['id'] . "'");
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'sukses';
                $response['data'] = '';
            }
        }
        return $response;
    }
}
