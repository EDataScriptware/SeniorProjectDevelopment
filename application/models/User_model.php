<?php

class User_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_user_data() {
        
        $this->db->select("*");
        $this->db->from('user');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_user($id) {
        $this->db->select("*");
        $this->db->from('user');
        $this->db->where('iduser',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # GET
    public function getFields($id) {

        $fields = $this->db->list_fields('user');
        $user = $this->get_one_user($id);

        return $fields;
    }

    # PUT/Update
    public function updateUserEntry($user) {
        // the update statement to the DB that changes an entry.
        $bool = false;

        // updated values are passed in.
        $userID = $user->user_id;
      
        try
        {
            $this->db->where('iduser', $userID);
            $this->db->update('user', $user); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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