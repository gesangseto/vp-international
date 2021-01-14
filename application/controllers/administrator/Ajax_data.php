<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "../../Base_controller.php");

class Ajax_data extends Base_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_isLogin();
    }
    public function get_regency()
    {
        $this->load->model('Administrator/_Administrator', '_Administrator');
        $regency = $this->_Administrator->_get_regency($_POST);
        if ($regency) {
            echo '<option selected disabled value="" class="form-control">pilih</option> ';
            foreach ($regency as $row) {
                echo '<option value="' .  $row['id'] . '" class="form-control">' . $row['name'] . '</option> ';
            }
        } else {
            echo '<option selected value="" class="form-control">tidak ada data</option> ';
        }
    }
    public function get_district()
    {
        $this->load->model('Administrator/_Administrator', '_Administrator');
        $district = $this->_Administrator->_get_district($_POST);
        if ($district) {
            echo '<option selected disabled value="" class="form-control">pilih</option> ';
            foreach ($district as $row) {
                echo '<option value="' .  $row['id'] . '" class="form-control">' . $row['name'] . '</option> ';
            }
        } else {
            echo '<option selected value="" class="form-control">tidak ada data</option> ';
        }
    }
    public function get_village()
    {
        $this->load->model('Administrator/_Administrator', '_Administrator');
        $district = $this->_Administrator->_get_village($_POST);
        if ($district) {
            echo '<option selected disabled value="" class="form-control">pilih</option> ';
            foreach ($district as $row) {
                echo '<option value="' .  $row['id'] . '" class="form-control">' . $row['name'] . '</option> ';
            }
        } else {
            echo '<option selected value="" class="form-control">tidak ada data</option> ';
        }
    }
    public function get_permission()
    {
        $this->load->model('Administrator/_Permission', '_Permission');
        $get = $this->_Permission->_get_permission($_POST);
        if ($get) {
            $menu = $get[0];
            $child = $get[0]['children'][0];
            echo $menu['menu_name'] . '/' . $child['child_name'];
            echo '<hr>';
?>
            <input type="hidden" name="position_id" value="<?= $_POST['position_id'] ?>">
            <input type="hidden" name="permission_id" value="<?= $_POST['id'] ?>">
            <div class="row">
                <div class="col-md-3">
                    <label class="checkbox-group">
                        <input type="checkbox" <?= $child['create'] == 1 ? 'checked' : '' ?> name="create" value="1"> Create
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-3">
                    <label class="checkbox-group">
                        <input type="checkbox" <?= $child['read'] == 1 ? 'checked' : '' ?> name="read" value="1"> Read
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-3">
                    <label class="checkbox-group">
                        <input type="checkbox" <?= $child['update'] == 1 ? 'checked' : '' ?> name="update" value="1"> Update
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="col-md-3">
                    <label class="checkbox-group">
                        <input type="checkbox" <?= $child['delete'] == 1 ? 'checked' : '' ?> name="delete" value="1"> Delete
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
<?php
        } else {
            echo 'tidak ada data';
        }
    }
}
