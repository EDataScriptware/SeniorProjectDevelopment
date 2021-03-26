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
		$data['vetData'] = $this->Veteran_model->get_all_veteran_data(); //3700
		$data['fields'] = $this->Veteran_model->getFields();

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

	public function updateVet() {

		if($this->input->post('submit') != NULL) {
			$postData = $this->input->post();

			echo json_encode($postData);

		// 	$username = $postData['username'];

		// 	$userObj = $this->Login_model->get_loginInfo($username);
		// 	$confirm = false;

		// 	if($userObj && password_verify($postData['password'], $userObj->password)) {
		// 		$data['confirm'] = true;
				
		// 		session_start();

		// 		// Start a session here
		// 		$_SESSION["userId"] = $userObj->iduser;
		// 		$_SESSION["userPerm"] = $userObj->user_permissions;

		// 		redirect('user');
		// 	}
		// 	else {
		// 		if(isset($_SESSION["userId"])) {
		// 			session_unset();
		// 			session_destroy();
		// 		}

		// 		echo "Password Incorrect.";
		// 	}
		// } // check form data not null

		// else {
		// 	if(isset($_SESSION["userId"])) {
		// 		session_unset();
		// 		session_destroy();
		// 	}

		// 	echo "Form Submission Failed.";
		// }
		}

	}


}
