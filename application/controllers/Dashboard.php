<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
   	{
      parent::__construct();
      if($this->session->userdata('login') != TRUE){
        $url=base_url();
        redirect($url);
	  }
	  
	//   DANIS WAS HERE
	  if($this->session->userdata('email') == NULL){ // if User havent registered their email
        redirect('User');
	  }
	  $this->load->model('m_devices');
	  $this->load->model('m_log');
	  $this->load->model('m_user');
	  $this->load->model('m_token');
   	}

	public function index()
	{	
		$data['dashboard_class'] = "active";
		$data['myroom_class'] = "";
		$data['find_class'] = "";
		$data['notif_class'] = "";
		$data['profile_class'] = "";
		$data['access_class'] = "";
		$data['location'] = "Dashboard";

		$data['devices'] = $this->m_devices->getDevice($this->session->userdata('user_id'));
		
		$this->load->view('v_dashboard', $data);
	}

	public function device()
	{
		$device = $this->input->post('device');
		$status = $this->input->post('status');
		$device_id = $this->input->post('device_id');
		$room_id= $this->input->post('room_id');
		if ( function_exists( 'date_default_timezone_set' ) ){
    		date_default_timezone_set('Asia/Jakarta');
			$time = date("Y-m-d H:i:s");
		}
		$user = $this->session->userdata('user_id');

		//inserting log table except for device type = lock
		if($device != 'lock'){
			$this->m_log->addLog($device_id, $time, $room_id, $user, $status);
			//update status to  devices table
			$this->m_devices->updateStatus($device_id, $status);
		}else{
			$this->m_devices->updateStatusLock($device_id);
		}

		//update last status user so that they're not recognized as idle by server
		$this->m_user->updateStatus1User1($this->session->userdata('user_id'), $time);

		echo json_encode($data);
		
	}

	public function get_last_status(){
		$data = $this->m_devices->getStatus1($this->session->userdata('room_id'));
		// data [0] = lock [1] = lamp [3] = fan
		echo json_encode($data);

	}

	public function auto_guest(){
		//guest that still have access to your room
		if($this->m_token->getGuest($this->session->userdata('room_id'), 1)->num_rows() != 0){
			$data = $this->m_token->getGuest($this->session->userdata('room_id'), 1)->result_array();
		}else{//no access to other's rooms
			$data = false;
		}
		echo json_encode($data);

		
	}

	public function auto_access(){
		//your access to other's rooms
		if($this->m_token->getAccess($this->session->userdata('user_id'), 1)->num_rows() != 0){
			$data = $this->m_token->getAccess($this->session->userdata('user_id'), 1)->result_array();
		}else{//no access to other's rooms
			$data = false;
		}
		echo json_encode($data);
	}

}
