<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_event extends CI_Model
{

    public function get_event()
    {
        $query = $this->db->get("events");
        return $query->result();
    }

    public function insert_event($data)
    {
        return $this->db->insert('events', $data);
    }

    public function edit_event($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('events');
        return $query->row();
    }

    public function update_event($data, $id = 0)
    {
        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }

    public function delete_event($id)
    {
        return $this->db->delete('events', ['id' => $id]);
    }
}

?>