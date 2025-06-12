<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function get_all_users()
    {
        return $this->db->get('users')->result_array();
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }
}
