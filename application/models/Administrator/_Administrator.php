<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Administrator extends _Base_Model
{
    public function _get_user($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['employee_no']) {
            $where .= "AND a.employee_no = '" . $data['employee_no'] . "'";
        }
        if (@$data['position_id']) {
            $where .= "AND a.position_id = '" . $data['position_id'] . "'";
        }
        if (@$data['gender']) {
            $where .= "AND a.gender = '" . $data['gender'] . "'";
        }
        if (@$data['search']) {
            $where .= "AND (a.fullname LIKE '%" . $data['search'] . "%' OR a.member_no='" . $data['search'] . "'  OR a.address='" . $data['search'] . "' OR a.email='" . $data['search'] . "' OR  a.phone_number='" . $data['search'] . "')";
        }
        $sql = 'SELECT a.*,b.position_name
        FROM user AS a 
        LEFT JOIN position AS b ON a.position_id = b.id
        WHERE a.id != 1 ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _count_user($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['unique_code']) {
            $where .= "AND a.unique_code = '" . $data['unique_code'] . "'";
        }
        if (@$data['position_id']) {
            $where .= "AND a.position_id = '" . $data['position_id'] . "'";
        }
        if (@$data['search']) {
            $where .= "AND (a.fullname LIKE '%" . $data['search'] . "%' OR a.member_no='" . $data['search'] . "'  OR a.address='" . $data['search'] . "' OR a.email='" . $data['search'] . "' OR  a.phone_number='" . $data['search'] . "')";
        }
        $sql = 'SELECT COUNT(CASE WHEN gender="Laki-laki" THEN 1 END) AS total_male,COUNT(CASE WHEN gender="Perempuan" THEN 1 END) AS total_female,COUNT(a.id) AS total,COUNT(CASE WHEN DATE(a.expired_date) > NOW() THEN 1 END) AS total_active, COUNT(CASE WHEN DATE(a.expired_date) < NOW() THEN 1 END) AS total_non_active
        FROM user AS a 
        LEFT JOIN position AS b ON a.position_id = b.id
        WHERE a.id != 1 ' . $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function _delete_user($data)
    {
        $query = $this->db->query("DELETE FROM user WHERE id='" . $data['id'] . "'");
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
    public function _get_position($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['position_name']) {
            $where .= "AND a.position_name = '" . $data['position_name'] . "'";
        }
        if (@$data['kode']) {
            $where .= "AND a.kode = '" . $data['kode'] . "'";
        }
        $query = $this->db->query("SELECT * FROM position AS a WHERE a.id IS NOT NULL " . $where);
        $result = $query->result_array();
        return $result;
    }
    public function _add_user($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['employee_no']) {
            $where .= " AND a.employee_no = '" . $data['employee_no'] . "'";
        }
        if (@$data['email']) {
            $where .= " OR a.email = '" . $data['email'] . "'";
        }
        if (@$data['phone_number']) {
            $where .= " OR a.phone_number = '" . $data['phone_number'] . "'";
        }
        $where .= " LIMIT 1";
        $sql = "SELECT * FROM user AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Anggota atau Email atau Nomor telpon';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('user', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah anggota';
                $response['data'] = '';
            }
        }

        return $response;
    }
    public function _update_user($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $where = ' ';
        if (@$data['employee_no']) {
            $where .= " AND a.employee_no = '" . $data['employee_no'] . "'";
        }
        if (@$data['email']) {
            $where .= " OR a.email = '" . $data['email'] . "'";
        }
        if (@$data['phone_number']) {
            $where .= " OR a.phone_number = '" . $data['phone_number'] . "'";
        }
        $where .= " LIMIT 2";
        $sql = "SELECT * FROM user AS a WHERE a.id IS NOT NULL " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 1) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat Nomor Anggota atau Email atau Nomor telpon';
            $response['data'] = '';
        } else {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('user', $data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses update anggota';
                $response['data'] = '';
            }
        }

        return $response;
    }
}
