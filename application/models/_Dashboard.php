<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/_Base_Model.php");

class _Dashboard extends _Base_Model
{
    public function _count_agent($data = null)
    {
        return  $this->db->count_all('list_agent');;
    }
    public function _count_customer($data = null)
    {
        return  $this->db->count_all('list_customer');;
    }
    public function _count_user($data = null)
    {
        return  $this->db->count_all('user');;
    }
    public function _count_port($data = null)
    {
        return  $this->db->count_all('list_port');;
    }
    public function _get_info_expense($data = null)
    {
        $query = $this->db->query('Select a.year_month,SUM(a.total) AS total FROM trx_expense AS a
        GROUP BY a.year_month');
        return  $query->result_array();
    }
}
