<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url_helper', 'form', 'url', 'directory', 'download'));
		$this->load->model('Index_model');
	}

	public function index()
	{
		$this->load->model('Index_model');
		$data['teams'] = $this->Index_model->get_TeamList();
        $this->load->view('user/template/header');
		$this->load->view('user/index', $data);
		$this->load->view('user/template/footer');
	}

    public function vetList() //Veterins List
	{
		$id = $this->uri->segment(2);
		$this->load->model('Veteran_model');
		$this->load->model('User_model');
		

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

		if ($id != null) {
			$data['id'] = $id;
			$data['veteran'] = $this->Veteran_model->get_team_veteran_data($currMission_id, $id);

			$this->db->select("*");
			$this->db->from('team');
			$this->db->where('team_id', $id);
	
			$data['team'] = $this->db->get()->result()[0];
		}
		else {
			$data['id'] = null;
			$data['veteran'] = $this->Veteran_model->get_mission_veteran_data($currMission_id);
			$data['user'] = $this->User_model->get_all_user_data();

			$this->db->select("*");
			$this->db->from('team');
			$this->db->where('mission_id', $currMission_id);
	
			$data['team'] = $this->db->get()->result();
		}


		$this->db->select("*");
		$this->db->from('bus');
		$this->db->where('mission_id', $currMission_id);

		$data['bus'] = $this->db->get()->result();

		$data['allTeams'] = $this->Index_model->get_TeamList();

        $this->load->view('user/template/header',$data);
		$this->load->view('user/vetList', $data);
		$this->load->view('user/template/footer');
	}

    public function vetView() //Individual Veterin View
	{
		$id = $this->uri->segment(2);
		// $id = $_GET["vet_id"];
		$this->load->model('Veteran_model');
		$this->load->model('Flight_model');
	
		$data['veteran'] = $this->Veteran_model->get_one_veteran($id);
		$data['allTeams'] = $this->Index_model->get_TeamList();

		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('veteran_id', $id);
		$data['hotel'] = $this->db->get()->result();

		$this->db->select_max("mission_id");
		$this->db->from('mission');

		$currMission_id = implode($this->db->get()->row_array());

		$data['flight'] = $this->Flight_model->get_mission_flight_data($currMission_id);

		$data['fields'] = $this->Veteran_model->getFields($id);
		// $data['vetObj2'] = $this->Veteran_model->updateVetEntry($id);
		$this->load->view('user/template/header',$data);
		$this->load->view('user/vetView', $data);
		$this->load->view('user/template/footer');
	}

    public function fileView() //all important files can be viewed here View
	{
		$data['allTeams'] = $this->Index_model->get_TeamList();
        // $this->load->view('user/template/header',$data);
		// $this->load->view('user/fileView');
		// $this->load->view('user/template/footer');

		$map = directory_map('./uploads/', 1);

		$this->load->view('user/template/header', $data);
		$this->load->view('user/fileView', array('error' => ' ', 'files' => $map));
		$this->load->view('user/template/footer');
	}

	public function download ($filename) {
		$file_path = "./uploads/";

		force_download(''.$file_path.$filename, NULL);                     
	}

    public function itineraryView() //Itinerary Information
	{
		$data['allTeams'] = $this->Index_model->get_TeamList();
        $this->load->view('user/template/header',$data);
		$this->load->view('user/itinerary');
		$this->load->view('user/template/footer');
	}

	public function updateInfo($vetId) {

		$postData = $this->input->post();

		$this->db->where('veteran_id', $vetId);
		$this->db->update('veteran', $postData); 

		redirect('vetView/'.$vetId);


	}


}
