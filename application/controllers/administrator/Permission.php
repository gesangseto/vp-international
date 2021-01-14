<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Permission extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Administrator/_Permission', '_Permission');
    }
    public function index()
    {
        $data['position'] = $this->_Permission->_get_position();
        $this->load->view('administrator/permission/index', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $value =  $_GET;
            $data['position'] = $this->_Permission->_get_position($value);
            $data['position'] =  $data['position'][0];
            $data['menu'] = $this->_Permission->_get_menu();
            $data['permission'] = $this->_Permission->_get_permission(array('position_id' => $_GET['id']));
        } elseif (!empty($_POST['position_name']) && !empty($_POST['kode'])) {
            $value = $_POST;
            $data['form'] = $value;
            $data['response'] =  $this->_Permission->_update_position($value);
        } else {
            $value = array(
                'id' => $_POST['permission_id'],
                'create' => @$_POST['create'] == 1 ? '1' : '0',
                'read' => @$_POST['read'] == 1 ? '1' : '0',
                'update' =>  @$_POST['update'] == 1 ? '1' : '0',
                'delete' =>  @$_POST['delete'] == 1 ? '1' : '0'
            );
            $data['response'] =  $this->_Permission->_update_permission($value);
            $this->session->set_flashdata('statusCode', $data['response']['statusCode']);
            $this->session->set_flashdata('messages', $data['response']['messages']);
            redirect(site_url("administrator/permission/update?id=" . $_POST['position_id']));
        }
        $this->load->view('administrator/permission/update', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        if (!empty($_POST['position_id']) && !empty($_POST['uac_child_menu_id'])) {
            $value =  $_POST;
            $data['response'] =  $this->_Permission->_add_permission($value);
            $this->session->set_flashdata('statusCode', $data['response']['statusCode']);
            $this->session->set_flashdata('messages', $data['response']['messages']);
        }
        redirect(site_url("administrator/permission/update?id=" . $_POST['position_id']));
    }
    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $temp['id'] = $_GET['id'];
            $data['response'] =  $this->_Permission->_delete_permission($temp);
            $this->session->set_flashdata('statusCode', $data['response']['statusCode']);
            $this->session->set_flashdata('messages', $data['response']['messages']);
        }
        redirect(site_url("administrator/permission/update?id=" . $_GET['position_id']));
    }
}
