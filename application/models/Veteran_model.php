<?php

class Veteran_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    # GET ALL
	public function get_all_veteran_data() {
        
        $this->db->select("*");
        $this->db->from('veteran');

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

    # GET SPECIFIC
    public function get_one_veteran($id) {
        $this->db->select("*");
        $this->db->from('veteran');
        $this->db->where('veteran_id',$id);

        $query = $this->db->get()->result();

        return $query;
    }

    # POST
    public function getFields($id) {
        // create object that stores all veteran data.  Must be dynamically created (in case new DB fields are added)
        
        
        // $vetQuery = $this->db->query('SELECT * FROM veteran WHERE veteran_id = '.$id);
        // $numberOfFields = $vetQuery->num_fields();
        
        /*
            $fieldData = $query->fieldData();
            name - column name
            max_length - maximum length of the column
            primary_key - 1 if the column is a primary key
            type - the type of the column

       ------------------------------------------------------

            $query = $this->db->query('SELECT * FROM veteran WHERE veteran_id = '.$id);

            foreach ($query->list_fields() as $field)
            {
                echo $field;
            }
        */

        // $query = $this->get_one_veteran($id);
       
        // return $query->fieldData();

        // foreach ($fields as $field)
        // {
        //     echo $field;
        // }
        
        $fields = $this->db->list_fields('veteran');
        $veteran = $this->get_one_veteran($id);

        $data['fields'] = $fields;
        $data['veteran'] = $veteran;
        
        

        return $data;
    }

    # PUT
    public function updateVetEntry($vetObj) {
        // the update statement to the DB that changes a veteran entry.
        $bool = false;

        return $bool; // failed or successful
    }

}