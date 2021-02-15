<?php

class Tools
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function convertDateTime($date, $format = 'Y-m-d')
    {
        $timezone = 'Asia/Jakarta';
        $tzLocal = 'UTC';
        $d = new DateTime($date, new DateTimeZone($tzLocal));
        $d->setTimeZone(new DateTimeZone($timezone));
        return $d->format($format);
    }

    public function action($value = null, $id = null)
    {
        $url = str_replace(base_url(), "", current_url());
        $data['menu'] = $_SESSION["menu"];
        $button = '';
        foreach ($data['menu'] as $row) {
            foreach ($row['children'] as $row_children) {
                //var_dump('/'.$row['menu_url'] . '/' . $row_children['child_url']);
                //var_dump($url);
                //die;
                if ($row['menu_url'] . '/' . $row_children['child_url'] ==  $url) { //ini untuk localhost
                    // if ('/' . $row['menu_url'] . '/' . $row_children['child_url'] ==  $url) { // ini untuk server
                    if ($value == 'create' && $row_children['create'] == '1') {
                        $button = '<a  href="' . site_url($url . '/create') . '" class="btn btn-primary"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>';
                    } elseif ($value == 'read'  && $row_children['read'] == '1') {
                        $button = '<a href="' . site_url($url . '/read?id=' . $id) . '" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>';
                    } elseif ($value == 'update'  && $row_children['update'] == '1') {
                        $button = '<a  href="' . site_url($url . '/update?id=' . $id) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';
                    } elseif ($value == 'delete'  && $row_children['delete'] == '1') {
                        $button = '<button onclick="hapus(' . $id . ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                    }
                }
            }
        }
        return $button;
    }

    public function action_for_ajax($data = null)
    {
        // var_dump($data);
        $url = str_replace(base_url(), "", current_url());
        if (@$data['url']) {
            $url = str_replace(base_url(), "",  @$data['url']);
        }
        $data['menu'] = $_SESSION["menu"];
        $button = '';
        if (@$data['action']) {
            foreach ($data['menu'] as $row) {
                foreach ($row['children'] as $row_children) {
                    if ($row['menu_url'] . '/' . $row_children['child_url'] ==  $url) { //ini untuk localhost
                        // if ('/' . $row['menu_url'] . '/' . $row_children['child_url'] ==  $url) { // ini untuk server
                        if (@$data['action'] == 'create' && $row_children['create'] == '1') {
                            $button = '<a  href="' . site_url($url . '/create') . '" class="btn btn-primary"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>';
                        } elseif (@$data['action'] == 'read'  && $row_children['read'] == '1') {
                            $button = '<a href="' . site_url($url . '/read?id=' . @$data['id']) . '" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>';
                        } elseif (@$data['action'] == 'update'  && $row_children['update'] == '1') {
                            $button = '<a  href="' . site_url($url . '/update?id=' . @$data['id']) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';
                        } elseif (@$data['action'] == 'delete'  && $row_children['delete'] == '1') {
                            $button = '<button onclick="hapus(' . @$data['id'] . ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        }
                    }
                }
            }
        }
        return $button;
    }


    /*
    ===========================
    ini tools untuk fingerprint
    ===========================
    */
    public function order_format()
    {
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $order_format = "VP-" . $year . "/" . $month . "-" . $day;
        return $order_format;
    }
}
