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

      $this->load->model('m_devices');
      $this->load->model('m_rooms');
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
        $data['devices']= $this->m_devices->getDevice($this->session->userdata('email'));
        $room = $this->m_rooms->getRoom($this->session->userdata('email'));
        $data['room_id'] = $room['room_id'];
		$this->load->view('v_myroom', $data);
    }
    
    public function delete_device()
    {
        $id = $this->input->post('id');
        $this->m_devices->deleteDevice($id);
        $data = true;
        $this->session->set_flashdata('delete_success','done');
        echo json_encode($data);
    }

}
