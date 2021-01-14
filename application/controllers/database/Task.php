<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Task extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Database/_Task', '_Task');
    }
    public function index()
    {
        $data =  $this->_taskFilter();
        $this->load->view('database/task/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        if (!empty($_POST['task_name'])) {
            $value = $_POST;
            $value['created_by'] = $this->session->userdata('id');
            $data['form'] = $value;
            $data['response'] =  $this->_Task->_add_task($value);
        }
        $this->load->view('database/task/create', $data);
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
