<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller {

	public function __construct()
   	{
      parent::__construct();
      if($this->session->userdata('login') != TRUE){
        $url=base_url();
        redirect($url);
	  }

	  $this->load->model('m_rooms');
      $this->load->model('m_user');
   	}

	public function index()
	{	
		$data['dashboard_class_admin'] = "active";
		$data['location'] = "Dashboard Admin";
		$data['room_type'] = $this->m_rooms->getAllType()->result_array();
		$this->load->view('v_dashboard_admin', $data);
	}

    public function AddUser()
    {
        $id = $this->input->post('user_id');
        $room_type = $this->input->post('room_type');
        $password = random_string('sha1');

        $this->m_user->addUser($id, $room_type, $password);

        $this->session->set_flashdata('added', 'added');
        redirect('DashboardAdmin');


    }

    public function get_user()
    {   
        $data = array();
        $user_count= $this->m_user->getAllUser()->num_rows();
        $user_online= $this->m_user->getUserStatus(1)->num_rows();

        array_push($data, $user_count);
        array_push($data, $user_online);
        echo json_encode($data);
    }


}
