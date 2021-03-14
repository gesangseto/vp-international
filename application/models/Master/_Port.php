<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Port extends _Base_Model
{
    public function _get_port($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['port_id']) {
            $where .= "AND a.port_id = '" . $data['port_id'] . "'";
        }
        if (@$data['port_name']) {
            $where .= "AND a.port_name = '" . $data['port_name'] . "'";
        }
        if (@$data['port_phone']) {
            $where .= "AND a.port_phone = '" . $data['port_phone'] . "'";
        }
        if (@$data['port_address']) {
            $where .= "AND a.port_address = '" . $data['port_address'] . "'";
        }
        if (@$data['port_country']) {
            $where .= "AND a.port_country = '" . $data['port_country'] . "'";
        }
        if (@$data['port_postal_code']) {
            $where .= "AND a.port_postal_code = '" . $data['port_postal_code'] . "'";
        }

        if (@$data['search']) {
            $where .= "AND (a.port_id LIKE '%" . $data['search'] . "%' OR a.port_name LIKE '%" . $data['search'] . "%' OR a.port_phone LIKE '%" . $data['search'] . "%'  OR a.port_address LIKE '%" . $data['search'] . "%' OR a.port_country LIKE '%" . $data['search'] . "%' OR  a.port_postal_code LIKE '%" . $data['search'] . "%')";
        }
        $sql = 'SELECT a.*
        FROM list_port AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _delete_port($data)
    {
        $query = $this->db->query("DELETE FROM list_port WHERE id='" . $data['id'] . "'");
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'sukses';
            $response['data'] = '';
        }
        return $response;
    }
    public function _add_port($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['port_id']) {
            $where .= " AND a.port_id = '" . $data['port_id'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM list_port AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Port';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('list_port', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah port';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _update_port($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['port_code']) {
            $where .= " AND a.port_code = '" . $data['port_code'] . "'";
        }
        if (@$data['port_country_code']) {
            $where .= " OR a.port_country_code = '" . $data['port_country_code'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM list_port AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 1) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Port';
            $response['data'] = '';
        } else {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('list_port', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses update port';
                $response['data'] = '';
            }
        }

        return $response;
    }
}
