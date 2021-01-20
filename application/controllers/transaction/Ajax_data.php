<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Ajax_data extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
    }
    public function renew_order_number()
    {
        $this->load->model('Transaction/_Job_order', '_Job_order');
        $order_format = $this->tools->order_format();
        $query['other'] = ' AND a.order_number LIKE "' . substr($order_format, 0, -3) . '%" ORDER BY order_number DESC LIMIT 1';
        $result = $this->_Job_order->_get_job_order($query);
        $order_number = '001';
        if (@$result[0]) {
            $order_number = $result[0]['order_number'];
            $order_number = substr($order_number, -3);
            $order_number = $order_number + 1;
            $order_number = str_pad($order_number, 3, "0", STR_PAD_LEFT);
        }
        $order_number = $order_format . "" . $order_number;
        echo $order_number;
    }
    public function get_task()
    {
        $data = [];
        $arr = [];
        if (isset($_POST['text'])) {
            $value['other'] = ' AND task_name LIKE "%' . $_POST['text'] . '%" LIMIT 10';
            $this->load->model('Database/_Task', '_Task');
            $data = $this->_Task->_get_task($value);
            foreach ($data as $row) {
            }
        }
        echo json_encode($data);
    }
    public function get_order_number()
    {
        $data = [];
        $arr = [];
        if (isset($_POST['text'])) {
            $value['other'] = ' AND order_number LIKE "%' . $_POST['text'] . '%" LIMIT 15';
            $this->load->model('transaction/_Job_order', '_Job_order');
            $data = $this->_Job_order->_get_job_order($value);
            foreach ($data as $row) {
            }
        }
        echo json_encode($data);
    }
}
