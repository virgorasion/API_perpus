<?php 
defined("BASEPATH")or exit("ERROR");

class Instansi_controller extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Instansi_model");
    }

    public function profile()
    {
        $instansi_id = $this->input->get("instansi_id");
        $get_profile = $this->Instansi_model->get_instansi($instansi_id);
        echo json_encode($get_profile);
    }

    public function get_data_pinjam()
    {
        $get_data = $this->Instansi_model->get_pinjam();
        echo json_encode($get_data);
    }

    public function pinjam_buku()
    {
        $now = date("Y-m-d");
        $token = $this->input->get("token");
        $data = [
            "id_siswa" => $this->input->get("siswa_id"),
            "id_buku" => $this->input->get("buku_id"),
            "status" => 0,
            "tanggal_pinjam" => $now,
            "tanggal_kembali" => date("Y-m-d", strtotime($now. '+ 5 days')),
            "created_at" => $now,
            "updated_at" => $now,
            "deleted_status" => 0
        ];
        $insert = $this->Instansi_model->insert_data_pinjam($data,$token);
        echo json_encode($insert);
    }

    public function delete_buku()
    {
        $token = $this->input->get("token");
        $instansi_id = $this->input->get("instansi_id");
        $pinjam_id = $this->input->get("pinjam_id");
        $delete = $this->Instansi_model->delete_data_instansi($token,$instansi_id,$pinjam_id);
        echo json_encode($delete);
    }

    public function logout()
    {
        $instansi_id = $this->input->get("instansi_id");
        $this->session->sess_destroy();
        $update = $this->db->update("instansi",["token"=>""],["id"=>$instansi_id]);
        if ($update) {
            return True;
        }
        return "Ada Kesalahan";
    }
}
