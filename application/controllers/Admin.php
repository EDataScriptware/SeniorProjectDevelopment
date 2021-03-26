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
		$data['vetData'] = $this->Veteran_model->get_all_veteran_data();
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


}
