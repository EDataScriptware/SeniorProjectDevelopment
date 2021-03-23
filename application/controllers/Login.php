<?php

class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->helper('url_helper');
	}


	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('login');
		$this->load->view('template/footer');
	}

	public function loginCheck() {

		if($this->input->post('submit') != NULL) {
			$postData = $this->input->post();

			$username = $postData['username'];

			$userObj = $this->Login_model->get_loginInfo($username);
			$confirm = false;

			if(password_verify($postData['password'], $userObj->password)) {
				$data['confirm'] = true;

				// Start a session here
				$_SESSION["userId"] = $userObj->iduser;
				$_SESSION["userPerm"] = $userObj->user_permissions;

				redirect('user');
			}
			else {
				if(isset($_SESSION["userId"])) {
					session_destroy();
				}

				echo "Password Incorrect.";
			}
		} // check form data not null

		else {
			if(isset($_SESSION["userId"])) {
				session_destroy();
			}

			echo "Form Submission Failed.";
		}
	}
}
