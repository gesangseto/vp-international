<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Port extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Master/_Port', '_Port');
    }
    public function index()
    {
        $this->load->view('master/port/index');
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        if (!empty($_POST['port_code'])) {
            $value = $_POST;
            $value['created_by'] = $this->session->userdata('id');
            $data['form'] = $value;
            $data['response'] =  $this->_Port->_add_port($value);
        }
        $this->load->view('master/port/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $temp['id'] = $_GET['id'];
        $data['form'] =  $this->_Port->_get_port($temp);
        $data['form'] = @$data['form'][0];
        $this->load->view('master/port/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $value =  $_GET;
            $data['form'] =  $this->_Port->_get_port($value);
            $data['form'] =  $data['form'][0];
        } elseif (!empty($_POST['id'])) {
            $temp['id'] = $_POST['id'];
            $value =  $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Port->_update_port($value);
        }
        $this->load->view('master/port/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['response'] =  $this->_Port->_delete_port($temp);
        }
        $this->load->view('administrator/user/index', $data);
        $this->load->view('templates/Footer');
    }
}
