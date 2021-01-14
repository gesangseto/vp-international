<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Position extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Administrator/_Position', '_Position');
    }
    public function index()
    {
        $data['position'] = $this->_Position->_get_position();
        $this->load->view('administrator/position/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        if (!empty($_POST['position_name']) && !empty($_POST['kode'])) {
            $value = $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Position->_add_position($value);
        }
        $this->load->view('administrator/position/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $temp['id'] = $_GET['id'];
        $data['form'] =  $this->_Position->_get_position($temp);
        $data['form'] = @$data['form'][0];
        $this->load->view('administrator/position/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $value =  $_GET;
            $data['form'] = $this->_Position->_get_position($value);
            $data['form'] =  $data['form'][0];
        } elseif (!empty($_POST['position_name']) && !empty($_POST['kode'])) {
            $value = $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Position->_update_position($value);
        }
        $this->load->view('administrator/position/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['response'] =  $this->_Position->_delete_position($temp);
        }
        $this->load->view('administrator/position/index', $data);
        $this->load->view('templates/Footer');
    }
}
