<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Customer extends _Base_Model
{
    public function _get_customer($data = null)
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
        if (@$data['customer_country']) {
            $where .= "AND a.customer_country = '" . $data['customer_country'] . "'";
        }
        if (@$data['customer_postal_code']) {
            $where .= "AND a.customer_postal_code = '" . $data['customer_postal_code'] . "'";
        }

        if (@$data['search']) {
            $where .= "AND (a.customer_id LIKE '%" . $data['search'] . "%' OR a.customer_name LIKE '%" . $data['search'] . "%' OR a.customer_phone LIKE '%" . $data['search'] . "%'  OR a.customer_address LIKE '%" . $data['search'] . "%' OR a.customer_country LIKE '%" . $data['search'] . "%' OR  a.customer_postal_code LIKE '%" . $data['search'] . "%')";
        }
        $sql = 'SELECT a.*
        FROM list_customer AS a 
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
