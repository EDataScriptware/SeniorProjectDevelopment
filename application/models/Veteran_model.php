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

        # GET MISSION SPECIFIC
	public function get_mission_veteran_data($mission) {
        
        $this->db->select("*");
        $this->db->from('veteran');
        $this->db->where('mission_id',$mission);

        $query = $this->db->get()->result();
        
        
        // echo json_encode($query);

        return $query;
	}


        # GET TEAM SPECIFIC
	public function get_team_veteran_data($mission, $team) {
        
        $this->db->select("*");
        $this->db->from('veteran');
        $this->db->where('mission_id',$mission);
        $this->db->where('team_id',$team);

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

    # GET
    public function getFields($id) {

        $fields = $this->db->list_fields('veteran');
        $veteran = $this->get_one_veteran($id);

        return $fields;
    }

    # PUT/Update
    public function updateVetEntry($vet) {
        // the update statement to the DB that changes a veteran entry.
        $bool = false;

        // updated values are passed in.
        $vetID = $vet->veteran_id;
      
        try
        {
            $this->db->where('id', $vetID);
            $this->db->update('veteran', $vet); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
            $bool = true;
        } 
        catch (Exception $e)
        {
            // REMOVE AFTER DEVELOPMENT FOR SECURITY REASONS:
            echo "Exception: " . $e;            
            $bool = false;
        }
        
        return $bool; // failed or successful
    }

}