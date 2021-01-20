<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Request_cash_advanced extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Transaction/_Cash_advance', '_Cash_advance');
    }
    public function index()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Cash_advance->_get_list_ca($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter', $data);
        $this->load->view('transaction/request_cash_advanced/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        if (isset($_POST['submit']) && $_POST['task_id']) {
            $data['form'] = array(
                "advance_from" => @$_POST['advance_from'],
                "receipt_no" => @$_POST['receipt_no'],
                "order_number" => @$_POST['order_number'],
                "ex_vessel" => @$_POST['ex_vessel'],
                "container_no" => @$_POST['container_no'],
                "mbl_no" => @$_POST['mbl_no'],
                "hbl_no" => @$_POST['hbl_no'],
                "shipping" => @$_POST['shipping'],
                'consignee' => @$_POST['consignee'],
                'status' => @$_POST['status'],
                'total_ca_idr' => @$_POST['total_ca_idr'],
                'total_ca_usd' => @$_POST['total_ca_usd'],
                'total_actual_idr' => @$_POST['total_actual_idr'],
                'total_actual_usd' => @$_POST['total_actual_usd']
            );
            $data['response'] = $this->_Cash_advance->_add_list_ca($data['form']);
            if ($data['response']['statusCode'] == 200) {
                $last_id = $this->_Cash_advance->_get_list_ca(array('receipt_no' => $_POST['receipt_no']));
                $last_id = $last_id[0]['id'];
                $n = 0;
                $value_inp = array();
                foreach (@$_POST['task_id'] as $row) {
                    $value_inp[$n]['job_order_id'] = $last_id;
                    $value_inp[$n]['task_id'] = $_POST['task_id'][$n];
                    $value_inp[$n]['ca_idr'] = $_POST['ca_idr'][$n];
                    $value_inp[$n]['ca_usd'] = $_POST['ca_usd'][$n];
                    $value_inp[$n]['actual_idr'] = $_POST['actual_idr'][$n];
                    $value_inp[$n]['actual_usd'] = $_POST['actual_usd'][$n];
                    $n = $n + 1;
                }
                $data['response'] = $this->_Cash_advance->_add_detail_ca_batch($value_inp);
            }
        }
        $this->load->view('transaction/request_cash_advanced/create', $data);
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
