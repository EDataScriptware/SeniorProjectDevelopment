<?php

class Mission_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_mission_data() {
        
        $this->db->select("*");
        $this->db->from('mission');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_mission($id) {
        $this->db->select("*");
        $this->db->from('mission');
        $this->db->where('mission_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # GET
    public function getFields($id) {

        $fields = $this->db->list_fields('mission');
        $mission = $this->get_one_mission($id);

        return $fields;
    }

    # PUT/Update
    public function updateMissionEntry($mission) {
        // the update statement to the DB that changes an entry.
        $bool = false;

        // updated values are passed in.
        $missionID = $mission->mission_id;
      
        try
        {
            $this->db->where('mission_id', $missionID);
            $this->db->update('mission', $mission); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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