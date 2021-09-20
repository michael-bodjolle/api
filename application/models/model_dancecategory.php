<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_event extends CI_Model
{

    public function get_user()
    {
        $query = $this->db->get("dance_category");
        return $query->result();
    }

    public function insert_user($data)
    {
        return $this->db->insert('dance_category', $data);
    }

    public function edit_user($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('dance_category');
        return $query->row();
    }

    public function update_user($data, $id = 0)
    {
        $this->db->where('id', $id);
        $this->db->update('dance_category', $data);
    }

    public function delete_user($id)
    {
        return $this->db->delete('dance_category', ['id' => $id]);
    }
}

?>