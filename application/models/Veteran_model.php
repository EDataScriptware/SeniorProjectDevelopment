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

    #GET ALL SPECIFIC
    public function get_veterans_by_fields($fieldList, $mission = null, $team = null) {
        $selectString = "";
        $maxVal = count($fieldList)-1;
        $counter = 0; 
        foreach($fieldList as $field)
        {
            
            if ($counter != $maxVal)
            {
                $selectString .= $field . ",";
            }
            else
            {
                $selectString .= $field;
            }
            $counter += 1;
        }
        
        $this->db->select($selectString);
        $this->db->from('veteran');

        if($mission != null) {
            $this->db->where('mission_id', $mission);
        }

        if($team != null) {
            $this->db->where('team_id',$team);
        }

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
    }

        # GET MISSION SPECIFIC
	public function get_mission_veteran_data($mission) {
        
        $this->db->select("*");
        $this->db->from('veteran');
        $this->db->where('mission_id',$mission);

        $query = $this->db->get()->result();
        
        // echo json_encode($query);

        return $query;
	}

        # GET TEAM SPECIFIC
	public function get_team_veteran_data($mission, $team) {
        
        $this->db->select("*");
        $this->db->from('veteran');
        $this->db->where('mission_id',$mission);
        $this->db->where('team_id',$team);

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

    # GET
    public function getFields() {

        $fields = $this->db->list_fields('veteran');

        return $fields;
    }

    # PUT/Update
    public function updateVetEntry($vet) {
        // the update statement to the DB that changes a veteran entry.
        $bool = false;

        // updated values are passed in.
        $vetID = $vet["veteran_id"];

        // if($vet["guardian_id"] === "") {
        //     $vet["guardian_id"] = null;
        // }

        // if($vet["bus_id"] === "") {
        //     $vet["bus_id"] = null ;
        // }

        // if($vet["mission_id"] === "") {
        //     $vet["mission_id"] = null;
        // }

        // if($vet["team_id"] === "") {
        //     $vet["team_id"] = null;
        // }

        // The below sets all empty strings to NULL
        foreach($vet as $key => $value) {
            if($value === "") {
                $vet[$key] = null;
            }
        }
    
        try
        {
            $this->db->where('veteran_id', $vetID);
            $this->db->update('veteran', $vet); 
            $bool = true;
        } 
        catch (Exception $e)
        {
            echo "Exception: " . $e; // <-- REMOVE AFTER DEVELOPMENT FOR SECURITY REASONS
            $bool = false;
        }
        
        return $bool; // failed or successful
    }
}