<?php

class BusBookTeam_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_busbook_data() {
        
        $this->db->select("*");
        $this->db->from('bus_book_teams');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_busbookteam($id) {
        $this->db->select("*");
        $this->db->from('bus_book_teams');
        $this->db->where('team_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # GET
    public function getFields($id) {

        $fields = $this->db->list_fields('bus_book_team');
        $bus_book_team = $this->get_one_busbookteam($id);

        return $fields;
    }

    # PUT/Update
    public function updateBusBookTeamEntry($bus_book_team) {
        // the update statement to the DB that changes a bus entry.
        $bool = false;

        // updated values are passed in.
        $bus_book_teamID = $bus_book_team->bus_book_team_id;
      
        try
        {
            $this->db->where('bus_book_id', $bus_book_teamID);
            $this->db->update('bus_book', $bus_book_team); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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