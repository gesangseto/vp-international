<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Expense extends _Base_Model
{
    public function _get_expense($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['expense_name']) {
            $where .= "AND a.expense_name = '" . $data['expense_name'] . "'";
        }
        if (@$data['expense_code']) {
            $where .= "AND a.expense_code = '" . $data['expense_code'] . "'";
        }
        if (@$data['search']) {
            $where .= "AND (a.id LIKE '%" . $data['search'] . "%' OR a.expense_name LIKE '%" . $data['search'] . "%' OR a.expense_code LIKE '%" . $data['search'] . "%'')";
        }

        if (@$data['other']) {
            $where .= @$data['other'];
        }
        $sql = 'SELECT a.*
        FROM mst_expense AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _delete_expense($data)
    {
        $query = $this->db->query("DELETE FROM mst_expense WHERE id='" . $data['id'] . "'");
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
    public function _add_expense($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['expense_code']) {
            $where .= " AND a.expense_code = '" . $data['expense_code'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM mst_expense AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Kode';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('mst_expense', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _update_expense($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['id']) {
            $where .= " AND a.id = '" . $data['id'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM mst_expense AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 1) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat kode';
            $response['data'] = '';
        } else {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('mst_expense', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses update';
                $response['data'] = '';
            }
        }
        return $response;
    }
}
