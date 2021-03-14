<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/Base_controller.php");

class Dashboard_ajax extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->load->model('_Dashboard', '_Dashboard');
    }
    public function chart_expense()
    {
        $data['expense'] = $this->_Dashboard->_get_info_expense();
        $this->load->view('dashboard/chart/expense', $data);
    }
}
