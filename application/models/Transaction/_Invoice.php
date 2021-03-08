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
    public function _get_job_order_by_job_sheets_id($data)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['job_order_id']) {
            $where .= "AND a.job_order_id = '" . $data['job_order_id'] . "'";
        }
        if (@$data['job_sheets_id']) {
            $where .= "AND a.job_sheets_id = '" . $data['job_sheets_id'] . "'";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT b.*
        FROM detail_job_sheets AS a 
        LEFT JOIN job_order AS b ON a.job_order_id = b.id
        WHERE a.id IS NOT NULL ' . $where . ' GROUP BY b.id';
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _delete_job_sheet($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = '';
        if (@$data['id']) {
            $where .= "AND id = '" . $data['id'] . "'";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        if (!$where) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Id cannot be null';
            $response['data'] = '';
            return $response;
        }
        $sql = 'DELETE FROM detail_job_sheets WHERE id IS NOT NULL ' . $where;
        $execute = $this->db->query($sql);
        if ($execute) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses hapus job sheet';
            $response['data'] = '';
        }
        return $response;
    }

    public function _get_job_order_for_job_sheet($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= " AND a.id = " . $data['id'];
        }
        if (@$data['search']) {
            $where .= " AND (a.task_name LIKE '%" . $data['search'] . "%' )";
        }
        if (@$data['other']) {
            $where .=  $data['other'];
        }
        $sql = 'SELECT * FROM job_order AS a 
        LEFT JOIN detail_job_order AS b ON a.id = b.job_order_id
        WHERE a.order_number LIKE "' . @$data['order_number'] . '%" 
        AND  a.order_number NOT IN 
        (SELECT  y.order_number FROM detail_job_sheets AS z
        LEFT JOIN job_order AS y ON z.job_order_id = y.id
         WHERE y.order_number LIKE "' . @$data['order_number'] . '%" ) 
         GROUP BY a.id';
        $execute = $this->db->query($sql);
        $result = $execute->result_array();
        return $result;
    }
}
