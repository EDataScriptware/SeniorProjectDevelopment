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
        $this->db->order_by('mission_id', 'desc');

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
    public function getFields() {

        $fields = $this->db->list_fields('mission');

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
            $this->db->update('mission', $mission);
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

    public function unsetCurrentMission() {
        $this->db->set('show_on_front', 0);
        $this->db->update('mission') ;
    }

    public function setCurrentMission($mission_id) {
        $this->unsetCurrentMission();

        $this->db->set('show_on_front', 1);
        $this->db->where('mission_id', $mission_id) ;
        $this->db->update('mission') ;
    }
    

}