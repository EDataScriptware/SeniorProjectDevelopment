<?php

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Helpers are little libraries that make some things easier, it's a bit difficult to explain in text so go here https://codeigniter.com/userguide3/general/helpers.html
		$this->load->helper(array('url_helper', 'form', 'url', 'directory', 'download'));
	}

	
	public function busBookView()  //generates the busBookView
	{
		$this->load->model('Mission_model');
		$this->load->model('Bus_model');

		$missions = $this->Mission_model->get_all_mission_data();
		
		$data['bus_book_data'] = [];

		foreach($missions as $mission) {

			$bus_data = $this->Bus_model->get_mission_bus_data($mission->mission_id);

			if($bus_data) {
				$mission->bus = $bus_data;
				array_push($data['bus_book_data'], $mission);
			}
			else {
				array_push($data['bus_book_data'], $mission);
			}
			
		}

		$this->load->view('admin/template/header');
		$this->load->view('admin/busbook', $data);
		$this->load->view('admin/template/footer');
	}

	//generates the mission PDF based on a python script.
	public function buildVetPdf() {
		$cmd = "python3 scripting/pdf_writer.py";

		$test = exec($cmd);

		redirect('documents') ;
	}

	public function docView() //Generates the Document View
	{
		$currMission_id = $_SESSION["mission"];

		$map = directory_map('./uploads/', 1);


		$this->load->view('admin/template/header');
		$this->load->view('admin/documents', array('error' => ' ', 'files' => $map));
		$this->load->view('admin/template/footer');
	}

	public function editBus($busid) {
		if(isset($busid)) {
			$this->load->model('Bus_model');
			$this->load->model('Guardian_model');

			$data['team_data'] = $this->Bus_model->get_bus_teams($busid);
			$data['bus_data'] = $this->Bus_model->get_one_bus($busid);
			$data['leader_data'] = $this->Guardian_model->get_all_guardian_data();

			$this->load->view('admin/template/header');
			$this->load->view('admin/editBus', $data);
			$this->load->view('admin/template/footer');

		}
		else {
			redirect('busbook') ;
		}
	}

	public function setMission($mission_id) {
		echo "set current mission: ".$mission_id ;
	}

	public function deleteBus($bus_id) {
		if(isset($bus_id)) {
			$this->load->model('Bus_model');

			$this->Bus_model->deleteBus(intval($bus_id)) ;
		}

		redirect('busbook') ;
	}

	public function createTeam($busid) {
		if($this->input->post('submit') != NULL) {
			$postData = $this->input->post();

			$this->load->model('Team_model') ;

			if(isset($postData["submit"])) {
				unset($postData["submit"]) ;
			}

			$color = null ;
			$leader_id = null ;
			$hs_id = null ;
			$mission_id = null ;

			foreach($postData as $key => $value) {
				switch ($key) {
					case "color":
						$color = $value;
						break;

					case "leader_id":
						$leader_id = $value;
						break;

					case "hs_id":
						$hs_id = $value;
						break;

					case "mission_id":
						$mission_id = $value;
						break;
				}
			}

			$this->Team_model->createTeam($mission_id, $busid, $leader_id, $hs_id, $color);
		}
		redirect('admin/editBus/'.$busid) ;
	}

	public function deleteTeam($tid, $busid) {
		$this->load->model("Team_model");

		$this->Team_model->deleteTeam(intval($tid));
		
		redirect('admin/editBus/'.$busid) ;
	}
	//Handles file upload
	public function do_upload() {

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = '*';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('fileToUpload'))
		{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('admin/template/header');
				$this->load->view('admin/documents', $error);
				$this->load->view('admin/template/footer');
		}
		else
		{
				$data = array('upload_data' => $this->upload->data());

				$this->load->view('admin/template/header');
				$this->load->view('admin/upload_success', $data);
				$this->load->view('admin/template/footer');
		}
	}
	//locates the selected file and downloads it for you
	public function download ($filename) {
		$file_path = "./uploads/";

		force_download(''.$file_path.$filename, NULL);                     
	}
	//locates the selected file and deletes it for you
	public function deleteFile($filename) {
		$directory = "./uploads/" ;

		unlink($directory.''.$filename) ;

		redirect('documents') ;
	}

	public function teamView() //Team View
	{
		$this->load->model('User_model');
		$this->load->model('Veteran_model');
		$this->load->model('Bus_model');

		$currMission_id = $_SESSION["mission"]; 

		$data['veteran'] = $this->Veteran_model->get_mission_veteran_data($currMission_id);
		$data['bus'] = $this->Bus_model->get_mission_bus_data($currMission_id);
		$data['user'] = $this->User_model->get_all_user_data();
		$data['id'] = $currMission_id;

		$this->db->select("*");
		$this->db->from('team');
		$this->db->where('mission_id', $currMission_id);

		$data['team'] = $this->db->get()->result();

		$this->load->view('admin/template/header');
		$this->load->view('admin/teams' , $data);
		$this->load->view('admin/template/footer');
	}
	public function userView() //User View
	{	

		$this->load->model('User_model');
		$this->load->model('Team_model');
		$this->load->model('Bus_model');
		
		$currMission_id = $_SESSION["mission"];

		$data['user'] = $this->User_model->get_all_user_data();
		$data['bus'] = $this->Bus_model->get_all_bus_data();
		$data['team'] = $this->Team_model->get_all_team_data();
		$data['id'] = $currMission_id;

		$this->load->view('admin/template/header');
		$this->load->view('admin/users', $data);
		$this->load->view('admin/template/footer');
	}
	public function resView() //Reservation View
	{

		$this->load->model('Flight_model');
		$this->load->model('Veteran_model');
		$this->load->model('Guardian_model');
		$currMission_id = $_SESSION["mission"];

		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('mission_id', $currMission_id);
		$data['hotel'] = $this->db->get()->result();

		$this->db->select("*");
		$this->db->from('team');
		$this->db->where('mission_id', $currMission_id);

		$data['team'] = $this->db->get()->result();

		$data['flight'] = $this->Flight_model->get_mission_flight_data($currMission_id);
		$data['veteran'] = $this->Veteran_model->get_mission_veteran_data($currMission_id);
		$data['guardian'] = $this->Guardian_model->get_all_guardian_data();

		$this->load->view('admin/template/header');
		$this->load->view('admin/reservations', $data);
		$this->load->view('admin/template/footer');
	}

	public function vetView() //Crew View
	{

		$this->load->model('Veteran_model');
		$this->load->model('Team_model');

		$currMission_id = $_SESSION["mission"];

		$data['veteran'] = $this->Veteran_model->get_all_veteran_data();
		$data['team'] = $this->Team_model->get_all_team_data();
		$data['id'] = $currMission_id;

	

		$this->load->view('admin/template/header');
		$this->load->view('admin/veteran', $data);
		$this->load->view('admin/template/footer');
	}

	public function guardView() //Crew View
	{
		$this->load->model('Guardian_model');
		$this->load->model('Team_model');

		$currMission_id = $_SESSION["mission"];

		$data['guardian'] = $this->Guardian_model->get_all_guardian_data();
		$data['team'] = $this->Team_model->get_all_team_data();
		$data['id'] = $currMission_id;

		$this->load->view('admin/template/header');
		$this->load->view('admin/guardian', $data);
		$this->load->view('admin/template/footer');
	}


	//updates a specific veteran entry, and updates the last time it was edited
	public function updateVeteran($id) {
		$postData = $this->input->post();
		$currTime = date("Y-m-d h:i:s");
		$data = array('last_updated' => $currTime);

		$this->db->where('veteran_id', $id);
		$this->db->update('veteran', $postData); 

		$this->db->where('veteran_id', $id);
		$this->db->update('veteran', $data); 

		redirect('veterans');
	}

	//updates a specific Guardian entry, and updates the last time it was edited
	public function updateGuard($id) {
		$postData = $this->input->post();
		$currTime = date("Y-m-d h:i:s"); 
		$data = array('last_updated' => $currTime);

		$this->db->where('guardian_id', $id);
		$this->db->update('guardian', $postData); 

		$this->db->where('guardian_id', $id);
		$this->db->update('guardian', $data); 

		redirect('guardians');
	}

	//BEGIN - USER RELATED FUNCTIONS

	//Creates a new user
	public function addUser() {
		$postData = $this->input->post();

		$newUser = array(
			'user_type' => $this->input->post('user_type'),
			'user_permissions' => $this->input->post('user_permissions'),
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'team_id' => $this->input->post('team_id'),
			'notes' => $this->input->post('notes'),
		);

		$this->db->insert('user', $newUser); 

		redirect('users');

	}

	//Deletes a specific user
	public function  deleteUser() {
		$id = $this->input->post('id');

		$this->db->where('iduser', $id);
		$this->db->delete('team');
	}

	//Updates user entry
	public function updateUser($id) {
		$postData = $this->input->post();

		$newPass = $postData['pass_reset'];
		unset($postData['pass_reset']);

		if(strlen($newPass) >= 4) {
			$postData['password'] = password_hash($newPass, PASSWORD_DEFAULT);
		}

		$this->db->where('iduser', $id);
		$this->db->update('user', $postData); 

		redirect('users');
	}


	//gets a specific user for editing purposes
	public function getUser() {
		$this->load->model('User_model');
		$id = $this->input->post('id');
		$data = $this->User_model->get_one_user($id);

        echo json_encode($data);
	}

	//END USER RELAATED FUNCTIONS

	//GETTERS
	 
	//gets a specific veteran for editing purposes
	public function getVet() {
		$this->load->model('Veteran_model');
		$id = $this->input->post('id');
		
		$data = $this->Veteran_model->get_one_veteran($id);
		
		echo json_encode($data);
	}

	//gets a specific Guardian for editing purposes
	public function getGuard() {
		$this->load->model('Guardian_model');
		$id = $this->input->post('id');
		
		$data = $this->Guardian_model->get_one_guardian($id);
		
		echo json_encode($data);
	}

	//END GETTERS

	//MOVERS
	
	//Moves a user to a specific bus
	public function moveUser($id) {
		$bus_id = $this->input->post('bus_id');

		$data = array('bus_id' => $bus_id);

		$this->db->where('iduser', $id);
		$this->db->update('user', $data); 
		redirect('teams');

	}
	//Moves a user to a specific team
	public function moveVeteran($id) {
		
		$team_id = $this->input->post('team_id');

		$data = array('team_id' => $team_id);

		$this->db->where('veteran_id', $id);
		$this->db->update('veteran', $data); 
		redirect('teams');
	}
	//Moves a team to a specific bus
	public function moveTeam($id) {
		$bus_id = $this->input->post('bus_id');

		$data = array('bus_id' => $bus_id);

		$this->db->where('team_id', $id);
		$this->db->update('team', $data); 
		redirect('teams');
	}

	//END MOVERS

	//Depending on the type passed over in the AJAX query it'll either remove:
	//A User from their bus
	//A Veteran from their team
	//And then send them to the "uncatigorized" section
	public function removeType() {
		$id = $this->input->post('id');
		$type = $this->input->post('type');

		if ($type === "staff") {
			$data = array('bus_id' => null);

		$this->db->where('iduser', $id);
		$this->db->update('user', $data); 

		}
		else if ($type === "veteran") {
			$data = array('team_id' => null);

			$this->db->where('veteran_id', $id);
			$this->db->update('veteran', $data); 
		}
	}

	//RESERVATIONS RELATED FUNCTIONS

	//Takes in a specific $type and will either add a new Hotel entry, or add a new flight entry
	public function addEvent($type) {

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

		switch ($type) {
			case 'fly':
				$airline = $this->input->post('newAirline');
				$flight_number = $this->input->post('newFlight_number');
				$arrival = $this->input->post('newArrival');
				$arrival_location = $this->input->post('newArrival_location');
				$departure = $this->input->post('newDeparture');
				$departure_location = $this->input->post('newDeparture_location');

				$data = array(
					'airline' => $airline,
					'flight_number' => $flight_number,
					'arrival' => $arrival,
					'arrival_location' => $arrival_location,
					'departure' => $departure,
					'departure_location' => $departure_location,
					'mission_id' => $currMission_id,
				);

				$this->db->insert('flight', $data); 

				break;
			case 'hotel':
				$name = $this->input->post('newName');
				$veteran_id = $this->input->post('newVeteran_id');
				$room = $this->input->post('newRoom');
				$check_in = $this->input->post('newCheck_in');
				$check_out = $this->input->post('newCheck_out');

				$data = array(
					'name' => $name,
					'veteran_id' => $veteran_id,
					'room' => $room,
					'check_in' => $check_in,
					'check_out' => $check_out,
					'mission_id' => $currMission_id,
				);

				$this->db->insert('hotel_info', $data); 

				break;
		}
		redirect('reservations');
	}

	//Takes in a specific $type and will either edit a flight or Hotel entry	
	public function editEvent($id,$type) {
		$postData = $this->input->post();
		switch ($type) {
			case 'fly':
				$this->db->where('flight_id', $id);
				$this->db->update('flight',$postData);
				break;
			case 'hotel':
				$this->db->where('hotel_id', $id);
				$this->db->update('hotel_info',$postData);
				break;
		}
		redirect('reservations');
	}

	public function getEvent() {
		$id = $this->input->post('id');
		$type = $this->input->post('type');


		switch ($type) {
			case 'fly':
				$this->db->where('flight_id', $id);
				$data =	$this->db->get('flight')->result();
				break;
			case 'hotel':
				$this->db->where('hotel_id', $id);
				$data =	$this->db->get('hotel_info')->result();
				break;
		}

		echo json_encode($data);
		
	}

	//Takes in a specific $type and will either remove a flight or Hotel entry
	public function removeEvent() {
		$id = $this->input->post('id');
		$type = $this->input->post('type');


		switch ($type) {
			case 'fly':
				$this->db->where('flight_id', $id);
				$this->db->delete('flight');
				break;
			case 'hotel':
				$this->db->where('hotel_id', $id);
				$this->db->delete('hotel_info');
				break;
		}
		redirect('reservations');
	}

	//Changes the mission you're currently browsing.
	public function changeMission() {
		$id = $this->input->post('id');
		$_SESSION['mission'] = $id;
	}

}
