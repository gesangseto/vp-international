<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Dashboard extends Base_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_isLogin();
		$this->load->model('_Dashboard', '_Dashboard');
	}
	public function index()
	{
		$data['count_agent'] = $this->_Dashboard->_count_agent();
		$data['count_customer'] = $this->_Dashboard->_count_customer();
		$data['count_user'] = $this->_Dashboard->_count_user();
		$data['count_port'] = $this->_Dashboard->_count_port();
		$data['menu'] = $this->session->userdata('menu');
		$this->load->view('templates/Header', $data);
		$this->load->view('dashboard/View');
		$this->load->view('templates/Footer');
	}
}
