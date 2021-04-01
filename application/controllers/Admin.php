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

			echo json_encode($postData);

			echo "<br>";

			$fields = [];
			$mission_id = null;
			$team_id = null;

			foreach($postData as $key => $value) {
				if($key == "mission_id") {
					echo "mission ID key:".$key. " value: ".$value."<br>";
					$mission_id = $value;
				} else if($key == "team_id") {
					echo "team ID key:".$key. " value: ".$value."<br>";
					$team_id = $value;
				}
				else {
					echo "Key: ".$key." value: ".$value."<br>";
					array_push($fields, $key);
				}
			}

			print_r($fields);
			echo "<br>";
			echo $mission_id."<br>".$team_id;

			// $data['vetData'] = $this->Veteran_model->get_veterans_by_fields(); 

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
