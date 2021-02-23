<?php

class User extends CI_Controller {

	public function index()
	{
        $this->load->view('user/template/header');
		$this->load->view('user/index');
		$this->load->view('user/template/footer');
	}

    public function vetList() //Veterins List
	{
        $this->load->view('user/template/header');
		$this->load->view('user/vetList');
		$this->load->view('user/template/footer');
	}

    public function vetView() //Individual Veterin View
	{
        $this->load->view('user/template/header');
		$this->load->view('user/vetView');
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
