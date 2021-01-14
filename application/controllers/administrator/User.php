<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class User extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Administrator/_Administrator', '_Administrator');
    }
    public function index()
    {
        $data =  $this->_userFilter();
        $this->load->view('administrator/user/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        $data['position'] = $this->_Administrator->_get_position();
        if (!empty($_POST['position_id']) && !empty($_POST['employee_no'])) {
            var_dump($_POST);
            $value = $_POST;
            $value['join_date'] = date("Y-m-d");
            $value['password'] = date('dmY', strtotime($_POST['dob']));
            $value['is_active'] = '1';
            $data['form'] = $value;
            $data['response'] =  $this->_Administrator->_add_user($value);
        }
        $this->load->view('administrator/user/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $temp['id'] = $_GET['id'];
        $data['form'] =  $this->_Administrator->_get_user($temp);
        $data['form'] = @$data['form'][0];
        $data['position'] = $this->_Administrator->_get_position(array('position_id' => @$data['form']['position_id']));
        $data['position'] = @$data['Position'][0];
        $this->load->view('administrator/user/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        $data['position'] = $this->_Administrator->_get_position();
        if (!empty($_GET['id'])) {
            $value =  $_GET;
            $data['form'] =  $this->_Administrator->_get_user($value);
            $data['form'] =  $data['form'][0];
        } elseif (!empty($_POST['id'])) {
            $temp['id'] = $_POST['id'];
            $value =  $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Administrator->_update_user($value);
        }
        $this->load->view('administrator/user/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $filename =  $this->_Administrator->_get_user($temp);
            $filename = $filename[0]['photo'];
            @unlink("uploads/photo/" . $filename); //delete it
            $data['response'] =  $this->_Administrator->_delete_user($temp);
        }
        $this->load->view('administrator/user/index', $data);
        $this->load->view('templates/Footer');
    }
}
