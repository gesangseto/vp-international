<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "../_Base_Model.php");

class _Change_account extends _Base_Model
{

    public function _changePassword($value = null)
    {
        $value = json_encode($value, true);

        try {
            return $this->_Post('/sumber-daya-manusia/1.0.0/daftar-staff', $value);
        } catch (Exception $err) {
            return false;
        }
    }
}
