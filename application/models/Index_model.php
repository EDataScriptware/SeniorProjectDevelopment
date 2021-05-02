<?php

class index_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	//Gets team list
	public function get_TeamList() {

		$currMission_id = $_SESSION["mission"];

		$this->db->select("*");
		$this->db->from('team');
		$this->db->where('mission_id', $currMission_id);

		$query = $this->db->get()->result();

		return $query;
	}

}
