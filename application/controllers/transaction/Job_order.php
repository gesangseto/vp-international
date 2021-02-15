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
        $this->load->view('transaction/job_order/index');
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
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
        if (isset($_POST['submit']) && $_POST['task_id']) {
            $data['form'] = array(
                "order_number" => @$_POST['order_number'],
                "shipping_name" => @$_POST['shipping_name'],
                "consignee" => @$_POST['consignee'],
                "vessel" => @$_POST['vessel'],
                "shipper" =>  @$_POST['shipper'],
                "container_no" => @$_POST['container_no'],
                "party" => @$_POST['party'],
                "mbl_no" => @$_POST['mbl_no'],
                "hbl_no" => @$_POST['hbl_no'],
                "invoice" => @$_POST['invoice'],
                "date" => @$_POST['date'],
                "etd" => @$_POST['etd'],
                "eta" => @$_POST['eta'],
                "pol" => @$_POST['pol'],
                "pod" => @$_POST['pod'],
                "address" => @$_POST['address'],
                "freight" => @$_POST['freight'],
                'total_buying_idr' => @$_POST['total_buying_idr'],
                'total_buying_usd' => @$_POST['total_buying_usd'],
                'total_selling_idr' => @$_POST['total_selling_idr'],
                'total_selling_usd' => @$_POST['total_selling_usd'],
                'total_profit_idr' => @$_POST['total_profit_idr'],
                'total_profit_usd' => @$_POST['total_profit_usd']
            );
            $data['response'] = $this->_Job_order->_add_job_order($data['form']);
            if ($data['response']['statusCode'] == 200) {
                $last_id = $this->_Job_order->_get_job_order(array('order_number' => $_POST['order_number']));
                $last_id = $last_id[0]['id'];

                $n = 0;
                $value_inp = array();
                foreach (@$_POST['task_id'] as $row) {
                    $value_inp[$n]['job_order_id'] = $last_id;
                    $value_inp[$n]['task_id'] = $_POST['task_id'][$n];
                    $value_inp[$n]['buying_idr'] = $_POST['buying_idr'][$n];
                    $value_inp[$n]['buying_usd'] = $_POST['buying_usd'][$n];
                    $value_inp[$n]['selling_idr'] = $_POST['selling_idr'][$n];
                    $value_inp[$n]['selling_usd'] = $_POST['selling_usd'][$n];
                    $value_inp[$n]['profit_idr'] = $_POST['profit_idr'][$n];
                    $value_inp[$n]['profit_usd'] = $_POST['profit_usd'][$n];
                    $n = $n + 1;
                }
                $data['response'] = $this->_Job_order->_add_detail_job_order_batch($value_inp);
            }
        }
        $data['form']['order_number'] = $order_format . "" . $order_number;
        $this->load->view('transaction/job_order/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $temp['id'] = $_GET['id'];
        $data['form']  = $this->_Job_order->_get_job_order($temp);
        $data['form'] = @$data['form'][0];
        $data['form_detail']  = $this->_Job_order->_get_detail_job_order(array("job_order_id" => $data['form']['id']));
        $this->load->view('transaction/job_order/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['form']  = $this->_Job_order->_get_job_order($temp);
            $data['form'] = @$data['form'][0];
            $data['form_detail']  = $this->_Job_order->_get_detail_job_order(array("job_order_id" => $data['form']['id']));
        } elseif (!empty($_POST['id'])) {
            $data['form'] = array(
                "id" => @$_POST['id'],
                "order_number" => @$_POST['order_number'],
                "shipping_name" => @$_POST['shipping_name'],
                "consignee" => @$_POST['consignee'],
                "vessel" => @$_POST['vessel'],
                "shipper" =>  @$_POST['shipper'],
                "container_no" => @$_POST['container_no'],
                "party" => @$_POST['party'],
                "mbl_no" => @$_POST['mbl_no'],
                "hbl_no" => @$_POST['hbl_no'],
                "invoice" => @$_POST['invoice'],
                "date" => @$_POST['date'],
                "etd" => @$_POST['etd'],
                "eta" => @$_POST['eta'],
                "pol" => @$_POST['pol'],
                "pod" => @$_POST['pod'],
                "address" => @$_POST['address'],
                "freight" => @$_POST['freight'],
                'total_buying_idr' => @$_POST['total_buying_idr'],
                'total_buying_usd' => @$_POST['total_buying_usd'],
                'total_selling_idr' => @$_POST['total_selling_idr'],
                'total_selling_usd' => @$_POST['total_selling_usd'],
                'total_profit_idr' => @$_POST['total_profit_idr'],
                'total_profit_usd' => @$_POST['total_profit_usd']
            );
            $data['response'] = $this->_Job_order->_update_job_order($data['form']);
            if ($data['response']['statusCode'] == 200) {
                $job_order_id = @$_POST['id'];
                $n = 0;
                $value_inp = array();
                foreach (@$_POST['task_id'] as $row) {
                    $value_inp[$n]['job_order_id'] = $job_order_id;
                    $value_inp[$n]['task_id'] = $_POST['task_id'][$n];
                    $value_inp[$n]['buying_idr'] = $_POST['buying_idr'][$n];
                    $value_inp[$n]['buying_usd'] = $_POST['buying_usd'][$n];
                    $value_inp[$n]['selling_idr'] = $_POST['selling_idr'][$n];
                    $value_inp[$n]['selling_usd'] = $_POST['selling_usd'][$n];
                    $value_inp[$n]['profit_idr'] = $_POST['profit_idr'][$n];
                    $value_inp[$n]['profit_usd'] = $_POST['profit_usd'][$n];
                    $n = $n + 1;
                }
                $this->_Job_order->_delete_detail_job_order(array('other' => ' AND job_order_id=' . $job_order_id));
                $data['response'] = $this->_Job_order->_add_detail_job_order_batch($value_inp);
            }
            $this->session->set_flashdata('response', $data['response']);
            redirect('transaction/job_order/update?id=' . $job_order_id);
        }
        $this->load->view('transaction/job_order/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $this->_Job_order->_delete_detail_job_order(array('other' => ' AND job_order_id=' . $_GET['id']));
            $data['response'] =  $this->_Job_order->_delete_job_order(array('other' => ' AND id=' . $_GET['id']));
        }
        $this->load->view('transaction/job_order/index', $data);
        $this->load->view('templates/Footer');
    }
}
