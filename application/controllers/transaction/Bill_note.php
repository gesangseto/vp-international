<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Bill_note extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
    }
    public function index()
    {
        $this->load->view('transaction/bill_note/index');
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $this->load->model('Transaction/_Bill_note', '_Bill_note');
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $data = array();
        $invoice_format = $this->tools->invoice_format();
        $query['other'] = ' AND a.invoice_number LIKE "' . $invoice_format . '%" ORDER BY a.invoice_number DESC LIMIT 1';
        $result = $this->_Bill_note->_get_bill_note($query);
        $invoice_number = '001';
        if (@$result[0]) {
            $invoice_number = substr($result[0]['invoice_number'], -4, 3);
            $invoice_number = $invoice_number + 1;
            $invoice_number = str_pad($invoice_number, 3, "0", STR_PAD_LEFT);
        }
        $invoice_number = $this->tools->invoice_format($invoice_number);
        $data['form']['invoice_number'] = $invoice_number;
        $data['form']['invoice_date'] = $year . '-' . $month . '-' . $day;
        if (@$_POST['invoice_number']) {
            for ($i = 0; $i < count($_POST['task_id']); $i++) {
                $form[] = array(
                    "invoice_number" => $_POST['invoice_number'],
                    "invoice_date" => $_POST['invoice_date'],
                    "shipment_type" => $_POST['shipment_type'],
                    "customer_id" => $_POST['customer_id'],
                    "job_order_id" => $_POST['job_order_id'],
                    "task_id" => $_POST['task_id'][$i],
                    "quantity" => $_POST['quantity'][$i],
                    "currency" => $_POST['currency'][$i],
                    "rate" => $_POST['rate'][$i],
                    "amount" => $_POST['amount'][$i],
                    "vat" => $_POST['vat'][$i],
                    "total" => $_POST['total'][$i],
                    "grand_total" => $_POST['grand_total']
                );
            }
            $data['response'] = $this->_Bill_note->_add_batch_bill_note($form);
        }
        $this->load->view('transaction/bill_note/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        $data = array();
        $this->load->model('Transaction/_Bill_note', '_Bill_note');
        if (!empty($_GET['id'])) {
            $data['bill_note']  = $this->_Bill_note->_get_bill_note(array('invoice_number' => $_GET['id']));
            $data['customer']  = $this->_Bill_note->_custome_query('SELECT a.* FROM list_customer AS a LEFT JOIN bill_note AS b ON a.customer_id = b.customer_id WHERE b.invoice_number=\'' . $_GET['id'] . '\' LIMIT 1');
            $data['customer'] =    $data['customer'][0];
        }
        $this->load->view('transaction/bill_note/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        $this->load->model('Transaction/_Bill_note', '_Bill_note');
        if (!empty($_GET['id'])) {
            $data['bill_note']  = $this->_Bill_note->_get_bill_note(array('invoice_number' => $_GET['id']));
            $data['customer']  = $this->_Bill_note->_custome_query('SELECT a.* FROM list_customer AS a LEFT JOIN bill_note AS b ON a.customer_id = b.customer_id WHERE b.invoice_number=\'' . $_GET['id'] . '\' LIMIT 1');
            $data['customer'] =    $data['customer'][0];
        } elseif (!empty($_POST['invoice_number'])) {
            if (!$_POST["task_id"][0]) {
                $response = array('messages' => 'Task cannot be null', 'statusCode' => '400');
                $this->session->set_flashdata('response', $response);
                redirect('transaction/invoice/update?id=' . $_POST['invoice_number']);
            }
            $id = array_values($_POST["bill_note_id"]);
            $task_id = array_values($_POST["task_id"]);
            $quantity = array_values($_POST["quantity"]);
            $currency = array_values($_POST["currency"]);
            $rate = array_values($_POST["rate"]);
            $amount = array_values($_POST["amount"]);
            $vat = array_values($_POST["vat"]);
            $total = array_values($_POST["total"]);
            for ($i = 0; $i < count($_POST['task_id']); $i++) {
                $form[] = array(
                    "invoice_number" => $_POST['invoice_number'],
                    "invoice_date" => $_POST['invoice_date'],
                    "shipment_type" => $_POST['shipment_type'],
                    "customer_id" => $_POST['customer_id'],
                    "job_order_id" => $_POST['job_order_id'],
                    "id" => @$id[$i],
                    "task_id" => $task_id[$i],
                    "quantity" => $quantity[$i],
                    "currency" => $currency[$i],
                    "rate" => $rate[$i],
                    "amount" => $amount[$i],
                    "vat" => $vat[$i],
                    "total" => $total[$i],
                    "grand_total" => $_POST['grand_total']
                );
            }

            $data['response'] = $this->_Bill_note->_update_batch_bill_note($form);
            $this->session->set_flashdata('response', $data['response']);
            redirect('transaction/bill_note/update?id=' . $_POST['invoice_number']);
        }
        $this->load->view('transaction/bill_note/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $this->load->model('Transaction/_Bill_note', '_Bill_note');
            $data['response'] = $this->_Bill_note->_delete_bill_note(array('invoice_number' => $_GET['id']));
        }
        $this->load->view('transaction/bill_note/index', $data);
        $this->load->view('templates/Footer');
    }
}
