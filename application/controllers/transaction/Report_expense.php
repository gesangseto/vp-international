<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Report_expense extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Transaction/_Report_expense', '_Report_expense');
    }
    public function index()
    {
        $this->load->view('transaction/report_expense/index');
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        $this->load->model('Master/_Expense', '_Expense');
        $data['expense'] = $this->_Expense->_get_expense();
        if (@$_POST['mst_expense_id']) {
            $data['form'] = $_POST;
            $data['form']['created_by'] = $this->session->userdata('id');
            $data['response'] = $this->_Report_expense->_add_trx_expense($data['form']);
        }
        $this->load->view('transaction/report_expense/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $data['form'] = $this->_Report_expense->_get_trx_expense($_GET);
            $data['form'] = $data['form'][0];
        }
        $this->load->view('transaction/report_expense/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        $this->load->model('Master/_Expense', '_Expense');
        $data['expense'] = $this->_Expense->_get_expense();
        if (!empty($_GET['id'])) {
            $data['form'] = $this->_Report_expense->_get_trx_expense($_GET);
            $data['form'] = $data['form'][0];
        } elseif (!empty($_POST['id'])) {
            $data['form'] = @$_POST;
            $data['response'] = $this->_Report_expense->_update_trx_expense($data['form']);
            $this->session->set_flashdata('response', $data['response']);
            redirect('transaction/report_expense/update?id=' . $_POST['id']);
        }
        $this->load->view('transaction/report_expense/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $data['response'] =  $this->_Report_expense->_delete_trx_expense($_GET);
        }
        $this->load->view('transaction/report_expense/index', $data);
        $this->load->view('templates/Footer');
    }
}
