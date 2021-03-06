<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find extends CI_Controller {
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

      $this->load->model('m_rooms');
      $this->load->model('m_messages');
      $this->load->model('m_token');
   	}
      

	public function index()
	{	
		$data['dashboard_class'] = "";
		$data['myroom_class'] = "";
		$data['find_class'] = "active";
		$data['notif_class'] = "";
		$data['profile_class'] = "";
        $data['location'] = "Find";
		$data['access_class'] = "";
        $room = $this->m_rooms->getRoom($this->session->userdata('user_id'));
        $data['room_id'] = $room['room_id'];

        $data['rooms'] = $this->m_rooms->getAllRooms($this->session->userdata('user_id'));
		$this->load->view('v_find', $data);
    }

    public function search()
    {
        $keyword = $this->input->post('search');
        $search = $this->m_rooms->searchRoom($keyword, $this->session->userdata('user_id'));

        if ($search->num_rows() != 0) {
			$data=$search->result();
		}else{ //tidak ditemukan
            $data = false;
        }

        echo json_encode($data);
    }

    public function request()
    {
        $room_id = $this->input->post('room_id');
        $room_data =  $this->m_rooms->getRoom1($room_id);
        $u_to = $room_data['owner'];

        if ( function_exists( 'date_default_timezone_set' ) ){
    		date_default_timezone_set('Asia/Jakarta');
			$time = date("Y-m-d H:i:s");
		}

        $check = $this->m_messages->checkMessage($u_to, $this->session->userdata('user_id'), 1);
        $check1 = $this->m_token->checkAccess($room_id, $this->session->userdata('user_id'), 1)->num_rows(); //checking if the user already have the room access or not

        if ($check != 0){ //already sending request
            // $get_message = $this->m_messages->getMessage($this->session->userdata('email'), 1);
            // $time = $get_message['time'];
            // $data = array();
            // array_push($data, $hour);
            // array_push($data, $minute);
            // array_push($data, $second);
            $data = "ASRequest";
        }elseif($check1 != 0){ // still have access
            $data = "AHAccess";
        }elseif ($check1 == 0 && $check == 0){
            $this->m_messages->sendRequest($this->session->userdata('user_id'), $u_to, $time);
            $data = true;
        }

        echo json_encode($data);


    }

    public function auto()
    {
        $data = $this->m_rooms->getAllRooms1($this->session->userdata('user_id'));
        echo json_encode($data);
    }

}
