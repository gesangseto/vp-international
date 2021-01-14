<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_controller extends CI_Controller
{
    public function _isLogin()
    {
        if (empty($this->session->userdata('id'))) {
            redirect(site_url("Login"));
            return false;
        }
        return true;
    }

    public function _check_permission()
    {

        $data['menu'] = ($this->session->userdata('menu'));
        // $data['menu'] = file_get_contents("Menu.json");
        $controller = $this->router->fetch_class();
        $method = strtolower($this->router->fetch_method());
        foreach ($data['menu'] as $row) {
            foreach ($row['children'] as $row_children) {
                $temp_url = $this->uri->segment(1) . '/' . $controller;
                if ($row['menu_url'] . '/' . $row_children['child_url'] ==  $temp_url) {
                    $auth = array(
                        'index' => '1',
                        'create' => $row_children['create'],
                        'read' => $row_children['read'],
                        'update' => $row_children['update'],
                        'delete' => $row_children['delete']
                    );
                }
            }
        }
        if (@$auth[$method] == "1") {
            $this->load->view('templates/Header', $data);
            return TRUE;
        } else {
            redirect(site_url("Unauthorized"));
            return FALSE;
        }
    }
    public function _thisURL()
    {
        $controller = $this->router->fetch_class();
        $temp_url = $this->uri->segment(1) . '/' . $controller;
        return $temp_url;
    }
    public function _userFilter()
    {
        $this->load->model('Administrator/_Administrator', '_Administrator');
        $data['position'] = $this->_Administrator->_get_position();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Administrator->_get_user($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter_User', $data);
        return $data;
    }
    public function _agentFilter()
    {
        $this->load->model('Database/_Agent', '_Agent');
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Agent->_get_agent($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter_Agent', $data);
        return $data;
    }
    public function _customerFilter()
    {
        $this->load->model('Database/_Customer', '_Customer');
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Customer->_get_customer($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter_Customer', $data);
        return $data;
    }
    public function _taskFilter()
    {
        $this->load->model('Database/_Task', '_Task');
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Task->_get_task($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter_Task', $data);
        return $data;
    }
    public function _portFilter()
    {
        $this->load->model('Database/_Port', '_Port');
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Port->_get_port($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter_Port', $data);
        return $data;
    }
    public function _caFilter()
    {
        $this->load->model('Database/_Cash_advanced', '_Cash_advanced');
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $_POST;
            $data['data'] = $this->_Cash_advanced->_get_cash_advanced($value);
            $data['form'] = $_POST;
        }
        $this->load->view('templates/Filter_CA', $data);
        return $data;
    }
}
