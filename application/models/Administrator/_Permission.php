<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Permission extends _Base_Model
{
    public function _get_position($data = null)
    {
        $where = ' ';
        if (@$data['id']) {
            $where .= "AND a.id = '" . $data['id'] . "'";
        }
        if (@$data['position_name']) {
            $where .= "AND a.position_name = '" . $data['position_name'] . "'";
        }
        if (@$data['kode']) {
            $where .= "AND a.kode = '" . $data['kode'] . "'";
        }
        $query = $this->db->query("SELECT * FROM position AS a WHERE a.id IS NOT NULL " . $where);
        $result = $query->result_array();
        return $result;
    }
    public function _get_menu($data = null)
    {
        $parent_data = $this->db->query("SELECT * FROM uac_parent_menu WHERE id IS NOT NULL");
        $menu = array();
        $response['statusCode'] = 500;
        foreach ($parent_data->result_array() as $row) {
            $response['statusCode'] = 200;
            $temp_menu['menu_name'] = $row['menu_name'];
            $temp_menu['menu_url'] = $row['menu_url'];
            $temp_menu['icon'] = $row['icon'];
            $child_data = $this->db->query("SELECT * FROM uac_child_menu AS b WHERE b.uac_parent_map_id ='" . $row['id'] . "' ");
            if ($child_data->num_rows() > 0) {
                foreach ($child_data->result_array() as $child) {
                    $temp_child['id'] = $child['id'];
                    $temp_child['child_name'] = $child['child_name'];
                    $temp_child['child_url'] = $child['child_url'];
                    $menu_child[] = $temp_child;
                    $temp_child = array();
                }
            }
            $temp_menu['children'] = $menu_child;
            $menu[] = $temp_menu;
            $temp_menu = array();
            $menu_child = array();
        }
        return $menu;
    }
    public function _get_permission($data = null)
    {
        $where = ' ';
        if (@$data['position_id']) {
            $where .= "AND c.position_id = '" . $data['position_id'] . "'";
        }
        if (@$data['id']) {
            $where .= "AND c.id = '" . $data['id'] . "'";
        }
        $parent_data = $this->db->query("SELECT * FROM uac_parent_menu WHERE id IS NOT NULL");
        $menu = array();
        $response['statusCode'] = 500;
        foreach ($parent_data->result_array() as $row) {
            $response['statusCode'] = 200;
            $child_data = $this->db->query("SELECT * FROM uac_child_menu AS b LEFT JOIN uac_permission AS c ON b.id = c.uac_child_menu_id WHERE b.uac_parent_map_id ='" . $row['id'] . "' " . $where);
            if ($child_data->num_rows() > 0) {
                $temp_menu['menu_name'] = @$row['menu_name'];
                $temp_menu['menu_url'] = @$row['menu_url'];
                $temp_menu['icon'] = @$row['icon'];
                foreach ($child_data->result_array() as $child) {
                    $temp_child['id'] = $child['id'];
                    $temp_child['child_name'] = $child['child_name'];
                    $temp_child['child_url'] = $child['child_url'];
                    $temp_child['create'] = @($child['create']) == '0' ? '0' : "1";
                    $temp_child['read'] = @($child['read']) == '0' ? '0' : "1";
                    $temp_child['update'] = @($child['update']) == '0' ? '0' : "1";
                    $temp_child['delete'] = @($child['delete']) == '0' ? '0' : "1";
                    $menu_child[] = $temp_child;
                    $temp_child = array();
                }
                $temp_menu['children'] = $menu_child;
                $menu[] = $temp_menu;
                $menu_child = array();
                $temp_menu = array();
            }
        }
        return $menu;
    }
    public function _add_permission($data)
    {
        $query = $this->db->query("SELECT * FROM uac_permission AS a WHERE a.position_id='" . $data['position_id'] . "' AND a.uac_child_menu_id='" . $data['uac_child_menu_id'] . "'");
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        if ($query->num_rows() > 0) {
            $response['statusCode'] = 400;
            $response['messages'] = 'Duplikat hak akses';
            $response['data'] = '';
        } else {
            $query = $this->db->insert('uac_permission', @$data);
            if ($query) {
                $response['statusCode'] = 200;
                $response['messages'] = 'Sukses tambah hak akses';
                $response['data'] = '';
            }
        }
        return $response;
    }
    public function _update_permission($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $this->db->where('id', @$data['id']);
        $query = $this->db->update('uac_permission', $data);
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses ubah hak akses';
            $response['data'] = '';
        }

        return $response;
    }
    public function _delete_permission($data)
    {
        $response['statusCode'] = 500;
        $response['messages'] = 'Internal server error';
        $response['data'] = '';
        $this->db->where('id', @$data['id']);
        $query = $this->db->delete('uac_permission', $data);
        if ($query) {
            $response['statusCode'] = 200;
            $response['messages'] = 'Sukses hapus hak akses';
            $response['data'] = '';
        }

        return $response;
    }
}
