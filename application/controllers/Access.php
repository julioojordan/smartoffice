<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {
    public function __construct()
   	{
      parent::__construct();
      if($this->session->userdata('login') != TRUE){
        $url=base_url();
        redirect($url);
	  }
	  
	  if($this->session->userdata('email') == NULL){ // if User havent registered their email
        redirect('User');
	  }
      $this->load->model('m_token');
      $this->load->model('m_devices');
      $this->load->model('m_log');
      $this->load->model('m_user');
   	}
      

	public function index()
	{	
		$data['dashboard_class'] = "";
		$data['myroom_class'] = "";
		$data['find_class'] = "";
		$data['notif_class'] = "";
		$data['profile_class'] = "";
        $data['location'] = "Access";
        $data['access_class'] = "active";
        
        //your access to other's rooms
		$data['access'] = $this->m_token->getAccess($this->session->userdata('email'), 1)->result_array();
		$this->load->view('v_access', $data);
    }

    public function rooms($token)
    {
        $data['dashboard_class'] = "";
		$data['myroom_class'] = "";
		$data['find_class'] = "";
		$data['notif_class'] = "";
		$data['profile_class'] = "";
        $data['location'] = "Guest Access";
		$data['access_class'] = "active";
		
		//get room devices
		$data['devices'] = $this->m_devices->getGuestDevice($token);
		
		//save the token
		$data['token'] = $token;

		// get expiration time
		$data['expired'] = $this->m_token->getToken($token)->row_array();
		$data['expired'] = $data['expired']['valid'];
        $this->load->view('v_guest', $data);
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
		$user = $this->session->userdata('email');

		//inserting log table except for device type = lock
		if($device != 'lock'){
			$this->m_log->addLog($device_id, $time, $room_id, $user, $status);
			//update status to  devices table
			$this->m_devices->updateStatus($device_id, $status);
		}else{
			$this->m_devices->updateStatusLock($device_id);
		}

		//update last status user so that they're not recognized as idle by server
		$this->m_user->updateStatus1User1($this->session->userdata('email'), $time);

		echo json_encode($data);
		
	}

	public function get_last_status(){
        $token = $this->input->post('token');
        $room = $this->m_token->getToken($token)->row_array();
        $room_id = $room['room_id'];
		$status = $this->m_devices->getStatus($room_id);
		$data = array();
		foreach($status as $row){
			array_push($data,$row['status']);
		}

		// data [0] = lock [1] = lamp [3] = fan
		echo json_encode($data);

	}

}
