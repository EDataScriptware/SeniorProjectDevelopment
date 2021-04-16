<?php

class Team_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_team_data() {
        
        $this->db->select("*");
        $this->db->from('team');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_team($id) {
        $this->db->select("*");
        $this->db->from('team');
        $this->db->where('team_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # GET
    public function getFields() {

        $fields = $this->db->list_fields('team');

        return $fields;
    }

    # PUT/Update
    public function updateTeamEntry($team) {
        // the update statement to the DB that changes an entry.
        $bool = false;

        // updated values are passed in.
        $teamID = $team->team_id;
      
        try
        {
            $this->db->where('team_id', $teamID);
            $this->db->update('team', $team); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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

    public function createTeam($mission_id, $bus_id, $leader_id, $hs_id, $color) {
        
    }
    

}