<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_user extends CI_Model
{

    public function get_user()
    {
        $query = $this->db->get("users");
        return $query->result();
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }
    public function lastInsert(){
        return $this->db->insert_id();
    }
    public function edit_user($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function update_user($data, $id = 0)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }
    public function getLogin($email)
    {
        $this->db->where('email', $email);

        $query = $this->db->get('users');

        return  $query->row_array();
    }
}

?>