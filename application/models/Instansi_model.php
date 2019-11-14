<?php

class Instansi_model extends CI_model 
{
    public function get_instansi($instansi_id)
    {
        return $this->db->select("id,nama_instansi,alamat,username")->from("instansi")->where("id",$instansi_id)->get()->result();
    }

    public function get_pinjam()
    {
        $result = $this->db->select("pinjaman.id as id_pinjam,user.id as user_id,user.nama,user.nis,user.nisn,user.kelas,user.alamat,buku.id as buku_id,buku.judul_buku,buku.pengarang,buku.penerbit,buku.tahun")
                            ->from("pinjaman")
                            ->join("user", "user.id = pinjaman.id_siswa")
                            ->join("buku", "buku.id = pinjaman.id_buku")
                            ->get()->result();
        return $result;
    }

    public function insert_data_pinjam($data,$token)
    {
        if ($this->get_token($data['id_instansi']) == $token) {
            $cek = $this->db->select("jumlah")->from("buku")->where("id",$data['id_buku'])->get()->result();
            if($cek[0]->jumlah > 0){
                $insert = $this->db->insert("pinjaman",$data);
                if ($insert) {
                    return True;
                }
                return "Ada Kesalahan";
            }
            return "Maaf Buku Habis Dipinjam";
        }
        return "Token Missmatch";
    }

    public function delete_data_pinjam($token,$instansi_id,$pinjam_id)
    {
        if ($this->get_token($instansi_id) == $token) {
            $delete = $this->db->delete("instansi",["id",$pinjam_id]);
            if ($delete) {
                return True;
            }
            return "Ada Kesalahan";
        }
        return "Token Missmatch";
    }

    private function get_token($id_instansi)
    {
        $get_token = $this->db->select("token")->from("instansi")->where("id",$id_instansi)->get()->result();
        return $get_token[0]->token;
    }
}
