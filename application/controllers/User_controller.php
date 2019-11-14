<?php
defined("BASEPATH") or exit("ERROR");

class User_controller extends CI_controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
    }

    public function profile()
    {
        $token = $this->input->get("token");
        echo json_encode($this->User_model->get_profile($token));
    }

    public function get_buku()
    {
        $data = [
            $this->input->get("user_id"),
            $this->input->get("token")
        ];
        $get_buku = $this->User_model->get_all_buku($data);
        echo json_encode($get_buku);
    }

    public function search_buku()
    {
        $data = [
            $this->input->get("user_id"),
            $this->input->get("keyword"),
            $this->input->get("token")
        ];
        $get_buku = $this->User_model->search_buku($data);
        echo json_encode($get_buku);
    }

    public function booking_buku()
    {
        $data = [
            $this->input->get("user_id"),
            $this->input->get("buku_id"),
            $this->input->get("token")
        ];
        $booking = $this->User_model->booking_buku($data);
        return $booking;
    }
}
