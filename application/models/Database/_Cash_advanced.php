<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Cash_advanced extends _Base_Model
{
    public function _get_cash_advanced($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['advance_from']) {
            $where .= "AND a.advance_from = '" . $data['advance_from'] . "'";
        }
        if (@$data['receipt_no']) {
            $where .= "AND a.receipt_no = '" . $data['receipt_no'] . "'";
        }
        if (@$data['order_no']) {
            $where .= "AND a.order_no = '" . $data['order_no'] . "'";
        }
        if (@$data['ex_vessel']) {
            $where .= "AND a.ex_vessel = '" . $data['ex_vessel'] . "'";
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
        if (@$data['shipping']) {
            $where .= "AND a.shipping = '" . $data['shipping'] . "'";
        }
        if (@$data['eta']) {
            $where .= "AND a.eta = '" . $data['eta'] . "'";
        }
        if (@$data['consignee']) {
            $where .= "AND a.consignee = '" . $data['consignee'] . "'";
        }
        if (@$data['status']) {
            $where .= "AND a.shipping = '" . $data['status'] . "'";
        }
        if (@$data['request_location']) {
            $where .= "AND a.request_location = '" . $data['request_location'] . "'";
        }

        if (@$data['search']) {
            $where .= "AND (a.advance_from LIKE '%" . $data['search'] . "%' 
            OR a.receipt_no LIKE '%" . $data['search'] . "%' 
            OR a.order_no LIKE '%" . $data['search'] . "%'  
            OR a.ex_vessel LIKE '%" . $data['search'] . "%' 
            OR a.container_no LIKE '%" . $data['search'] . "%' 
            OR a.mbl_no LIKE '%" . $data['search'] . "%' 
            OR a.hbl_no LIKE '%" . $data['search'] . "%' 
            OR a.shipping LIKE '%" . $data['search'] . "%' 
            OR a.eta LIKE '%" . $data['search'] . "%' 
            OR a.consignee LIKE '%" . $data['search'] . "%' 
            OR a.status LIKE '%" . $data['search'] . "%' 
            OR a.request_location LIKE '%" . $data['search'] . "%')";
        }
        $sql = 'SELECT a.*
        FROM list_cash_advanced AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _delete_customer($data)
    {
        $query = $this->db->query("DELETE FROM list_customer WHERE id='" . $data['id'] . "'");
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
    public function _add_customer($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['customer_id']) {
            $where .= " AND a.customer_id = '" . $data['customer_id'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM list_customer AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor customer';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('list_customer', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah customer';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _update_customer($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['customer_id']) {
            $where .= " AND a.customer_id = '" . $data['customer_id'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM list_customer AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor customer';
            $response['data'] = '';
        } else {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('list_customer', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses update customer';
                $response['data'] = '';
            }
        }

        return $response;
    }
}
