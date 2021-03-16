<?php

class index_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_TeamList() {

		$this->db->select_max("mission_id");
		$this->db->from('team');

		$currMission_id = $this->db->get()->row_array();

		$this->db->select("*");
		$this->db->from('team');
		$this->db->where('mission_id', implode($currMission_id));

		$query = $this->db->get()->result();

		return $query;
	}

}
