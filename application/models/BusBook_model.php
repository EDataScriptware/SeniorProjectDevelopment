<?php

class BusBook_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_busbook_data() {
        
        $this->db->select("*");
        $this->db->from('bus_book');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_busbook($id) {
        $this->db->select("*");
        $this->db->from('bus_book');
        $this->db->where('bus_book_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # GET
    public function getFields() {

        $fields = $this->db->list_fields('bus_book');

        return $fields;
    }

    public function createBook($data) {

        $notes = $data['notes'];
        
        unset($data['notes']);

        $this->db->insert('mission', $data) ;
        $insert_id = $this->db->insert_id();

        $book_data = array(
            "mission_id" => $insert_id,
            "start" => $data['start_date'],
            "end" => $data['end_date'],
            "notes" => $notes
        );

        $this->db->insert('bus_book', $book_data) ;
    }

    # PUT/Update
    public function updateBusBookEntry($bus_book) {
        // the update statement to the DB that changes a bus entry.
        $bool = false;

        // updated values are passed in.
        $bus_bookID = $bus_book->bus_book_id;
      
        try
        {
            $this->db->where('bus_book_id', $bus_bookID);
            $this->db->update('bus_book', $bus_book); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
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