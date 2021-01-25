<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Cash_advance extends _Base_Model
{
    public function _custome_query($sql)
    {
        return $this->db->query($sql)->result_array();
    }

    // REQUEST CASH ADVANCE
    public function _get_list_ca($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['order_number']) {
            $where .= "AND a.order_number = '" . $data['order_number'] . "'";
        }
        if (@$data['receipt_no']) {
            $where .= "AND a.receipt_no = '" . $data['receipt_no'] . "'";
        }
        if (@$data['advance_from']) {
            $where .= "AND a.advance_from = '" . $data['advance_from'] . "'";
        }
        if (@$data['container_no']) {
            $where .= "AND a.container_no = '" . $data['container_no'] . "'";
        }
        if (@$data['mbl_no']) {
            $where .= "AND a.mbl_no = '" . $data['mbl_no'] . "'";
        }
        if (@$data['hbl_no']) {
            $where .= "AND a.hbl_no = '" . $data['hbl_no'] . "'";
        }
        if (@$data['shipper']) {
            $where .= "AND a.shipper = '" . $data['shipper'] . "'";
        }
        if (@$data['eta']) {
            $where .= "AND a.eta = '" . $data['eta'] . "'";
        }
        if (@$data['consignee']) {
            $where .= "AND a.consignee = '" . $data['consignee'] . "'";
        }
        if (@$data['status']) {
            $where .= "AND a.status = '" . $data['status'] . "'";
        }
        if (@$data['search']) {
            $where .= "AND (a.advance_from LIKE '%" . $data['search'] . "%'  
            OR a.receipt_no LIKE '%" . $data['search'] . "%' 
            OR a.order_number LIKE '%" . $data['search'] . "%' 
            OR a.ex_vessel LIKE '%" . $data['search'] . "%' 
            OR a.container_no LIKE '%" . $data['search'] . "%' 
            OR a.mbl_no LIKE '%" . $data['search'] . "%' 
            OR a.hbl_no LIKE '%" . $data['search'] . "%' 
            OR a.shipping LIKE '%" . $data['search'] . "%' 
            OR a.eta LIKE '%" . $data['search'] . "%' 
            OR a.consignee LIKE '%" . $data['search'] . "%' 
            OR a.status LIKE '%" . $data['search'] . "%' 
            OR a.request_location LIKE '%" . $data['search'] . "%' 
            )";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT a.*
        FROM list_cash_advanced AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _get_detail_ca($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['cash_advance_id']) {
            $where .= "AND a.cash_advance_id = '" . $data['cash_advance_id'] . "'";
        }
        if (@$data['task_id']) {
            $where .= "AND a.task_id = '" . $data['task_id'] . "'";
        }
        if (@$data['created_by']) {
            $where .= "AND a.created_by = '" . $data['created_by'] . "'";
        }
        if (@$data['updated_by']) {
            $where .= "AND a.updated_by = '" . $data['updated_by'] . "'";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT a.*,b.task_name
        FROM detail_cash_advanced AS a 
        LEFT JOIN list_task AS b ON a.task_id = b.id
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _update_detail_ca_batch($data = null)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Tidak ada perubahan';
        $response['data'] = '';
        if ($this->db->update_batch('detail_cash_advanced', $data, 'id')) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses ubah Cash Advance';
            $response['data'] = '';
        }
        return $response;
    }
    public function _add_list_ca($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['receipt_no']) {
            $where .= " AND a.receipt_no = '" . $data['receipt_no'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM list_cash_advanced AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Receipt No';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('list_cash_advanced', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah Cash Advance';
                $response['data'] = '';
            }
        }
        return $response;
    }


    public function _get_task_by_order_no_for_rca($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= " AND a.id = " . $data['id'];
        }
        if (@$data['search']) {
            $where .= " AND (a.task_name LIKE '%" . $data['search'] . "%' )";
        }
        $sql = 'SELECT a.* FROM list_task AS a
        LEFT JOIN detail_job_order AS b ON a.id = b.task_id
        LEFT JOIN job_order AS c ON b.job_order_id = c.id
        WHERE c.order_number = "' . $data['order_number'] . '" AND a.id NOT IN
        (
            SELECT z.task_id FROM detail_cash_advanced AS z 
            LEFT JOIN list_cash_advanced AS y ON z.cash_advance_id = y.id
            WHERE y.order_number = "' . $data['order_number'] . '"
        ) ' . $where;

        // echo $sql;
        // die;
        $execute = $this->db->query($sql);
        $result = $execute->result_array();
        return $result;
    }

    public function _get_job_order_for_rca($data = null)
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
        AND  CONCAT(b.task_id,a.order_number) NOT IN 
        (SELECT  CONCAT(b.task_id,a.order_number) FROM list_cash_advanced AS a
        LEFT JOIN detail_cash_advanced AS b ON a.id = b.cash_advance_id
         WHERE a.order_number LIKE "' . @$data['order_number'] . '%") GROUP BY a.id';
        $execute = $this->db->query($sql);
        $result = $execute->result_array();
        return $result;
    }

    public function _update_cash_advance($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $this->db->where('id', $data['id']);
        $query = $this->db->update('list_cash_advanced', $data);
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses ubah request Cash Advanced';
            $response['data'] = '';
        }
        return $response;
    }


    public function _add_detail_ca_batch($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $execute = $this->db->insert_batch('detail_cash_advanced', $data);
        if ($execute) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses tambah Cash Advance';
            $response['data'] = '';
        }
        return $response;
    }


    public function _delete_cash_advance($data)
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
        $sql = 'DELETE FROM list_cash_advanced WHERE id IS NOT NULL ' . $where;
        $execute = $this->db->query($sql);
        if ($execute) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses hapus request cash advanced';
            $response['data'] = '';
        }
        return $response;
    }


    public function _delete_detail_cash_advance($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = '';
        if (@$data['id']) {
            $where .= "AND id = '" . $data['id'] . "'";
        }
        if (@$data['cash_advance_id']) {
            $where .= "AND cash_advance_id = '" . $data['cash_advance_id'] . "'";
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
        $sql = 'DELETE FROM detail_cash_advanced WHERE id IS NOT NULL ' . $where;
        $execute = $this->db->query($sql);
        if ($execute) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses hapus request cash advanced';
            $response['data'] = '';
        }
        return $response;
    }
}
