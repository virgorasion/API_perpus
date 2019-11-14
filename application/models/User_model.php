<?php

class User_model extends CI_model
{
    public function get_profile($token)
    {
        $get_user = $this->db->select("id,nama,nis,nisn,kelas,alamat")->from("user")->get()->result();
        return $get_user;
    }

    public function get_all_buku($data)
    {
        $user_id = $data[0];
        $token = $data[1];
        if ($this->get_token($user_id) == $token) {
            $result = $this->db->select("id,judul_buku,pengarang,penerbit,tahun")->from("buku")->get()->result();
            if ($result == NULL) {
                return "Buku Tidak Ditemukan";
            }
            return $result;
        }
        return "Token Invalid";
    }
    
    public function search_buku($data)
    {
        $user_id = $data[0];
        $keyword = $data[1];
        $token = $data[2];
        if ($this->get_token($user_id) == $token) {
            $result = $this->db->select("id,judul_buku,pengarang,penerbit,tahun,jumlah")->from("buku")->like(["judul_buku"=>$keyword])->or_like(["pengarang"=>$keyword])->or_like(["penerbit"=>$keyword])->get()->result();
            if ($result == NULL) {
                return "Buku Tidak Ditemukan";
            }
            return $result;
        }
        return "Token Invalid";
    }

    public function booking_buku($data)
    {
        $user_id = $data[0];
        $buku_id = $data[1];
        $token = $data[2];
        if ($this->get_token($user_id) == $token) {
            $now = date("Y-m-d");
            $late = date("Y-m-d", strtotime($now. '+ 1 days'));
            $booking = $this->db->insert("booking",["id_user"=>$user_id,"id_buku"=>$buku_id,"tanggal_booking"=>$now,"tenggat_booking"=>$late]);
        }
    }

    private function get_token($id_user)
    {
        $get_token = $this->db->select("token")->from("user")->where("id",$id_user)->get()->result();
        return $get_token[0]->token;
    }
}
