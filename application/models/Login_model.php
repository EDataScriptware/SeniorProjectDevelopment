<?php

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
	public function get_loginInfo() {
        
        $this->db->select("*");
        $this->db->from('veteran');

        $query = $this->db->get()->result_array();
        
        echo implode(" | ",$query);

        return $query;
	}

}