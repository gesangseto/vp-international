<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Agent extends _Base_Model
{
    public function _get_agent($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['agent_id']) {
            $where .= "AND a.agent_id = '" . $data['agent_id'] . "'";
        }
        if (@$data['agent_name']) {
            $where .= "AND a.agent_name = '" . $data['agent_name'] . "'";
        }
        if (@$data['agent_phone']) {
            $where .= "AND a.agent_phone = '" . $data['agent_phone'] . "'";
        }
        if (@$data['agent_address']) {
            $where .= "AND a.agent_address = '" . $data['agent_address'] . "'";
        }
        if (@$data['agent_country']) {
            $where .= "AND a.agent_country = '" . $data['agent_country'] . "'";
        }
        if (@$data['agent_postal_code']) {
            $where .= "AND a.agent_postal_code = '" . $data['agent_postal_code'] . "'";
        }

        if (@$data['search']) {
            $where .= "AND (a.agent_id LIKE '%" . $data['search'] . "%' OR a.agent_name LIKE '%" . $data['search'] . "%' OR a.agent_phone LIKE '%" . $data['search'] . "%'  OR a.agent_address LIKE '%" . $data['search'] . "%' OR a.agent_country LIKE '%" . $data['search'] . "%' OR  a.agent_postal_code LIKE '%" . $data['search'] . "%')";
        }
        $sql = 'SELECT a.*
        FROM list_agent AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _delete_agent($data)
    {
        $query = $this->db->query("DELETE FROM list_agent WHERE id='" . $data['id'] . "'");
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
    public function _add_agent($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['agent_id']) {
            $where .= " AND a.agent_id = '" . $data['agent_id'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM list_agent AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Agent';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('list_agent', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah agent';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _update_agent($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['agent_id']) {
            $where .= " AND a.agent_id = '" . $data['agent_id'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM list_agent AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Agent';
            $response['data'] = '';
        } else {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('list_agent', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses update agent';
                $response['data'] = '';
            }
        }

        return $response;
    }
}
