<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Agent extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Database/_Agent', '_Agent');
    }
    public function index()
    {
        $data =  $this->_agentFilter();
        $this->load->view('database/agent/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        if (!empty($_POST['agent_id'])) {
            $value = $_POST;
            $value['created_by'] = $this->session->userdata('id');
            $data['form'] = $value;
            $data['response'] =  $this->_Agent->_add_agent($value);
        }
        $this->load->view('database/agent/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $temp['id'] = $_GET['id'];
        $data['form'] =  $this->_Agent->_get_agent($temp);
        $data['form'] = @$data['form'][0];
        $this->load->view('database/agent/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $value =  $_GET;
            $data['form'] =  $this->_Agent->_get_agent($value);
            $data['form'] =  $data['form'][0];
        } elseif (!empty($_POST['id'])) {
            $temp['id'] = $_POST['id'];
            $value =  $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Agent->_update_agent($value);
        }
        $this->load->view('database/agent/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['response'] =  $this->_Agent->_delete_agent($temp);
        }
        $this->load->view('administrator/user/index', $data);
        $this->load->view('templates/Footer');
    }
}
