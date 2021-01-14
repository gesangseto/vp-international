<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Dashboard extends Base_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_isLogin();
	}
	public function index()
	{
		$data['menu'] = $this->session->userdata('menu');
		$this->load->view('templates/Header', $data);
		$this->load->view('dashboard/View');
		$this->load->view('templates/Footer');
	}
}
