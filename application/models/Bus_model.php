<?php

class Bus_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_bus_data() {
        
        $this->db->select("*");
        $this->db->from('bus');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_bus($id) {
        $this->db->select("*");
        $this->db->from('bus');
        $this->db->where('bus_id',$id);

        $query = $this->db->get()->result();

        return $query[0];
    }

    # GET BUSSES TIED TO SPECIFIC MISSION
    public function get_mission_bus_data($id) {
        $this->db->select("*");
        $this->db->from('bus');
        $this->db->where('mission_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_bus_teams($busid) {
        // $this->db->select("t.*") ;
        // $this->db->from("bus b") ;
        // $this->db->join("team t", "b.bus_id = t.bus_id") ;
        // $this->db->where("b.bus_id", $busid) ;
        $query = $this->db->query("SELECT t.*, concat(s.first_name,' ',l.last_name) AS leader, concat(s.first_name,' ',s.last_name) AS safety FROM team t LEFT JOIN guardian l on l.guardian_id = t.leader_id LEFT JOIN guardian s on s.guardian_id = t.hs_id WHERE t.bus_id = ".$busid);

        // $query = $this->db->get()->result();

        return $query->result();
    }

    # GET
    public function getFields() {

        $fields = $this->db->list_fields('bus');

        return $fields;
    }

    # PUT/Update
    public function updateBusEntry($bus) {
        // the update statement to the DB that changes a bus entry.
        $bool = false;

        // updated values are passed in.
        $busID = $bus->bus_id;
      
        try
        {
            $this->db->where('bus_id', $busID);
            $this->db->update('bus', $bus); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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