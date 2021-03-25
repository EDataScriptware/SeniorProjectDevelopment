<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$this->load->model('Index_model');
		$data['teams'] = $this->Index_model->get_TeamList();
        $this->load->view('user/template/header');
		$this->load->view('user/index', $data);
		$this->load->view('user/template/footer');
	}

    public function vetList() //Veterins List
	{
		$id = $this->uri->segment(2);
		$this->load->model('Veteran_model');

		$this->db->select_max("mission_id");
		$this->db->from('team');

		$currMission_id = implode($this->db->get()->row_array());

		if ($id != null) {
			$data['id'] = $id;
			$data['veteran'] = $this->Veteran_model->get_team_veteran_data($currMission_id, $id);

			$this->db->select("*");
			$this->db->from('team');
			$this->db->where('mission_id', $currMission_id);
	
			$data['team'] = $this->db->get()->result()[0];
		}
		else {
			$data['id'] = null;
			$data['veteran'] = $this->Veteran_model->get_mission_veteran_data($currMission_id);

			$this->db->select("*");
			$this->db->from('team');
			$this->db->where('mission_id', $currMission_id);
	
			$data['team'] = $this->db->get()->result();
		}

        $this->load->view('user/template/header');
		$this->load->view('user/vetList', $data);
		$this->load->view('user/template/footer');
	}

    public function vetView() //Individual Veterin View
	{
		$id = $this->uri->segment(2);
		// $id = $_GET["vet_id"];
		$this->load->model('Veteran_model');
	
		$data['veteran'] = $this->Veteran_model->get_one_veteran($id);

		$data['fields'] = $this->Veteran_model->getFields($id);
		// $data['vetObj2'] = $this->Veteran_model->updateVetEntry($id);
		$this->load->view('user/template/header');
		$this->load->view('user/vetView', $data);
		$this->load->view('user/template/footer');
	}

    public function crewView() //Crew View
	{
        $this->load->view('user/template/header');
		$this->load->view('user/crewView');
		$this->load->view('user/template/footer');
	}

    public function crisisView() //Crisis View
	{
        $this->load->view('user/template/header');
		$this->load->view('user/crisisView');
		$this->load->view('user/template/footer');
	}

    public function factView() //Factsheet view
	{
        $this->load->view('user/template/header');
		$this->load->view('user/factView');
		$this->load->view('user/template/footer');
	}

    public function itineraryView() //Itinerary Information
	{
        $this->load->view('user/template/header');
		$this->load->view('user/itinerary');
		$this->load->view('user/template/footer');
	}
}
