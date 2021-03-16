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
			$password = password_hash($postData['password'], PASSWORD_DEFAULT);

			$credentials = $this->Login_model->get_loginInfo($username);
			$confirm = false;

			if(password_verify($password, $credentials->password)) {
				$data['confirm'] = true;

				// Start a session here
				
				header('Location:' . base_url('/user') );


			}
			else {
				$this->load->view('template/header');
				$this->load->view('login',$data);
				$this->load->view('template/footer');
			}
		} // form data not null

		else {
			echo "Form Incomplete."
		}
	}
}
