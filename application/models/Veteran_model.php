<?php

class Veteran_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_veteran_data() {
        
        $this->db->select("*");
        $this->db->from('veteran');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_veteran($id) {
        $this->db->select("*");
        $this->db->from('veteran');
        $this->db->where('veteran_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # POST
    public function createVetObj($id) {
        // create object that stores all veteran data.  Must be dynamically created (in case new DB fields are added)
        $json = $this->get_one_veteran($id);

        return json_encode($json[0]);
    }

    # PUT
    public function updateVetEntry($vetObj) {
        // the update statement to the DB that changes a veteran entry.
        $bool = false;

        return $bool; // failed or successful
    }

}