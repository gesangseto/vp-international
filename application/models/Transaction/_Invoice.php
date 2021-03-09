<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Invoice extends _Base_Model
{
    public function _custome_query($sql)
    {
        return $this->db->query($sql)->result_array();
    }
    public function _get_agent($data)
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
        if (@$data['search']) {
            $where .= "AND (a.agent_name LIKE '" . $data['search'] . "%' )";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT *
        FROM list_agent AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _add_batch_invoice($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Interna server error';
        $response['data'] = '';
        $query = $this->db->insert_batch('invoice', $data);
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Success add invoice';
            $response['data'] = '';
        }
        return $response;
    }
}
