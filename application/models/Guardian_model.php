<?php

class Guardian_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_guardian_data() {
        
        $this->db->select("*");
        $this->db->from('guardian');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_guardian($id) {
        $this->db->select("*");
        $this->db->from('guardian');
        $this->db->where('guardian_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # GET
    public function getFields($id) {

        $fields = $this->db->list_fields('guardian');
        $guardian = $this->get_one_guardian($id);

        return $fields;
    }

    # PUT/Update
    public function updateGuardianEntry($guardian) {
        // the update statement to the DB that changes an entry.
        $bool = false;

        // updated values are passed in.
        $guardianID = $guardian->guardian_id;
      
        try
        {
            $this->db->where('guardian_id', $guardianID);
            $this->db->update('guardian', $guardian); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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