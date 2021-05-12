<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url_helper', 'form', 'url', 'directory', 'download'));
		$this->load->model('Index_model');

	}

	//Acts as the index function for the user side
	//if an ID is in the URI it'll show you information relevant to a specific team (AKA clicking on the team color in the dropdown)
	//If it isn't, it'll give you a detailed view that has all pertinant mission information
    public function vetList() 
	{
		$id = $this->uri->segment(2);
		$this->load->model('Veteran_model');
		$this->load->model('User_model');
		
		$currMission_id = $_SESSION["mission"];

		if ($id != null) {
			$data['id'] = $id;
			$data['veteran'] = $this->Veteran_model->get_team_veteran_data($currMission_id, $id);

			$this->db->select("*");
			$this->db->from('team');
			$this->db->where('team_id', $id);
	
			$data['team'] = $this->db->get()->result()[0];
		}
		else {
			$data['id'] = null;
			$data['veteran'] = $this->Veteran_model->get_mission_veteran_data($currMission_id);
			$data['user'] = $this->User_model->get_all_user_data();

			$this->db->select("*");
			$this->db->from('team');
			$this->db->where('mission_id', $currMission_id);
	
			$data['team'] = $this->db->get()->result();
		}


		$this->db->select("*");
		$this->db->from('bus');
		$this->db->where('mission_id', $currMission_id);

		$data['bus'] = $this->db->get()->result();

		$data['allTeams'] = $this->Index_model->get_TeamList();

        $this->load->view('user/template/header',$data);
		$this->load->view('user/vetList', $data);
		$this->load->view('user/template/footer');
	}
	//Grabs veteran ID from the URL and will display a detailed veteran view
    public function vetView() 
	{
		$id = $this->uri->segment(2);
		// $id = $_GET["vet_id"];
		$this->load->model('Veteran_model');
		$this->load->model('Flight_model');
	
		$data['veteran'] = $this->Veteran_model->get_one_veteran($id);
		$data['allTeams'] = $this->Index_model->get_TeamList();

		//gets their hotel info
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('veteran_id', $id);
		$data['hotel'] = $this->db->get()->result();

		//gets the guardian hotel info
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('guardian_id', $data['veteran'][0]->guardian_id);
		$data['gHotel'] = $this->db->get()->result();

		$currMission_id = $_SESSION["mission"];

		$data['flight'] = $this->Flight_model->get_mission_flight_data($currMission_id);

		$data['fields'] = $this->Veteran_model->getFields($id);
		// $data['vetObj2'] = $this->Veteran_model->updateVetEntry($id);
		$this->load->view('user/template/header',$data);
		$this->load->view('user/vetView', $data);
		$this->load->view('user/template/footer');
	}

    public function fileView() //all important files can be viewed here View
	{
		$data['allTeams'] = $this->Index_model->get_TeamList();

		$map = directory_map('./uploads/', 1);

		$this->load->view('user/template/header', $data);
		$this->load->view('user/fileView', array('error' => ' ', 'files' => $map));
		$this->load->view('user/template/footer');
	}
	//allows you to download a file
	public function download ($filename) {
		$file_path = "./uploads/";

		force_download(''.$file_path.$filename, NULL);                     
	}

    public function itineraryView() //Itinerary Information
	{
		$data['allTeams'] = $this->Index_model->get_TeamList();

		$currMission_id = $_SESSION["mission"];

		// $this->db->select("*");
		// $this->db->from('event');
		// $this->db->where('mission_id', $currMission_id);
		// $data['event'] = $this->db->get()->result();


        $this->load->view('user/template/header',$data);
		$this->load->view('user/itinerary',$data);
		$this->load->view('user/template/footer');
		
	}

	//updates a veterans information of the fly, because of how generic it is you can load it into veteran info editing form
	public function updateInfo($vetId) {

		$postData = $this->input->post();

		$this->db->where('veteran_id', $vetId);
		$this->db->update('veteran', $postData); 

		redirect('vetView/'.$vetId);


	}

	//updates a veterans hotel info
	public function updateHotelInfo($vetId) {

		$postData = $this->input->post();

		$this->db->where('veteran_id', $vetId);
		$this->db->update('hotel_info', $postData); 

		redirect('vetView/'.$vetId);

	}
	//updates a Guardians hotel info
	public function updateGuardianHotelInfo($guardId) {

		$postData = $this->input->post();

		$this->db->where('guardian_id', $guardId);
		$this->db->update('hotel_info', $postData); 

		redirect('vetView/'.$vetId);


	}

}
