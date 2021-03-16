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

	public function loginCheck($username, $password) {
		$data['login'] = $this->Login_model->get_loginInfo($username);
		$confirm = false;

		if(password_verify($password, $data['login']->password)) {
			$data['confirm'] = true;

			// Start a session here

			$this->load->view('template/header');
			$this->load->view("vetView");
			$this->load->view('template/footer');
		}
		else {
			$this->load->view('template/header');
			$this->load->view('login',$data);
			$this->load->view('template/footer');
		}
	}
}
