<?php

class Auth_model extends CI_model 
{
    public function verify($akses,$username,$password)
    {
        if ($akses == "user") {
            $cek = $this->db->get_where("user",["nis" => $username])->result();
            if ($cek != NULL) {
                $cek_password = password_verify($password,$cek[0]->password);
                if ($cek_password == true) {
                    $token = $this->generate_token($akses,["nis"=>$username]);
                    $result = [
                        "status" => 200,
                        "login" => True,
                        "token" => $token,
                        "user_id" => $cek[0]->id
                    ];
                    return $result;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }elseif ($akses == "instansi") {
            $cek = $this->db->get_where("instansi",["username" => $username])->result();
            if ($cek != NULL) {
                $cek_password = password_verify($password,$cek[0]->password);
                if ($cek_password == true) {
                    $token = $this->generate_token($akses,["username"=>$username]);
                    $result = [
                        "status" => 200,
                        "login" => True,
                        "token" => $token,
                        "instansi_id" => $cek[0]->id
                    ];
                    return $result;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    private function generate_token($akses, $data)
    {
        $generate_token = rand(0000000,999999);
        $result = md5($generate_token);
        $this->db->where("id",$get_id[0]->id);
        $this->db->update($akses,["token"=>$result]);
        return $result;
    }

    private function get_token($akses,$id_user)
    {
        $get_token = $this->db->select("token")->from($akses)->where("id",$id_user)->get()->result();
        return $get_token[0]->token;
    }
}
