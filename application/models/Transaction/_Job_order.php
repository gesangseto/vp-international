<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Job_order extends _Base_Model
{
    public function _custome_query($sql)
    {
        return $this->db->query($sql)->result_array();
    }
    public function _get_job_order($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['order_number']) {
            $where .= "AND a.order_number = '" . $data['order_number'] . "'";
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
        if (@$data['search']) {
            $where .= "AND (a.order_number LIKE '%" . $data['search'] . "%'  
            OR a.container_no LIKE '%" . $data['search'] . "%' 
            OR a.mbl_no LIKE '%" . $data['search'] . "%' 
            OR a.hbl_no LIKE '%" . $data['search'] . "%' 
            OR a.shipper LIKE '%" . $data['search'] . "%' 
            OR a.eta LIKE '%" . $data['search'] . "%' 
            OR a.consignee LIKE '%" . $data['search'] . "%' 
            )";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT a.*
        FROM job_order AS a 
        WHERE a.id IS NOT NULL ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _add_job_order($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['order_number']) {
            $where .= " AND a.order_number = '" . $data['order_number'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM job_order AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Order';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('job_order', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah Job Order';
                $response['data'] = '';
            }
        }
        return $response;
    }
    public function _update_job_order($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['order_number']) {
            $where .= " AND a.order_number = '" . $data['order_number'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM job_order AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 1) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Order';
            $response['data'] = '';
        } else {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('job_order', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses ubah Job Order';
                $response['data'] = '';
            }
        }
        return $response;
    }


    public function _add_detail_job_order_batch($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $execute = $this->db->insert_batch('detail_job_order', $data);
        if ($execute) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses tambah job order';
            $response['data'] = '';
        }
        return $response;
    }
    public function _delete_job_order($data)
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
        $sql = 'DELETE FROM job_order WHERE id IS NOT NULL ' . $where;
        $execute = $this->db->query($sql);
        if ($execute) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses hapus job order';
            $response['data'] = '';
        }
        return $response;
    }
    public function _delete_detail_job_order($data)
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
        $sql = 'DELETE FROM detail_job_order WHERE id IS NOT NULL ' . $where;
        $execute = $this->db->query($sql);
        if ($execute) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses hapus job order';
            $response['data'] = '';
        }
        return $response;
    }



    public function _get_detail_job_order($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['job_order_id']) {
            $where .= "AND a.job_order_id = '" . $data['job_order_id'] . "'";
        }
        if (@$data['task_id']) {
            $where .= "AND a.task_id = '" . $data['task_id'] . "'";
        }
        if (@$data['search']) {
            $where .= "AND (a.job_order_id LIKE '%" . $data['search'] . "%'  
            )";
        }
        if (@$data['other']) {
            $where .= $data['other'];
        }
        $sql = 'SELECT a.*,b.task_name
        FROM detail_job_order AS a 
        LEFT JOIN list_task AS b ON a.task_id = b.id
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
