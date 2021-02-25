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

		$data['login'] = $this->Login_model->get_loginInfo();

		$this->load->view('template/header');
		$this->load->view('login',$data);
		$this->load->view('template/footer');
	}

	public function get_vetNames() {
        $data = $this->Login_model->get_loginInfo()

        foreach ($data as $log): 
            ?>
            <h2><?php echo $log->first_name $log->middle_initial $log->first_name?></h2>
            <?php
        
        endforeach; 
    }
}
