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
		$data['test'] = $this->Login_model->get_loginInfo("test");
		$data['verify'] = password_verify('test', $data['test']->password);

		$this->load->view('template/header');
		$this->load->view('login', $data);
		$this->load->view('template/footer');
	}

	public function loginCheck() {


		if($this->input->post('submit') != NULL) {
			$postData = $this->input->post();

			$username = $postData['username'];

			$credentials = $this->Login_model->get_loginInfo($username);
			$confirm = false;

			echo json_encode($credentials);
			echo $postData;

			if(password_verify($postData['password'], $credentials->password)) {
				$data['confirm'] = true;

				// Start a session here
				
				redirect('user');
			}
			else {
				// $this->load->view('template/header');
				// $this->load->view('login',$data);
				// $this->load->view('template/footer');
				echo "Password Incorrect.";
			}
		} // check form data not null

		else {
			redirect('user');
		}
	}
}
