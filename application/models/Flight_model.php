<?php

class Flight_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_flight_data() {
        
        $this->db->select("*");
        $this->db->from('flight');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

        # GET MISSION SPECIFIC FLIGHT DATA
	public function get_mission_flight_data($id) {
        
        $this->db->select("*");
        $this->db->from('flight');
        $this->db->where('mission_id',$id);

        $query = $this->db->get()->result();
        
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_flight($id) {
        $this->db->select("*");
        $this->db->from('flight');
        $this->db->where('flight_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # GET
    public function getFields() {

        $fields = $this->db->list_fields('flight');

        return $fields;
    }

    # PUT/Update
    public function updateFlightEntry($flight) {
        // the update statement to the DB that changes a bus entry.
        $bool = false;

        // updated values are passed in.
        $flightID = $flight->flight_id;
      
        try
        {
            $this->db->where('flight_id', $flightID);
            $this->db->update('flight', $flight); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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