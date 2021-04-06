<?php

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$this->load->model('Veteran_model');
		$data['queryData'] = $this->Veteran_model->get_all_veteran_data(); //3700
		$data['vetFields'] = $this->Veteran_model->getFields();

        $this->load->view('admin/template/header');
		$this->load->view('admin/index', $data);
		$this->load->view('admin/template/footer');
	}

	public function docView() //Crew View
	{
		$this->load->view('admin/template/header');
		$this->load->view('admin/documents');
		$this->load->view('admin/template/footer');
	}
	public function teamView() //Crew View
	{
		$this->load->view('admin/template/header');
		$this->load->view('admin/teams');
		$this->load->view('admin/template/footer');
	}
	public function userView() //Crew View
	{
		$this->load->model('User_model');
		$this->load->model('Team_model');

		$this->db->select_max("mission_id");
		$this->db->from('team');

		$currMission_id = implode($this->db->get()->row_array());

		$data['user'] = $this->User_model->get_all_user_data();
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

		$this->db->where('veteran_id', $id);
		$this->db->update('veteran', $postData); 

		redirect('veterans');
	}

	public function addVeteran() {
		$postData = $this->input->post();

		$this->db->insert('veteran', $postData); 

		redirect('Veteran');

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


}
