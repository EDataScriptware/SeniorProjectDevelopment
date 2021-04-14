<?php

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url_helper', 'form', 'url', 'directory', 'download'));
	}

	public function index() // Bus book View
	{
		$this->load->model('Veteran_model');
		$data['queryData'] = $this->Veteran_model->get_all_veteran_data(); //3700
		$data['vetFields'] = $this->Veteran_model->getFields();

        $this->load->view('admin/template/header');
		$this->load->view('admin/index', $data);
		$this->load->view('admin/template/footer');
	}

	public function busBookView() {
		$this->load->model('BusBook_model');
		$this->load->model('Bus_model');

		$bus_books = $this->BusBook_model->get_all_busbook_data();
		
		$data['bus_book_data'] = [];

		foreach($bus_books as $bus_book) {

			$bus_data = $this->Bus_model->get_mission_bus_data($bus_book->mission_id);

			if($bus_data) {
				$bus_book->bus = $bus_data;
				array_push($data['bus_book_data'], $bus_book);
			}
			else {
				array_push($data['bus_book_data'], $bus_book);
			}
			
		}

		$this->load->view('admin/template/header');
		$this->load->view('admin/busbook', $data);
		$this->load->view('admin/template/footer');
	}

	public function buildVetPdf() {
		$cmd = "python3 scripting/pdf_writer.py";

		$output = shell_exec($cmd);

		$this->docView();
		echo $output;
	}

	public function docView() //Document View
	{

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

		$map = directory_map('./uploads/', 1);


		$this->load->view('admin/template/header');
		$this->load->view('admin/documents', array('error' => ' ', 'files' => $map));
		$this->load->view('admin/template/footer');
	}

	public function do_upload() {

		$config['upload_path']          = './uploads/';
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

	public function download ($filename) {
		$file_path = "./uploads/";

		force_download(''.$file_path.$filename, NULL);                     
	}

	public function teamView() //Team View
	{
		$this->load->model('User_model');
		$this->load->model('Veteran_model');
		$this->load->model('Bus_model');

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

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
		

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

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


		$this->db->select_max("mission_id");
		$this->db->from('team');

		$currMission_id = implode($this->db->get()->row_array());
		$data['id'] = $currMission_id;

		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('mission_id', $currMission_id);
		$data['hotel'] = $this->db->get()->result();

		$this->db->select("*");
		$this->db->from('event');
		$this->db->where('mission_id', $currMission_id);
		$data['event'] = $this->db->get()->result();

		
		$this->db->select("*");
		$this->db->from('team');
		$this->db->where('mission_id', $currMission_id);

		$data['team'] = $this->db->get()->result();

		$data['flight'] = $this->Flight_model->get_mission_flight_data($currMission_id);
		$data['veteran'] = $this->Veteran_model->get_mission_veteran_data($currMission_id);

		$this->load->view('admin/template/header');
		$this->load->view('admin/reservations', $data);
		$this->load->view('admin/template/footer');
	}

	public function vetView() //Crew View
	{

		$this->load->model('Veteran_model');
		$this->load->model('Team_model');

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

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

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

		$data['guardian'] = $this->Guardian_model->get_all_guardian_data();
		$data['team'] = $this->Team_model->get_all_team_data();
		$data['id'] = $currMission_id;

		$this->load->view('admin/template/header');
		$this->load->view('admin/guardian', $data);
		$this->load->view('admin/template/footer');
	}

	public function vetQueryView() {
		$this->load->model('Veteran_model');

		if($this->input->post('submit') != NULL) {
			$postData = $this->input->post();


			if(isset($postData["submit"])) {
				unset($postData["submit"]) ;
			}

			$fields = [];
			$mission_id = null;
			$team_id = null;

			foreach($postData as $key => $value) {
				if($key == "mission_query") {
					if(is_numeric($value)) {
						$mission_id = $value;
					}
				} else if($key == "team_query") {
					if(is_numeric($value)) {
						$team_id = $value;
					}
				}
				else {
					array_push($fields, $key);
				}
			}

			$data['vetData'] = $this->Veteran_model->get_veterans_by_fields($fields, $mission_id, $team_id);
			$data['fields'] = $fields;

			$this->load->view('admin/template/header');
			$this->load->view('admin/vetQuery', $data);
			$this->load->view('admin/template/footer');

		} else {
			$this->load->view('admin/template/header');
			$this->load->view('admin/index');
			$this->load->view('admin/template/footer');
		}
	}

	public function updateVet() {
		$this->load->model('Veteran_model');

		if($this->input->post('submit') != NULL) {
			$postData = $this->input->post();


			if(isset($postData["submit"])) {
				unset($postData["submit"]) ;
			}

			echo json_encode($postData);

			if($this->Veteran_model->updateVetEntry($postData)) {
				echo "Veteran Updated Successfully |  Route Admin Somewhere.";
			}
			else {
				echo "Veteran Updated Unsuccessfully | Route Admin Somewhere.";
			}
		}

	}

	public function updateUser($id) {
		$postData = $this->input->post();

		$this->db->where('iduser', $id);
		$this->db->update('user', $postData); 

		redirect('users');
	}

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

	public function getUser() {
		$this->load->model('User_model');
		$id = $this->input->post('id');
		$data = $this->User_model->get_one_user($id);

        echo json_encode($data);
	}


	public function getVet() {
		$this->load->model('Veteran_model');
		$id = $this->input->post('id');
		
		$data = $this->Veteran_model->get_one_veteran($id);
		
		echo json_encode($data);
	}

	public function getGuard() {
		$this->load->model('Guardian_model');
		$id = $this->input->post('id');
		
		$data = $this->Guardian_model->get_one_guardian($id);
		
		echo json_encode($data);
	}

	public function moveUser($id) {
		$bus_id = $this->input->post('bus_id');

		$data = array('bus_id' => $bus_id);

		$this->db->where('iduser', $id);
		$this->db->update('user', $data); 
		redirect('teams');

	}

	public function moveVeteran($id) {
		
		$team_id = $this->input->post('team_id');

		$data = array('team_id' => $team_id);

		$this->db->where('veteran_id', $id);
		$this->db->update('veteran', $data); 
		redirect('teams');
	}

	public function moveTeam($id) {
		$bus_id = $this->input->post('bus_id');

		$data = array('bus_id' => $bus_id);

		$this->db->where('team_id', $id);
		$this->db->update('team', $data); 
		redirect('teams');
	}

	public function newBus() {

		$this->db->select_max("mission_id");
		$this->db->from('team');

		$currMission_id = implode($this->db->get()->row_array());

		$name = $this->input->post('name');

		$data = array ('mission_id' => $currMission_id,
						'name' => $name);

		$this->db->insert('bus', $data);
		redirect('teams'); 			

	}

	public function newTeam() {

		$this->db->select_max("mission_id");
		$this->db->from('team');

		$currMission_id = implode($this->db->get()->row_array());

		$color = $this->input->post('color');
		$bus_id = $this->input->post('bus_id');

		$data = array ('mission_id' => $currMission_id,
		'color' => $color,
		'bus_id' => $bus_id);

		$this->db->insert('team', $data); 	
		redirect('teams');
	}

	public function  removeTeam() {
		$id = $this->input->post('team_id');
		$data = array('team_id' => null);

		$this->db->where('team_id', $id);
		$this->db->update('veteran', $data); 

		$this->db->where('team_id', $id);
		$this->db->update('user', $data); 

		$this->db->where('team_id', $id);
		$this->db->delete('team');
	}

	public function removeBus() {
		$id = $this->input->post('bus_id');
		$data = array('bus_id' => null);

		$this->db->where('bus_id', $id);
		$this->db->update('veteran', $data); 

		$this->db->where('bus_id', $id);
		$this->db->update('user', $data); 

		$this->db->where('bus_id', $id);
		$this->db->delete('bus');
	}

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
			case 'event':
				$title = $this->input->post('newTitle');
				$description = $this->input->post('newDescription');
				$date = $this->input->post('newDate');
				$start = $this->input->post('newStart');
				$end = $this->input->post('newEnd');
				$team_id = $this->input->post('newTeam_id');
				
				$data = array(
					'title' => $title,
					'team_id' => $team_id,
					'description' => $description,
					'date' => $date,
					'start' => $start,
					'end' => $end,
					'mission_id' => $currMission_id,
				);

				$this->db->insert('event', $data); 

				break;
		}
		redirect('reservations');
	}

	public function editEvent($id,$type) {
		$postData = $this->input->post();

		$this->db->select_max("mission_id");
		$this->db->from('mission');


		switch ($type) {
			case 'fly':
				$this->db->where('flight_id', $id);
				$this->db->update('flight',$postData);
				break;
			case 'hotel':
				$this->db->where('hotel_id', $id);
				$this->db->update('hotel_info',$postData);
				break;
			case 'event':
				$this->db->where('event_id', $id);
				$this->db->update('event',$postData);
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
			case 'event':
				$this->db->where('event_id', $id);
				$data =	$this->db->get('event')->result();
				break;
		}

		echo json_encode($data);
		
	}


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
			case 'event':
				$this->db->where('event_id', $id);
				$this->db->delete('event');
				break;
		}
		redirect('reservations');
	}



}
