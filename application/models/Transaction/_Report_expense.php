<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Report_expense extends _Base_Model
{
    public function _custome_query($sql)
    {
        return $this->db->query($sql)->result_array();
    }
    public function _get_trx_expense($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['month']) {
            $where .= "AND a.month = '" . $data['month'] . "'";
        }
        if (@$data['year']) {
            $where .= "AND a.container_no = '" . $data['year'] . "'";
        }
        if (@$data['total']) {
            $where .= "AND a.total = '" . $data['total'] . "'";
        }
        if (@$data['expense_name']) {
            $where .= "AND b.expense_name = '" . $data['expense_name'] . "'";
        }
        if (@$data['expense_code']) {
            $where .= "AND b.expense_code = '" . $data['expense_code'] . "'";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT *,a.id AS trx_expense_id
        FROM trx_expense AS a 
        LEFT JOIN mst_expense AS b ON a.mst_expense_id = b.id
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _add_trx_expense($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        $query = $this->db->insert('trx_expense', $data);
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses';
            $response['data'] = '';
        }
        return $response;
    }
    public function _update_trx_expense($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $this->db->where('id', $data['id']);
        $query = $this->db->update('trx_expense', $data);
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses';
            $response['data'] = '';
        }
        return $response;
    }

    public function _delete_trx_expense($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = '';
        if ($data['id']) {
            $where .= ' AND id = ' . $data['id'];
            $sql = 'DELETE FROM trx_expense WHERE id IS NOT NULL ' . $where;
            $execute = $this->db->query($sql);
            if ($execute) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses hapus';
                $response['data'] = '';
            }
        }

        return $response;
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
