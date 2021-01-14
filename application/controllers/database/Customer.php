<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Customer extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Database/_Customer', '_Customer');
    }
    public function index()
    {
        $data =  $this->_customerFilter();
        $this->load->view('database/customer/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        if (!empty($_POST['customer_id'])) {
            $value = $_POST;
            $value['created_by'] = $this->session->userdata('id');
            $data['form'] = $value;
            $data['response'] =  $this->_Customer->_add_customer($value);
        }
        $this->load->view('database/customer/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $temp['id'] = $_GET['id'];
        $data['form'] =  $this->_Customer->_get_customer($temp);
        $data['form'] = @$data['form'][0];
        $this->load->view('database/customer/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $value =  $_GET;
            $data['form'] =  $this->_Customer->_get_customer($value);
            $data['form'] =  $data['form'][0];
        } elseif (!empty($_POST['id'])) {
            $temp['id'] = $_POST['id'];
            $value =  $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Customer->_update_customer($value);
        }
        $this->load->view('database/customer/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['response'] =  $this->_Customer->_delete_customer($temp);
        }
        $this->load->view('administrator/user/index', $data);
        $this->load->view('templates/Footer');
    }
}
