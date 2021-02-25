<?php

class Login_model {

	// public function __construct()
	// {
	// 	__construct();
	// }
    
	public function get_loginInfo() {
        
        $this->db->select("*");
        $this->db->from('veteran');

        $query = $this->db->get()->result();
        
        echo $query;

        return $query;
	}

}