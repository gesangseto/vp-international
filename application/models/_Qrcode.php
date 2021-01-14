<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/_Base_Model.php");

class _Qrcode extends _Base_Model
{
    public function _get_user($data = null)
    {
        $where = " AND a.unique_code = '" . $data['unique_code'] . "'";
        $query = $this->db->query("SELECT * FROM user AS a WHERE a.id IS NOT NULL" . $where);
        // $query = $this->db->query("SELECT * FROM user AS a WHERE a.id IS NOT NULL" . $where);
        $result = $query->result_array();
        return $result;
    }
    public function _get_province($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['name']) {
            $where .= "AND a.name = '" . $data['name'] . "'";
        }
        $query = $this->db->query("SELECT * FROM province AS a WHERE a.id IS NOT NULL " . $where);
        $result = $query->result_array();
        return $result;
    }
    public function _get_regency($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['province_id']) {
            $where .= "AND a.province_id = '" . $data['province_id'] . "'";
        }
        if (@$data['name']) {
            $where .= "AND a.name = '" . $data['name'] . "'";
        }
        $query = $this->db->query("SELECT * FROM regency AS a WHERE a.id IS NOT NULL " . $where);
        $result = $query->result_array();
        return $result;
    }
    public function _get_district($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['regency_id']) {
            $where .= "AND a.regency_id = '" . $data['regency_id'] . "'";
        }
        if (@$data['name']) {
            $where .= "AND a.name = '" . $data['name'] . "'";
        }
        $query = $this->db->query("SELECT * FROM district AS a WHERE a.id IS NOT NULL " . $where);
        $result = $query->result_array();
        return $result;
    }
    public function _get_village($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['district_id']) {
            $where .= "AND a.district_id = '" . $data['district_id'] . "'";
        }
        if (@$data['name']) {
            $where .= "AND a.name = '" . $data['name'] . "'";
        }
        $query = $this->db->query("SELECT * FROM village AS a WHERE a.id IS NOT NULL " . $where);
        $result = $query->result_array();
        return $result;
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
}
