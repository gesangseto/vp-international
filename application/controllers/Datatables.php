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
}
