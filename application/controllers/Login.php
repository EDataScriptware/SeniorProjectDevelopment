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

			$credentials = $this->Login_model->get_loginInfo($username);
			$confirm = false;

			if(password_verify($postData['password'], $credentials->password)) {
				$data['confirm'] = true;

				// Start a session here
				redirect('user');
			}
			else {
				echo "Password Incorrect.";
			}
		} // check form data not null

		else {
			echo "Form Submission Failed.";
		}
	}
}
