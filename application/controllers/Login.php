<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('id'))) {
            redirect(site_url("Dashboard"));
        }
        $this->load->model('_Login');
    }

    public function index()
    {
        $data = array();
        $data['config'] = $this->db->get('uac_configuration')->result_array();
        $data['config'] = $data['config'][0];
        if (!empty($_POST['email'])) {
            $data['form'] = array(
                "email" => $_POST['email'],
                "password" => $_POST['password']
            );
            $data['response'] = $this->_Login->_login_user($data['form']);
            if ($data['response']['statusCode'] == 200) {
                $set_menu = $this->_Login->_get_menu_user($this->session->userdata('position_id'));
                $set_config = $this->_Login->_get_configuration();

                if ($set_menu['statusCode'] == 200 && $set_config['statusCode'] == 200) {
                    redirect(site_url('Dashboard'));
                }
            }
        }

        $this->load->view('Login', $data);
    }
}
