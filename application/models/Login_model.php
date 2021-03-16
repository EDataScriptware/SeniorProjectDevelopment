<?php

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
	public function get_loginInfo($username) {
        
        $this->db->select("*");
        $this->db->from('user');
		$this->db->where('username', $username);

        $query = $this->db->get()->result();

        return $query[0];
	}

}