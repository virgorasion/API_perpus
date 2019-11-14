<?php
defined("BASEPATH") or exit("Error");

class Auth extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Auth_model");
    }

    public function user_login()
    {
        $akses = $this->input->get("akses");
        if ($akses == "user") {
            $nis = $this->input->post("nis");
            $password = $this->input->post("password");
            $cek = $this->Auth_model->verify($akses,$nis, $password);
            echo json_encode($cek);
        }elseif ($akses == "instansi") {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $cek = $this->Auth_model->verify($akses,$username, $password);
            echo json_encode($cek);
        }
    }
}

