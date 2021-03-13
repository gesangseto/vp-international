<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        $data['config'] = $this->db->get('uac_configuration')->result_array();
        $data['config'] = $data['config'][0];
        $this->session->sess_destroy();
        $data['response'] = array(
            'statusCode' => 200,
            'messages' => 'Anda Telah Keluar'
        );
        $this->load->view('Login', $data);
    }
}

/* End of Login Controllername.php */
