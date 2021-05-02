<?php

// Use this section to familiarize with CI's general order of operation
// the controller acts as the basis for each route
//
class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		//if you look at the models folder you'll see Login_model, loading in those models is how you get access to those functions.
		$this->load->model('Login_model');
		$this->load->helper('url_helper');
	}

	//The index function is the default view for that controller
	//if you go into routes and just set the URL as the controller name, it will default to the index function (if it exists).
	public function index()
	{
		//If you go to views you'll see a template folder with the relevant header and footer as well as login.php, this is how you build your view
		//Views will load in based on the order you set them, so follow this general structure when building them
		//if your view is in a folder, make sure to reference the folder in the view URL, header.php is in the template folder, so reference it as 'template/header'
		$this->load->view('template/header');
		$this->load->view('login');
		$this->load->view('template/footer');
	}

	//This function is thrown upon a login attempt
	//it first grabs the posted information, sees if the URL exists and then checks if the submitted password is the same as the usernames database entry.
	//If it's successful, it'll create a few universal variables, and will then redirect you based on what the accounts permissions level is.
	public function loginCheck() {

		if($this->input->post('submit') != NULL) {
			$postData = $this->input->post();

			$username = $postData['username'];

			$userObj = $this->Login_model->get_loginInfo($username);
			$confirm = false;

			if($userObj && password_verify($postData['password'], $userObj->password)) {
				$data['confirm'] = true;

				$this->db->select("*");
				$this->db->where("show_on_front", 1);
				$this->db->from('mission');

				$currMission_id = $this->db->get()->result();

				if(count($currMission_id) == 0) {
					$currMission_id = null;
				}
				else {
					$currMission_id = intval($currMission_id[0]->mission_id);
				}

				// Start a session here
				$_SESSION["userId"] = $userObj->iduser;
				$_SESSION["userPerm"] = $userObj->user_permissions;
				$_SESSION["mission"] = $currMission_id;
				
				if ($_SESSION["userPerm"] === '0') {
					$this->db->select_max("mission_id");
					$this->db->from('mission');
			
					$currMission_id = implode($this->db->get()->row_array());

					redirect('busbook');
				}
				else {
					if($currMission_id == null) {
						echo '<script>alert("No mission data available."); window.location.href="'.base_url('').'";</script>';
					}
					else {
						redirect('user');
					}
				}
				
			}
			else {
				if(isset($_SESSION["userId"])) {
					session_unset();
					session_destroy();
				}

				echo '<script>alert("Password Incorrect"); window.location.href="'.base_url('').'";</script>';
			}
		} // check form data not null

		else {
			if(isset($_SESSION["userId"])) {
				session_unset();
				session_destroy();
			}

			echo "Form Submission Failed.";
		}
	}
}
