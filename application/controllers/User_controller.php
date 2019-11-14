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
        $user_id = $this->input->get("user_id");
        echo json_encode($this->User_model->get_profile($user_id,$token));
    }

    public function get_buku()
    {
        $get_buku = $this->User_model->get_all_buku();
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

    public function get_booking()
    {
        $token = $this->input->get("token");
        $user_id = $this->input->get("user_id");
        echo json_encode($this->User_model->get_all_booking($user_id,$token));
    }

    public function booking_buku()
    {
        $data = [
            $this->input->get("user_id"),
            $this->input->get("buku_id"),
            $this->input->get("token")
        ];
        $booking = $this->User_model->booking_buku($data);
        echo json_encode($booking);
    }

    public function delete_booking()
    {
        $data = [
            $this->input->get("booking_id"),
            $this->input->get("token"),
            $this->input->get("user_id")
        ];
        $delete_booking = $this->User_model->delete_booking($data);
        echo json_encode($delete_booking);
    }
}
