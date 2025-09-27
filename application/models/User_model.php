<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $this->db->insert('users', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function get_by_email($email)
    {
        return $this->db->where('email', $email)->get('users')->row();
    }


}