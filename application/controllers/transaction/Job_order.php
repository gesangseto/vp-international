<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Job_order extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Transaction/_Job_order', '_Job_order');
    }
    public function index()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Administrator->_get_job_order($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter', $data);
        $this->load->view('transaction/job_order/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        $order_format = $this->tools->order_format();
        $query['other'] = ' AND a.order_number LIKE "' . $order_format . '%" ORDER BY order_number DESC LIMIT 1';
        $result = $this->_Job_order->_get_job_order($query);
        $order_number = '001';
        if (@$result[0]) {
            $order_number = $result[0]['order_number'];
            $order_number = substr($order_number, -3);
            $order_number = $order_number + 1;
            $order_number = str_pad($order_number, 3, "0", STR_PAD_LEFT);
        }
        $data['form']['order_number'] = $order_format . "" . $order_number;
        $this->load->view('transaction/job_order/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $temp['id'] = $_GET['id'];
        $data['form'] =  $this->_Task->_get_task($temp);
        $data['form'] = @$data['form'][0];
        $this->load->view('database/task/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $value =  $_GET;
            $data['form'] =  $this->_Task->_get_task($value);
            $data['form'] =  $data['form'][0];
        } elseif (!empty($_POST['id'])) {
            $temp['id'] = $_POST['id'];
            $value =  $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Task->_update_task($value);
        }
        $this->load->view('database/task/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['response'] =  $this->_Task->_delete_task($temp);
        }
        $this->load->view('administrator/user/index', $data);
        $this->load->view('templates/Footer');
    }
}
