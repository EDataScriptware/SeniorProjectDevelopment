<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url_helper', 'form', 'url', 'directory', 'download'));
		$this->load->model('Index_model');

	}

	//Acts as the index function for the user side
	//if an ID is in the URI it'll show you information relevant to a specific team (AKA clicking on the team color in the dropdown)
	//If it isn't, it'll give you a detailed view that has all pertinant mission information
    public function vetList() 
	{
		$id = $this->uri->segment(2);
		$this->load->model('Veteran_model');
		$this->load->model('User_model');
		
		$currMission_id = $_SESSION["mission"];

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
	//Grabs veteran ID from the URL and will display a detailed veteran view
    public function vetView() 
	{
		$id = $this->uri->segment(2);
		// $id = $_GET["vet_id"];
		$this->load->model('Veteran_model');
		$this->load->model('Flight_model');
	
		$data['veteran'] = $this->Veteran_model->get_one_veteran($id);
		$data['allTeams'] = $this->Index_model->get_TeamList();

		//gets their hotel info
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('veteran_id', $id);
		$data['hotel'] = $this->db->get()->result();

		//gets the guardian hotel info
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('guardian_id', $data['veteran'][0]->guardian_id);
		$data['gHotel'] = $this->db->get()->result();

		$currMission_id = $_SESSION["mission"];

		$data['flight'] = $this->Flight_model->get_mission_flight_data($currMission_id);

		$data['fields'] = $this->Veteran_model->getFields($id);
		// $data['vetObj2'] = $this->Veteran_model->updateVetEntry($id);
		$this->load->view('user/template/header',$data);
		$this->load->view('user/vetView', $data);
		$this->load->view('user/template/footer');
	}

	public function incident() {
		$data['allTeams'] = $this->Index_model->get_TeamList();
		$this->load->view('user/template/header',$data);
		$this->load->view('user/incident');
		$this->load->view('user/template/footer');
	}

	public function sendEmail() {
		// $this->load->library('email');

		$postData = $this->input->post();

		// $config['protocol'] = 'sendmail';
		// $config['mailpath'] = '/usr/sbin/sendmail';
		// $config['charset'] = 'iso-8859-1';
		// $config['wordwrap'] = TRUE;

		// $this->email->initialize($config);

		// $this->email->from('HonorFlight_Incident@rwby.student.rit.edu', $postData['name']);
		// $this->email->to('zpe4421@g.rit.edu');
		// // $this->email->cc('another@another-example.com');
		// // $this->email->bcc('them@their-example.com');

		// $this->email->subject($postData['subject']);
		// $this->email->message($postData['description']);

		// $test = $this->email->send();

		

		$msg = "Submitted By: ".$postData["name"]."\n\n".$postData["description"];

		$msg = wordwrap($msg, 80);

		// $headers = "MIME-Version: 1.0" . "\r\n";
		// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// // More headers
		// $headers .= 'From: <HonorFlight_Incident@rwby.student.rit.edu>' . "\r\n";

		// $test = mail("zacheas@outlook.com", $postData["subject"], $msg, $headers);

		$success = mail('example@example.com','Test Email',$msg);
		if (!$success) {
			print_r(error_get_last()['message']);
		}

		var_dump($success) ;
		
		// $this->load->view('user/template/header');
		// $this->load->view('user/incident_sent');
		// $this->load->view('user/template/footer');

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
	//allows you to download a file
	public function download ($filename) {
		$file_path = "./uploads/";

		force_download(''.$file_path.$filename, NULL);                     
	}

    public function itineraryView() //Itinerary Information
	{
		$data['allTeams'] = $this->Index_model->get_TeamList();

		$currMission_id = $_SESSION["mission"];

		// $this->db->select("*");
		// $this->db->from('event');
		// $this->db->where('mission_id', $currMission_id);
		// $data['event'] = $this->db->get()->result();


        $this->load->view('user/template/header',$data);
		$this->load->view('user/itinerary',$data);
		$this->load->view('user/template/footer');
		
	}

	//updates a veterans information of the fly, because of how generic it is you can load it into veteran info editing form
	public function updateInfo($vetId) {

		$postData = $this->input->post();

		$this->db->where('veteran_id', $vetId);
		$this->db->update('veteran', $postData); 

		redirect('vetView/'.$vetId);


	}

	//updates a veterans hotel info
	public function updateHotelInfo($vetId) {

		$postData = $this->input->post();

		$this->db->where('veteran_id', $vetId);
		$this->db->update('hotel_info', $postData); 

		redirect('vetView/'.$vetId);

	}
	//updates a Guardians hotel info
	public function updateGuardianHotelInfo($guardId) {

		$postData = $this->input->post();

		$this->db->where('guardian_id', $guardId);
		$this->db->update('hotel_info', $postData); 

		redirect('vetView/'.$vetId);


	}

}
