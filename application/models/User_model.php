<?php

class User_model extends CI_model
{
    public function get_profile($user_id,$token)
    {
        if ($this->get_token($user_id) == $token) {
            $get_user = $this->db->select("id,nama,nis,nisn,kelas,alamat")->from("user")->get()->result();
            return $get_user;
        }else{
            return "Token Missmatch";
        }
    }

    public function get_all_buku()
    {
        $result = $this->db->select("id,judul_buku,pengarang,penerbit,tahun")->from("buku")->get()->result();
        return $result;

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

    public function get_all_booking($user_id,$token)
    {
        if($this->get_token($user_id) == $token)
        {
            $result = $this->db->select("booking.id as booking_id,user.id as user_id,user.nama,user.nis,user.nisn,user.kelas,user.alamat,buku.id as buku_id,buku.judul_buku,buku.pengarang,buku.penerbit,buku.tahun")
                            ->from("booking")
                            ->join("user", "user.id = booking.id_user")
                            ->join("buku", "buku.id = booking.id_buku")
                            ->get()->result();
            return $result;
        }
        return "Token Missmatch"; 
    }

    public function booking_buku($data)
    {
        $user_id = $data[0];
        $buku_id = $data[1];
        $token = $data[2];
        if ($this->get_token($user_id) == $token) {
            $now = date("Y-m-d");
            $late = date("Y-m-d", strtotime($now. '+ 1 days'));
            $cek = $this->db->select("jumlah")->from("buku")->where("id",$buku_id)->get()->result();
            if ($cek[0]->jumlah > 0) {
                $booking = $this->db->insert("booking",["id_user"=>$user_id,"id_buku"=>$buku_id,"tanggal_booking"=>$now,"tenggat_booking"=>$late]);
                if ($booking) {
                    return True;
                }
                return "Ada Kesalahan";
            }
            return "Buku Habis Dipinjam";
        }
        return "Token Missmatch";
    }

    public function delete_booking($data)
    {
        $booking_id = $data[0];
        $token = $data[1];
        $user_id = $data[2];
        if ($this->get_token($user_id) == $token) {
            $delete = $this->db->delete("booking", ["id"=>$booking_id]);
            if ($delete) {
                return True;
            }
            return "Ada Kesalahan";
        }
        return "Token Missmatch";
    }

    private function get_token($id_user)
    {
        $get_token = $this->db->select("token")->from("user")->where("id",$id_user)->get()->result();
        return $get_token[0]->token;
    }
}
