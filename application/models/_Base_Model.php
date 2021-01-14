<?php
defined('BASEPATH') or exit('No direct script access allowed');

class _Base_Model extends CI_Model
{
    function _Put($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST =>  'PUT',
                CURLOPT_POSTFIELDS =>  $value,
                CURLOPT_HTTPHEADER => array(
                    "secret-key: " . $this->school_setting->secret_key(),
                    "Authorization: " . $this->school_setting->bearer(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }

    function _Put_Form($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL =>  $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: multipart/form-data",
                ),
            ));

            $response = curl_exec($curl);

            return $response;
        } catch (Exception $err) {
            return false;
        }
    }
    function _Post_Form($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL =>  $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $value,
                CURLOPT_HTTPHEADER => array(
                    "secret-key: " . $this->school_setting->secret_key(),
                    "Authorization: " . $this->school_setting->bearer(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: multipart/form-data"
                ),
            ));

            $response = curl_exec($curl);

            return $response;
        } catch (Exception $err) {
            return false;
        }
    }
    function _Post($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST =>  'POST',
                CURLOPT_POSTFIELDS =>  $value,
                CURLOPT_HTTPHEADER => array(
                    "secret-key: " . $this->school_setting->secret_key(),
                    "Authorization: " . $this->school_setting->bearer(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            // var_dump($response);
            // die;
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }
    function _Get($PATH_API, $QUERY_PARAM = null)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL =>  $this->school_setting->base_url() . $PATH_API . $QUERY_PARAM,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST =>  'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }

    function _Delete($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST =>  "DELETE",
                CURLOPT_POSTFIELDS =>  $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }

    function _PostUpload($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: multipart/form-data"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }
    function _PutUpload($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: multipart/form-data"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }
    function _Put_Xform($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/x-www-form-urlencoded"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }

    function _Post_Xform($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->school_setting->base_url() . $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/x-www-form-urlencoded"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }

    // ============================== endpoin Local =====================================
    function _Get_local($PATH_API, $QUERY_PARAM = null)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $PATH_API . $QUERY_PARAM,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST =>  'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            return $response;
        } catch (Exception $err) {
            return false;
        }
    }
    // ================================ endpoin local ============================================
    function _Put_local($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST =>  'PUT',
                CURLOPT_POSTFIELDS =>  $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }

    // ================================ endPoin local =================

    function _Post_local($PATH_API, $value)
    {
        $curl = curl_init();
        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $PATH_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST =>  'POST',
                CURLOPT_POSTFIELDS =>  $value,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->school_setting->bearer(),
                    "secret-key: " . $this->school_setting->secret_key(),
                    "user-type: " . $this->session->userdata('user-type'),
                    "token: " . $this->session->userdata('token'),
                    "Content-Type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $err) {
            return false;
        }
    }
}
