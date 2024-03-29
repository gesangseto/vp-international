<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Datatables extends Base_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
        $this->load->model('_Datatables', '_Datatables');
    }

    function get_agent()
    {
        $BaseData = array(
            'table' => 'list_agent',
            'column_order' => array(null, 'agent_name', 'agent_address', 'agent_phone', 'agent_city', 'agent_district', 'agent_region', 'agent_country', 'agent_postal_code'),
            'column_search' => array('agent_name', 'agent_address', 'agent_phone', 'agent_city', 'agent_district', 'agent_region', 'agent_country', 'agent_postal_code'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->agent_name;
            $row[] = substr($field->agent_address, 0, 25);
            $row[] = $field->agent_phone;
            $row[] = $field->agent_city;
            $row[] = $field->agent_district;
            $row[] = $field->agent_region;
            $row[] = $field->agent_country;
            $row[] = $field->agent_postal_code;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_customer()
    {
        $BaseData = array(
            'table' => 'list_customer',
            'column_order' => array(null, 'customer_name', 'customer_address', 'customer_phone', 'customer_city', 'customer_district', 'customer_region', 'customer_country', 'customer_postal_code'),
            'column_search' => array('customer_name', 'customer_address', 'customer_phone', 'customer_city', 'customer_district', 'customer_region', 'customer_country', 'customer_postal_code'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->customer_name;
            $row[] = substr($field->customer_address, 0, 25);
            $row[] = $field->customer_phone;
            $row[] = $field->customer_city;
            $row[] = $field->customer_district;
            $row[] = $field->customer_region;
            $row[] = $field->customer_country;
            $row[] = $field->customer_postal_code;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_port()
    {
        $BaseData = array(
            'table' => 'list_port',
            'column_order' => array(null, 'port_code', 'port_name', 'port_country', 'port_country_code'),
            'column_search' => array('port_code', 'port_name', 'port_country', 'port_country_code'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->port_code;
            $row[] = $field->port_name;
            $row[] = $field->port_country;
            $row[] = $field->port_country_code;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_task()
    {
        $BaseData = array(
            'table' => 'list_task',
            'column_order' => array(null, 'task_name', 'created_by'),
            'column_search' => array('task_name', 'created_by'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->task_name;
            // $row[] = $field->created_by;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_report_expense()
    {
        $BaseData = array(
            'select' => '*,trx_expense.id AS trx_expense_id',
            'table' => 'trx_expense',
            'left_join' => array("table" => "mst_expense", "on" => "mst_expense.id=trx_expense.mst_expense_id"),
            'column_order' => array(null, 'expense_name', 'expense_code', 'year_month', 'note', 'total'),
            'column_search' => array('expense_name', 'expense_code', 'year_month', 'note', 'total'),
            'order' => array('trx_expense_id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->trx_expense_id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->trx_expense_id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->trx_expense_id);
            $no++;
            $row = array();
            $row[] = $field->expense_name;
            $row[] = $field->expense_code;
            $row[] = $field->year_month;
            $row[] = $field->note;
            $row[] = $field->total;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_expense()
    {
        $BaseData = array(
            'table' => 'mst_expense',
            'column_order' => array(null, 'expense_name', 'expense_code', 'created_by'),
            'column_search' => array('expense_name', 'expense_code', 'created_by'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->expense_name;
            $row[] = $field->expense_code;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function get_job_order()
    {
        $BaseData = array(
            'table' => 'job_order',
            'column_order' => array(null, 'order_number', 'shipping_name', 'consignee', 'vessel', 'shipper', 'address', 'invoice'),
            'column_search' => array('order_number', 'shipping_name', 'consignee', 'vessel', 'shipper', 'address', 'invoice'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->order_number;
            $row[] = $field->shipping_name;
            $row[] = $field->consignee;
            $row[] = $field->vessel;
            $row[] = $field->shipper;
            $row[] = substr($field->address, 0, 25);
            $row[] = substr($field->invoice, 0, 25);
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_request_ca()
    {
        $BaseData = array(
            'table' => 'list_cash_advanced',
            'column_order' => array(null, 'advance_from', 'receipt_no', 'order_number', 'ex_vessel', 'container_no', 'mbl_no', 'hbl_no', 'shipping', 'eta', 'consignee', 'request_location', 'status'),
            'column_search' => array('advance_from', 'receipt_no', 'order_number', 'ex_vessel', 'container_no', 'mbl_no', 'hbl_no', 'shipping', 'eta', 'consignee', 'request_location', 'status'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $field->advance_from;
            $row[] = $field->receipt_no;
            $row[] = $field->order_number;
            $row[] = $field->ex_vessel;
            $row[] = $field->container_no;
            $row[] = $field->mbl_no;
            $row[] = $field->hbl_no;
            $row[] = $field->shipping;
            $row[] = $field->eta;
            $row[] = $field->consignee;
            $row[] = $field->request_location;
            $row[] = $field->status;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . ($field->status == 'Pending' ? $this->tools->action_for_ajax($btn_update) : '') . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_actual_ca()
    {
        $BaseData = array(
            // 'join' => array("table" => "job_order", "on" => "job_order.order_number=list_cash_advanced.order_number"),
            'table' => 'list_cash_advanced',
            'column_order' => array(null, 'advance_from', 'receipt_no', 'order_number', 'ex_vessel', 'container_no', 'mbl_no', 'hbl_no', 'shipping', 'eta', 'consignee', 'request_location', 'status'),
            'column_search' => array('advance_from', 'receipt_no', 'order_number', 'ex_vessel', 'container_no', 'mbl_no', 'hbl_no', 'shipping', 'eta', 'consignee', 'request_location', 'status'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->id);
            $no++;
            $row = array();
            $row[] = $field->advance_from;
            $row[] = $field->receipt_no;
            $row[] = $field->order_number;
            $row[] = $field->ex_vessel;
            $row[] = $field->container_no;
            $row[] = $field->mbl_no;
            $row[] = $field->hbl_no;
            $row[] = $field->shipping;
            $row[] = $field->eta;
            $row[] = $field->consignee;
            $row[] = $field->request_location;
            $row[] = $field->status;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_invoice()
    {
        $BaseData = array(
            'select' => '*,COUNT(task_id) AS total_task',
            'table' => 'invoice',
            'left_join' => array("table" => "list_agent", "on" => "list_agent.agent_id=invoice.agent_id"),
            'join' => array("table" => "job_order", "on" => "job_order.id=invoice.job_order_id"),
            'column_order' => array(null, 'invoice_number', 'invoice_date', 'shipment_type', 'job_order_id'),
            'column_search' => array('invoice_number', 'invoice_date', 'shipment_type', 'job_order_id'),
            'group_by' => 'invoice_number',
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->invoice_number);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->invoice_number);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->invoice_number);
            $no++;
            $row = array();
            $row[] = $field->invoice_number;
            $row[] = $field->invoice_date;
            $row[] = $field->order_number;
            $row[] = $field->agent_name;
            $row[] = $field->agent_address;
            $row[] = $field->shipment_type;
            $row[] = $field->total_task;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_bill_note()
    {
        $BaseData = array(
            'select' => '*,COUNT(task_id) AS total_task',
            'table' => 'bill_note',
            'left_join' => array("table" => "list_customer", "on" => "list_customer.customer_id=bill_note.customer_id"),
            'join' => array("table" => "job_order", "on" => "job_order.id=bill_note.job_order_id"),
            'column_order' => array(null, 'invoice_number', 'invoice_date', 'shipment_type', 'job_order_id'),
            'column_search' => array('invoice_number', 'invoice_date', 'shipment_type', 'job_order_id'),
            'group_by' => 'invoice_number',
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->invoice_number);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->invoice_number);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->invoice_number);
            $no++;
            $row = array();
            $row[] = $field->invoice_number;
            $row[] = $field->invoice_date;
            $row[] = $field->order_number;
            $row[] = $field->customer_name;
            $row[] = $field->customer_address;
            $row[] = $field->shipment_type;
            $row[] = $field->total_task;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_job_sheets()
    {
        $BaseData = array(
            'select' => 'detail_job_sheets.*,COUNT(DISTINCT(detail_job_sheets.job_order_id)) as total_order_number,COUNT(task_id) AS total_task',
            'table' => 'detail_job_sheets',
            'group_by' => 'job_sheets_id',
            'left_join' => array("table" => "job_order", "on" => "job_order.id=detail_job_sheets.job_order_id"),
            'column_order' => array(null, 'order_number', 'job_order_id'),
            'column_search' => array('order_number', 'job_order_id'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $btn_read = array("url" => $_POST['url'], "action" => "read", "id" => $field->job_sheets_id);
            $btn_update = array("url" => $_POST['url'], "action" => "update", "id" => $field->job_sheets_id);
            $btn_delete = array("url" => $_POST['url'], "action" => "delete", "id" => $field->job_sheets_id);
            $no++;
            $row = array();
            $row[] = $field->job_sheets_id;
            $row[] = $field->total_order_number;
            $row[] = $field->total_task;
            $row[] = $this->tools->action_for_ajax($btn_read) . '
            ' . $this->tools->action_for_ajax($btn_update) . '
            ' . $this->tools->action_for_ajax($btn_delete);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        // print_r($this->db->last_query());
        // // die;
        echo json_encode($output);
    }
}
