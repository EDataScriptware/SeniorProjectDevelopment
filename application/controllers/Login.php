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

	// public function get_vetNames() {
    //     $data = $this->Login_model->get_loginInfo()
	// 	$dom = new DOMDocument();

	// 	foreach($data as $name) {
	// 		$vet_name = $dom->createElement('h2', $name->first_name.' '.$name->middle_inital.' '.$name->last_name);
	// 		$dom->appendChild($vet_name);
	// 	}

	// 	return $dom;
    // }
}


// $my_anchor = new html_element('a');
// $my_anchor->set('href','https://davidwalsh.name');
// $my_anchor->set('title','David Walsh Blog');
// $my_anchor->set('text','Click here!');
// $my_anchor->output();