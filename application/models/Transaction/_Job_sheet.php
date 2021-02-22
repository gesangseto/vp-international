<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/../_Base_Model.php");

class _Job_sheet extends _Base_Model
{
    public function _custome_query($sql)
    {
        return $this->db->query($sql)->result_array();
    }
}
