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
		$this->load->view('admin/document');
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
		$this->load->view('admin/template/header');
		$this->load->view('admin/users');
		$this->load->view('admin/template/footer');
	}
	public function resView() //Crew View
	{
		$this->load->view('admin/template/header');
		$this->load->view('admin/reservations');
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


}
