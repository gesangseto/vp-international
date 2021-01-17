<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Task extends _Base_Model
{
    public function _get_task($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['task_name']) {
            $where .= "AND a.task_name = '" . $data['task_name'] . "'";
        }
        if (@$data['task_phone']) {
            $where .= "AND a.task_phone = '" . $data['task_phone'] . "'";
        }
        if (@$data['task_country']) {
            $where .= "AND a.task_country = '" . $data['task_country'] . "'";
        }
        if (@$data['task_postal_code']) {
            $where .= "AND a.task_postal_code = '" . $data['task_postal_code'] . "'";
        }

        if (@$data['search']) {
            $where .= "AND (a.id LIKE '%" . $data['search'] . "%' OR a.task_name LIKE '%" . $data['search'] . "%' OR a.task_phone LIKE '%" . $data['search'] . "%'  OR a.task_address LIKE '%" . $data['search'] . "%' OR a.task_country LIKE '%" . $data['search'] . "%' OR  a.task_postal_code LIKE '%" . $data['search'] . "%')";
        }

        if (@$data['other']) {
            $where .= @$data['other'];
        }
        $sql = 'SELECT a.*
        FROM list_task AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _delete_task($data)
    {
        $query = $this->db->query("DELETE FROM list_task WHERE id='" . $data['id'] . "'");
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
    public function _add_task($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['task_name']) {
            $where .= " AND a.task_name = '" . $data['task_name'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM list_task AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor task';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('list_task', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah task';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _update_task($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['id']) {
            $where .= " AND a.id = '" . $data['id'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM list_task AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor task';
            $response['data'] = '';
        } else {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('list_task', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses update task';
                $response['data'] = '';
            }
        }
        return $response;
    }
}
