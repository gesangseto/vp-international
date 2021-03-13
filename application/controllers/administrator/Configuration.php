<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Configuration extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
    }
    public function index()
    {
        $get_config = $this->db->get('uac_configuration')->result_array();
        $data['form'] = $get_config[0];
        $this->load->view('administrator/configuration/index', $data);
        $this->load->view('templates/Footer');
    }
    public function create()
    {
    }

    public function read()
    {
    }

    public function update()
    {
        $data = array();
        if (!empty($_POST['id'])) {
            $data['form'] = $_POST;
            if (file_exists($_FILES['logo']['tmp_name'])) {
                $type = substr($_FILES['logo']['name'], strrpos($_FILES['logo']['name'], '.') + 1);
                $path = $_FILES['logo']['tmp_name'];
                $image = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($image);
                $data['form']['logo'] = $base64;
            }
            $this->db->where('id', $_POST['id']);
            $this->db->update('uac_configuration', $data['form']);
        }
        $response = array('messages' => 'Success update', 'statusCode' => '200');
        $this->session->set_flashdata('response', $response);
        redirect('administrator/configuration/index');
    }
}
