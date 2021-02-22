<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Base_controller.php');

class Ajax_data extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
    }
    public function renew_order_number()
    {
        $this->load->model('Transaction/_Job_order', '_Job_order');
        $order_format = $this->tools->order_format();
        $query['other'] = ' AND a.order_number LIKE "' . substr($order_format, 0, -3) . '%" ORDER BY order_number DESC LIMIT 1';
        $result = $this->_Job_order->_get_job_order($query);
        $order_number = '001';
        if (@$result[0]) {
            $order_number = $result[0]['order_number'];
            $order_number = substr($order_number, -3);
            $order_number = $order_number + 1;
            $order_number = str_pad($order_number, 3, "0", STR_PAD_LEFT);
        }
        $order_number = $order_format . "" . $order_number;
        echo $order_number;
    }
    public function get_task()
    {
        $data = [];
        if (isset($_POST['text'])) {
            $value['other'] = ' AND task_name LIKE "%' . $_POST['text'] . '%" LIMIT 10';
            $this->load->model('Database/_Task', '_Task');
            $data = $this->_Task->_get_task($value);
        }
        echo json_encode($data);
    }
    public function get_task_by_order_no_for_rca()
    {
        $data = [];

        if (isset($_POST['order_number'])) {
            $data['order_number'] = $_POST['order_number'];
            $this->load->model('transaction/_Cash_advance', '_Cash_advance');
            $data = $this->_Cash_advance->_get_task_by_order_no_for_rca($data);
            echo json_encode($data);
        }
    }
    public function get_available_order_number()
    {
        $data = [];
        $arr = [];
        if (isset($_POST['text'])) {
            $value['order_number'] =  $_POST['text'];
            $this->load->model('Transaction/_Cash_advance', '_Cash_advance');
            $data = $this->_Cash_advance->_get_job_order_for_rca($value);
            foreach ($data as $row) {
            }
        }
        echo json_encode($data);
    }
    public function get_all_task_by_order_number()
    {
        $data = [];
        $arr = [];
        if (isset($_POST['order_number'])) {
            $query =  '
            SELECT f.`id`, f.`order_number`, f.`shipping_name`, f.`consignee`, f.`vessel`, f.`flight`, f.`shipper`, f.`container_no`, f.`party`, f.`mbl_no`, f.`hbl_no`, 
            f.`gw_meas`, f.`invoice`, f.`date`, f.`etd`, f.`eta`, f.`pol`, f.`pod`, f.`address`, f.`freight`, f.`created_by`, f.`created_date`, f.`updated_by`, 
            f.`updated_date`, f.`total_buying_idr`, f.`total_buying_usd`, f.`total_selling_idr`, f.`total_selling_usd`, f.`total_profit_idr`, f.`total_profit_usd`,
            g.`order_number`, g.`task_id`, g.`buying_kurs`, g.`buying_usd`, g.`buying_idr`, g.`total_buying_usd`, g.`total_buying_idr`,
            g.`selling_kurs`, g.`selling_usd`, g.`selling_idr`, g.`total_selling_usd`, g.`total_selling_idr`,
            g.`profit_kurs`, g.`profit_usd`, g.`profit_idr`, g.`total_profit_usd`, g.`total_profit_idr`, g.`note`,z.task_name
            FROM `job_order` AS f
            LEFT JOIN 
            (SELECT * FROM
            (SELECT a.`order_number`, b.`task_id`, b.`buying_kurs`, b.`buying_usd`, b.`buying_idr`, b.`total_buying_usd`, b.`total_buying_idr`,
            b.`selling_kurs`, b.`selling_usd`, b.`selling_idr`, b.`total_selling_usd`, b.`total_selling_idr`,
            b.`profit_kurs`, b.`profit_usd`, b.`profit_idr`, b.`total_profit_usd`, b.`total_profit_idr`, b.`note`
            FROM job_order AS a LEFT JOIN `detail_job_order` AS b ON a.`id` = b.`job_order_id`
            UNION ALL
            SELECT c.`order_number`, d.`task_id`, d.`actual_kurs` AS `buying_kurs`, d.`actual_usd` AS `buying_usd`, d.`actual_idr` AS `buying_idr`, d.`total_actual_usd` AS `total_buying_usd`, d.`total_actual_idr` AS `total_buying_idr`,
            "0" AS `selling_kurs`, "0" AS `selling_usd`, "0" AS `selling_idr`, "0" AS `total_selling_usd`, "0" AS `total_selling_idr`,
            "0" AS `profit_kurs`, "0" AS `profit_usd`, "0" AS `profit_idr`, "0" AS `total_profit_usd`, "0" AS `total_profit_idr`, "0" AS `note`
            FROM list_cash_advanced AS c LEFT JOIN detail_cash_advanced AS d ON c.`id` = d.`cash_advance_id` WHERE c.status = "Verified") AS e) AS g
            ON f.`order_number` = g.order_number
            LEFT JOIN list_task AS z  on z.id=g.task_id
            WHERE f.order_number = "' . $_POST['order_number'] . '"';
            $this->load->model('Transaction/_Job_sheet', '_Job_sheet');
            $data = $this->_Job_sheet->_custome_query($query);
        }
        echo json_encode($data);
    }
}
