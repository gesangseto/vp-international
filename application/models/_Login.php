<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/_Base_Model.php");

class _Login extends _Base_Model
{
    public function _login_user($data)
    {

        $response['statusCode'] = 401;
        $response['messages'] = 'login info tidak benar';
        $response['data'] = '';
        $this->db->where('username =', $data['email']);
        $this->db->or_where('email =', $data['email']);
        $super_admin = $this->db->get('uac_configuration');
        if ($super_admin->num_rows() > 0) {
            $row = $super_admin->result_array();
            if ($row[0]['password'] == $data['password']) {
                $super_admin = $row[0];
                $profile = array(
                    'id' => 'special_admin',
                    'position_id' => 0,
                    'email' => $super_admin['username'],
                    'username' => $super_admin['username'],
                    'phone_number' => $super_admin['phone_number'],
                    'photo' => $super_admin['logo'],
                );
                $this->session->set_userdata($profile);
                $response['statusCode'] = 200;
                $response['messages'] = 'sukses';
                $response['data'] = $row;
            }
        } else {
            $where = ' ';
            $where .= " AND a.email = '" . $data['email'] . "'";
            $where .= " LIMIT 1";
            $sql = "SELECT * FROM user AS a WHERE a.id IS NOT NULL " . $where;
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->result_array();
                if ($row[0]['password'] == $data['password']) {
                    $this->session->set_userdata($row[0]);
                    $response['statusCode'] = 200;
                    $response['messages'] = 'sukses';
                    $response['data'] = $row;
                }
            }
        }
        return $response;
    }

    public function _get_menu_user($posistion = null)
    {
        $parent_data = $this->db->query("SELECT * FROM uac_parent_menu WHERE id IS NOT NULL ORDER BY menu_name ASC");
        $menu = array();
        $response['statusCode'] = 500;
        foreach ($parent_data->result_array() as $row) {
            $response['statusCode'] = 200;
            $sql = "SELECT * FROM uac_child_menu AS b LEFT JOIN uac_permission AS c ON b.id = c.uac_child_menu_id WHERE b.uac_parent_map_id ='" . $row['id'] . "'  AND c.position_id = '" . $posistion . "' ORDER BY child_name ASC";
            if ($posistion == 0) {
                $sql = "SELECT * FROM uac_child_menu AS b WHERE b.uac_parent_map_id ='" . $row['id'] . "'  ORDER BY child_name ASC";
            }
            $child_data = $this->db->query($sql);
            if ($child_data->num_rows() > 0) {
                $temp_menu['menu_name'] = @$row['menu_name'];
                $temp_menu['menu_url'] = @$row['menu_url'];
                $temp_menu['icon'] = @$row['icon'];
                foreach ($child_data->result_array() as $child) {
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
        $data_menu['menu'] = $menu;
        $this->session->set_userdata($data_menu);
        return $response;
    }
    public function _get_configuration($data = null)
    {
        $config = $this->db->get("uac_configuration");
        $response['statusCode'] = 500;
        if ($config->num_rows() > 0) {
            $config = $config->result_array();
            $response['statusCode'] = 200;
            $data_config['config'] = $config[0];
            $this->session->set_userdata($data_config);
        }
        return $response;
    }
}
