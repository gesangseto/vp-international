<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Job_sheet extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->_check_permission();
        $this->load->model('Transaction/_Job_order', '_Job_order');
    }
    public function index()
    {
        $this->load->view('transaction/job_sheet/index');
        $this->load->view('templates/Footer');
    }
    public function create()
    {
        $data = array();
        $order_format = $this->tools->order_format();
        $query['other'] = ' AND a.order_number LIKE "' . substr($order_format, 0, -3) . '%" ORDER BY order_number DESC LIMIT 1';
        $result = $this->_Job_order->_get_job_order($query);
        $job_sheets_id = $this->_Job_order->_custome_query('SELECT MAX(job_sheets_id ) AS last_id FROM detail_job_sheets');
        if ($job_sheets_id[0]['last_id'] == NULL) {
            $job_sheets_id = 1;
        } else {
            $job_sheets_id = $job_sheets_id[0]['last_id'] + 1;
        }
        $data['form']['job_sheets_id'] = $job_sheets_id;
        if (isset($_POST['job_sheets_id'])) {
            $job_order_id = array_values($_POST["job_order_id"]);
            $task_id = array_values($_POST["task_id"]);
            $buying_idr = array_values($_POST["buying_idr"]);
            $buying_usd = array_values($_POST["buying_usd"]);
            $total_buying_idr = array_values($_POST["total_buying_idr"]);
            $total_buying_usd = array_values($_POST["total_buying_usd"]);
            $selling_idr = array_values($_POST["selling_idr"]);
            $selling_usd = array_values($_POST["selling_usd"]);
            $total_selling_idr = array_values($_POST["total_selling_idr"]);
            $total_selling_usd = array_values($_POST["total_selling_usd"]);
            $profit_idr = array_values($_POST["profit_idr"]);
            $profit_usd = array_values($_POST["profit_usd"]);
            $total_profit_idr = array_values($_POST["total_profit_idr"]);
            $total_profit_usd = array_values($_POST["total_profit_usd"]);
            for ($i = 0; $i < count($job_order_id); $i++) {
                for ($x = 0; $x < count($task_id[$i]); $x++) {
                    $form[] = array(
                        "job_sheets_id" => @$_POST['job_sheets_id'],
                        "job_order_id" => @$job_order_id[$i],
                        "task_id" => @$task_id[$i][$x],
                        "buying_idr" => @$buying_idr[$i][$x],
                        "buying_usd" => @$buying_usd[$i][$x],
                        "total_buying_idr" => @$total_buying_idr[$i],
                        "total_buying_usd" => @$total_buying_usd[$i],
                        "selling_idr" => @$selling_idr[$i][$x],
                        "selling_usd" => @$selling_usd[$i][$x],
                        "total_selling_idr" => @$total_selling_idr[$i],
                        "total_selling_usd" => @$total_selling_usd[$i],
                        "profit_idr" => @$profit_idr[$i][$x],
                        "profit_usd" => @$profit_usd[$i][$x],
                        "total_profit_idr" => @$total_profit_idr[$i],
                        "total_profit_usd" => @$total_profit_usd[$i],
                    );
                }
            }
            $this->load->model('Transaction/_Job_sheet', '_Job_sheet');
            $data['response'] = $this->_Job_sheet->_add_batch_job_sheets($form);
        }
        $this->load->view('transaction/job_sheet/create', $data);
        $this->load->view('templates/Footer');
    }

    public function read()
    {
        if (!empty($_GET['id'])) {
            $temp['job_sheets_id'] = $_GET['id'];
            $this->load->model('Transaction/_Job_sheet', '_Job_sheet');
            $data['job_sheet']  = $this->_Job_sheet->_get_job_sheet($temp);
            $data['job_order']  = $this->_Job_sheet->_get_job_order_by_job_sheets_id($temp);
        }
        $this->load->view('transaction/job_sheet/read', $data);
        $this->load->view('templates/Footer');
    }

    public function update()
    {
        $data = array();
        $this->load->model('Transaction/_Job_sheet', '_Job_sheet');
        if (!empty($_GET['id'])) {
            $temp['job_sheets_id'] = $_GET['id'];
            $data['job_sheet']  = $this->_Job_sheet->_get_job_sheet($temp);
        } elseif (!empty($_POST['job_sheets_id'])) {
            $detail_job_sheets_id = array_values($_POST["detail_job_sheets_id"]);
            $job_order_id = array_values($_POST["job_order_id"]);
            $task_id = array_values($_POST["task_id"]);
            $buying_idr = array_values($_POST["buying_idr"]);
            $buying_usd = array_values($_POST["buying_usd"]);
            $total_buying_idr = array_values($_POST["total_buying_idr"]);
            $total_buying_usd = array_values($_POST["total_buying_usd"]);
            $selling_idr = array_values($_POST["selling_idr"]);
            $selling_usd = array_values($_POST["selling_usd"]);
            $total_selling_idr = array_values($_POST["total_selling_idr"]);
            $total_selling_usd = array_values($_POST["total_selling_usd"]);
            $profit_idr = array_values($_POST["profit_idr"]);
            $profit_usd = array_values($_POST["profit_usd"]);
            $total_profit_idr = array_values($_POST["total_profit_idr"]);
            $total_profit_usd = array_values($_POST["total_profit_usd"]);
            for ($i = 0; $i < count($job_order_id); $i++) {
                for ($x = 0; $x < count($task_id[$i]); $x++) {
                    if (@$detail_job_sheets_id[$i][$x]) {
                        $form['update'][] = array(
                            "id" => @$detail_job_sheets_id[$i][$x],
                            "job_sheets_id" => @$_POST['job_sheets_id'],
                            "job_order_id" => @$job_order_id[$i],
                            "task_id" => @$task_id[$i][$x],
                            "buying_idr" => @$buying_idr[$i][$x],
                            "buying_usd" => @$buying_usd[$i][$x],
                            "total_buying_idr" => @$total_buying_idr[$i],
                            "total_buying_usd" => @$total_buying_usd[$i],
                            "selling_idr" => @$selling_idr[$i][$x],
                            "selling_usd" => @$selling_usd[$i][$x],
                            "total_selling_idr" => @$total_selling_idr[$i],
                            "total_selling_usd" => @$total_selling_usd[$i],
                            "profit_idr" => @$profit_idr[$i][$x],
                            "profit_usd" => @$profit_usd[$i][$x],
                            "total_profit_idr" => @$total_profit_idr[$i],
                            "total_profit_usd" => @$total_profit_usd[$i],
                        );
                    } else {
                        $form['insert'][] = array(
                            "job_sheets_id" => @$_POST['job_sheets_id'],
                            "job_order_id" => @$job_order_id[$i],
                            "task_id" => @$task_id[$i][$x],
                            "buying_idr" => @$buying_idr[$i][$x],
                            "buying_usd" => @$buying_usd[$i][$x],
                            "total_buying_idr" => @$total_buying_idr[$i],
                            "total_buying_usd" => @$total_buying_usd[$i],
                            "selling_idr" => @$selling_idr[$i][$x],
                            "selling_usd" => @$selling_usd[$i][$x],
                            "total_selling_idr" => @$total_selling_idr[$i],
                            "total_selling_usd" => @$total_selling_usd[$i],
                            "profit_idr" => @$profit_idr[$i][$x],
                            "profit_usd" => @$profit_usd[$i][$x],
                            "total_profit_idr" => @$total_profit_idr[$i],
                            "total_profit_usd" => @$total_profit_usd[$i],
                        );
                    }
                }
            }
            if (@$form['insert']) {
                $this->_Job_sheet->_add_batch_job_sheets($form['insert']);
            }
            $data['response'] = $this->_Job_sheet->_edit_batch_job_sheets($form['update']);
            $this->session->set_flashdata('response', $data['response']);
            redirect('transaction/job_sheet/update?id=' . $_POST['job_sheets_id']);
        }
        $this->load->view('transaction/job_sheet/update', $data);
        $this->load->view('templates/Footer');
    }

    public function delete()
    {
        $data = array();
        if (!empty($_GET['id'])) {
            $this->load->model('Transaction/_Job_sheet', '_Job_sheet');
            $data['response'] =  $this->_Job_sheet->_delete_job_sheet(array('other' => ' AND job_sheets_id=' . $_GET['id']));
        }
        $this->load->view('transaction/job_sheet/index', $data);
        $this->load->view('templates/Footer');
    }
}
