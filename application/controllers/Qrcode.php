<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qrcode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('_Qrcode');
    }
    public function read()
    {
        if (empty($_GET['unique_code'])) {
            $this->load->view('Unauthorized');
        }
        $this->load->model('Administrator/_Administrator', '_Administrator');
        $data['form'] = $this->_Administrator->_get_user(array('unique_code' => $_GET['unique_code']));
        $data['form'] = @$data['form'][0];
        if ($data['form']) {
            $this->load->view('Qrcode', $data);
        } else {
            $this->load->view('Unauthorized');
        }
        $this->load->view('templates/Footer');
    }
}
