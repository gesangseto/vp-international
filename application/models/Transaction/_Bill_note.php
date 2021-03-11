<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Bill_note extends _Base_Model
{
    public function _custome_query($sql)
    {
        return $this->db->query($sql)->result_array();
    }
    public function _get_bill_note($data)
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
        $sql = 'SELECT a.id AS bill_note_id,a.*,b.*,c.*
        FROM bill_note AS a 
        LEFT JOIN job_order AS b ON a.job_order_id = b.id
        LEFT JOIN list_task AS c ON a.task_id = c.id
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function get_customer($data)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['customer_id']) {
            $where .= "AND a.customer_id = '" . $data['customer_id'] . "'";
        }
        if (@$data['customer_name']) {
            $where .= "AND a.customer_name = '" . $data['customer_name'] . "'";
        }
        if (@$data['customer_phone']) {
            $where .= "AND a.customer_phone = '" . $data['customer_phone'] . "'";
        }
        if (@$data['search']) {
            $where .= "AND (a.customer_name LIKE '" . $data['search'] . "%' )";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT *
        FROM list_customer AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _add_batch_bill_note($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Interna server error';
        $response['data'] = '';
        $query = $this->db->insert_batch('bill_note', $data);
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Success add Bill Note';
            $response['data'] = '';
        }
        return $response;
    }
    public function _update_batch_bill_note($data)
    {
        $response['statusCode'] = 200;
        $response['messages'] = 'Success update bill note';
        $response['data'] = '';
        $id_arr = array();
        foreach ($data as $row) {
            array_push($id_arr, $row['id']);
        }
        echo json_encode($id_arr);
        $this->db->where('invoice_number', $data[0]['invoice_number']);
        $this->db->where_not_in('id', $id_arr);
        $exec = $this->db->delete('bill_note');

        $query =  $this->db->update_batch('bill_note', $data, 'id');
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Success update bill note';
            $response['data'] = '';
        }
        return $response;
    }
    public function _delete_bill_note($data)
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
        $sql = 'DELETE FROM bill_note 
        WHERE id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $response['statusCode'] = 500;
        $response['messages'] = 'Internas server error';
        $response['data'] = '';
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Success delete bill note';
            $response['data'] = '';
        }
        return $response;
    }
}
