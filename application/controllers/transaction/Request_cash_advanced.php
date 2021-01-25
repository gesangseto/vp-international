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
                "eta" => @$_POST['eta'],
                "shipping" => @$_POST['shipping'],
                'consignee' => @$_POST['consignee'],
                'status' => @$_POST['status'],
                'total_ca_idr' => @$_POST['total_ca_idr'],
                'total_ca_usd' => @$_POST['total_ca_usd'],
            );
            $data['response'] = $this->_Cash_advance->_add_list_ca($data['form']);
            if ($data['response']['statusCode'] == 200) {
                $last_id = $this->_Cash_advance->_get_list_ca(array('receipt_no' => $_POST['receipt_no']));
                $last_id = $last_id[0]['id'];
                $n = 0;
                $value_inp = array();
                foreach (@$_POST['task_id'] as $row) {
                    $value_inp[$n]['cash_advance_id'] = $last_id;
                    $value_inp[$n]['task_id'] = $_POST['task_id'][$n];
                    $value_inp[$n]['ca_idr'] = $_POST['ca_idr'][$n];
                    $value_inp[$n]['ca_usd'] = $_POST['ca_usd'][$n];
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
        $data['form']  = $this->_Cash_advance->_get_list_ca($temp);
        $data['form'] = @$data['form'][0];
        $data['form_detail']  = $this->_Cash_advance->_get_detail_ca(array("cash_advance_id" => $data['form']['id']));
        $this->load->view('transaction/request_cash_advanced/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['form']  = $this->_Cash_advance->_get_list_ca($temp);
            $data['form'] = @$data['form'][0];
            $data['form_detail']  = $this->_Cash_advance->_get_detail_ca(array("cash_advance_id" => $data['form']['id']));
        } elseif (!empty($_POST['id'])) {
            $data['form'] = array(
                "id" => @$_POST['id'],
                "advance_from" => @$_POST['advance_from'],
                "receipt_no" => @$_POST['receipt_no'],
                "order_number" => @$_POST['order_number'],
                "ex_vessel" => @$_POST['ex_vessel'],
                "container_no" =>  @$_POST['container_no'],
                "container_no" => @$_POST['container_no'],
                "mbl_no" => @$_POST['mbl_no'],
                "hbl_no" => @$_POST['hbl_no'],
                "shipping" => @$_POST['shipping'],
                "eta" => @$_POST['eta'],
                "consignee" => @$_POST['consignee'],
                "status" => @$_POST['status'],
                'total_ca_idr' => @$_POST['total_ca_idr'],
                'total_ca_usd' => @$_POST['total_ca_usd'],
            );
            $data['response'] = $this->_Cash_advance->_update_cash_advance($data['form']);
            if ($data['response']['statusCode'] == 200) {
                $id = @$_POST['id'];
                $n = 0;
                $value_inp = array();
                foreach (@$_POST['task_id'] as $row) {
                    $value_inp[$n]['id'] = $_POST['id_detail'][$n];
                    $value_inp[$n]['ca_idr'] = $_POST['ca_idr'][$n];
                    $value_inp[$n]['ca_usd'] = $_POST['ca_usd'][$n];
                    $n = $n + 1;
                }
                $data['response'] = $this->_Cash_advance->_update_detail_ca_batch($value_inp);
            }
            $this->session->set_flashdata('response', $data['response']);
            redirect('transaction/request_cash_advanced/update?id=' . $id);
        }
        $this->load->view('transaction/request_cash_advanced/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $this->_Cash_advance->_delete_detail_cash_advance(array('other' => ' AND cash_advance_id=' . $_GET['id']));
            $data['response'] =  $this->_Cash_advance->_delete_cash_advance(array('other' => ' AND id=' . $_GET['id']));
        }
        $this->load->view('transaction/job_order/index', $data);
        $this->load->view('templates/Footer');
    }
}
