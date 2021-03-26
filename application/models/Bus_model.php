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

        return $query;
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