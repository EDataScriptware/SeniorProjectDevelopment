<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function index()
	{
        $this->load->view('user/template/header');
		$this->load->view('user/index');
		$this->load->view('user/template/footer');
	}

    public function vetList() //Veterins List
	{
		$this->load->model('Veteran_model');
		$data['veteran'] = $this->Veteran_model->get_all_veteran_data();

        $this->load->view('user/template/header');
		$this->load->view('user/vetList', $data);
		$this->load->view('user/template/footer');
	}

    public function vetView() //Individual Veterin View
	{
		$id = $this->uri->segment(3);
		// $id = $_GET["vet_id"];
		$this->load->model('Veteran_model');
		console_log($id);
	

		$data['veteran'] = $this->Veteran_model->get_one_veteran($id);

		$this->load->view('user/vetView', $data);
		$this->load->view('user/template/footer');
	}

    public function crewView() //Crew View
	{
        $this->load->view('user/template/header');
		$this->load->view('user/crewView');
		$this->load->view('user/template/footer');
	}

    public function crisisView() //Crisis View
	{
        $this->load->view('user/template/header');
		$this->load->view('user/crisisView');
		$this->load->view('user/template/footer');
	}

    public function factView() //Factsheet view
	{
        $this->load->view('user/template/header');
		$this->load->view('user/factView');
		$this->load->view('user/template/footer');
	}

    public function itineraryView() //Itinerary Information
	{
        $this->load->view('user/template/header');
		$this->load->view('user/itinerary');
		$this->load->view('user/template/footer');
	}
}
