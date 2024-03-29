<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Invoice extends _Base_Model
{
    public function _custome_query($sql)
    {
        return $this->db->query($sql)->result_array();
    }
    public function _get_invoice($data)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['invoice_number']) {
            $where .= "AND a.invoice_number = '" . $data['invoice_number'] . "'";
        }
        if (@$data['invoice_date']) {
            $where .= "AND a.invoice_date = '" . $data['invoice_date'] . "'";
        }
        if (@$data['shipment_type']) {
            $where .= "AND a.shipment_type = '" . $data['shipment_type'] . "'";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT a.id AS invoice_id,a.*,b.*,c.*
        FROM invoice AS a 
        LEFT JOIN job_order AS b ON a.job_order_id = b.id
        LEFT JOIN list_task AS c ON a.task_id = c.id
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
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
    public function _update_batch_invoice($data)
    {
        $response['statusCode'] = 200;
        $response['messages'] = 'Success update invoice';
        $response['data'] = '';
        $id_arr = array();
        foreach ($data as $row) {
            array_push($id_arr, $row['id']);
        }
        echo json_encode($id_arr);
        $this->db->where('invoice_number', $data[0]['invoice_number']);
        $this->db->where_not_in('id', $id_arr);
        $exec = $this->db->delete('invoice');

        $query =  $this->db->update_batch('invoice', $data, 'id');
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Success update invoice';
            $response['data'] = '';
        }
        return $response;
    }
    public function _delete_invoice($data)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= " AND id = '" . $data['id'] . "'";
        }
        if (@$data['invoice_number']) {
            $where .= " AND invoice_number = '" . $data['invoice_number'] . "'";
        }
        if (@$data['invoice_date']) {
            $where .= " AND invoice_date = '" . $data['invoice_date'] . "'";
        }
        if (@$data['shipment_type']) {
            $where .= " AND shipment_type = '" . $data['shipment_type'] . "'";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'DELETE FROM invoice 
        WHERE id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $response['statusCode'] = 500;
        $response['messages'] = 'Interna server error';
        $response['data'] = '';
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Success delete invoice';
            $response['data'] = '';
        }
        return $response;
    }
}
