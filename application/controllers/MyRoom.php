<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyRoom extends CI_Controller {
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
      $this->load->model('m_devices');
      $this->load->model('m_rooms');
      $this->load->model('m_user');
   	}
      

	public function index()
	{	
      $data['dashboard_class'] = "";
      $data['myroom_class'] = "active";
      $data['find_class'] = "";
      $data['notif_class'] = "";
      $data['profile_class'] = "";
      $data['access_class'] = "";
      $data['location'] = "My Room";
      $data['devices']= $this->m_devices->getDevice($this->session->userdata('user_id'));
      $room = $this->m_rooms->getRoom($this->session->userdata('user_id'));
      $data['room_id'] = $room['room_id'];
      $this->load->view('v_myroom', $data);
  }

    public function enable_device()
    {
      $id = $this->input->post('id');
      $this->m_devices->guestDevice($id, 1);
      $data = true;
      $this->session->set_flashdata('enable_success','done');
      echo json_encode($data);
    }

    public function disable_device()
    {
      $id = $this->input->post('id');
      $this->m_devices->guestDevice($id, 0);
      $data = true;
      $this->session->set_flashdata('disable_success','done');
      echo json_encode($data);
    }

    public function set_timer()
    {
      $timer = $this->input->post('timer');
      $this->m_user->setTimer($this->session->userdata('user_id'), $timer);
      $data = true;
      $this->session->set_flashdata('timer_success','done');
      echo json_encode($data);
    }

    public function user_automation_status()
    {
      $data = $this->m_user->getDataUser($this->session->userdata('user_id'))->result();
      echo json_encode($data);
    }

}
