<?php

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
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

	public function docView() //Document View
	{
		$this->load->view('admin/template/header');
		$this->load->view('admin/documents');
		$this->load->view('admin/template/footer');
	}
	public function teamView() //Team View
	{
		$this->load->model('User_model');
		$this->load->model('Veteran_model');
		$this->load->model('Bus_model');

		$this->db->select_max("mission_id");
		$this->db->from('team');

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
		$this->db->from('team');

		$currMission_id = implode($this->db->get()->row_array());

		$data['user'] = $this->User_model->get_all_user_data();
		$data['bus'] = $this->Bus_model->get_all_bus_data();
		$data['team'] = $this->Team_model->get_all_team_data();
		$data['id'] = $currMission_id;

		$this->load->view('admin/template/header');
		$this->load->view('admin/users', $data);
		$this->load->view('admin/template/footer');
	}
	public function resView() //Crew View
	{
		$this->load->view('admin/template/header');
		$this->load->view('admin/reservations');
		$this->load->view('admin/template/footer');
	}

	public function vetView() //Crew View
	{

		$this->load->model('Veteran_model');
		$this->load->model('Team_model');

		$this->db->select_max("mission_id");
		$this->db->from('team');

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
		$this->db->from('team');

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

	}

	public function moveVeteran($id) {
		
		$team_id = $this->input->post('team_id');

		$data = array('team_id' => $team_id);

		$this->db->where('veteran_id', $id);
		$this->db->update('veteran', $data); 
	}

	public function moveTeam($id) {
		$bus_id = $this->input->post('bus_id');

		$data = array('bus_id' => $bus_id);

		$this->db->where('team_id', $id);
		$this->db->update('team', $data); 
	}

	public function newBus() {

		$this->db->select_max("mission_id");
		$this->db->from('team');

		$currMission_id = implode($this->db->get()->row_array());

		$name = $this->input->post('name');

		$data = array ('mission_id' => $currMission_id,
						'name' => $name);

		$this->db->insert('bus', $data); 			

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
	}

	public function  removeTeam($id) {
		$data = array('team_id' => null);

		$this->db->where('team_id', $id);
		$this->db->update('veteran', $data); 

		$this->db->where('team_id', $id);
		$this->db->update('user', $data); 

		$this->db->where('team_id', $id);
		$this->db->delete('team');
	}

	public function removeBus($id) {
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


}
