<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Profile extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->_isLogin();
        $this->load->model('Administrator/_Administrator', '_Administrator');
        $data['menu'] = $this->session->userdata('menu');
        $this->load->view('templates/Header', $data);
        $temp['id'] = $this->session->userdata('id');
        $this->load->model('Administrator/_Administrator', '_Administrator');
        $data['form'] = $this->_Administrator->_get_user($temp);
        $data['form'] = @$data['form'][0];
        $this->load->view('Profile', $data);
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
    }

    public function delete()
    {
    }
    public function get_riwayat()
    {
        $this->load->model('Fingerprint/_Fingerprint', '_Fingerprint');
        $data['riwayat'] = $this->_Fingerprint->_get_transaction(@$_POST);
        $data['riwayat'] = $data['riwayat']['data'];
        $this->load->view('for_ajax/riwayat', $data);
    }
}
