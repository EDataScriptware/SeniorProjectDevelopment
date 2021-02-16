<?php

class User extends CI_Controller {

	public function index()
	{
        $this->load->view('user/template/header');
		$this->load->view('user/index');
		$this->load->view('user/template/footer');
	}
}
