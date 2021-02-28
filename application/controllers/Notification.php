<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

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
	  $this->load->model('m_messages');
	  $this->load->model('m_token');
	  $this->load->model('m_user');
   	}

	public function index()
	{	
		$data['dashboard_class'] = "";
		$data['myroom_class'] = "";
		$data['find_class'] = "";
		$data['notif_class'] = "active";
		$data['profile_class'] = "";
		$data['access_class'] = "";
        $data['location'] = "Notification";

        $data['message_1'] = $this->m_messages->getUnreplied($this->session->userdata('user_id'), 1, 0)->result_array(); // reqeusting
        $data['history'] = $this->m_messages->getReplied($this->session->userdata('user_id'), 1)->result_array();
		$this->load->view('v_notification', $data);
    }
    
    //for Request access searching

    public function search_1()
    {
        $keyword = $this->input->post('search');
        $search = $this->m_messages->searchMessages($keyword, $this->session->userdata('user_id'), 1, 0);

        if ($search->num_rows() != 0) {
			$data=$search->result();
		}else{ //tidak ditemukan
            $data = false;
        }
        echo json_encode($data);
    }

    // auto 
    public function auto_1()
    {
        $data = $this->m_messages->getUnreplied($this->session->userdata('user_id'), 1, 0);
        if ($data->num_rows() != 0) {
			$data=$data->result();
		}else{ //tidak ditemukan
            $data = false;
        }
        
        echo json_encode($data);
    }

    public function auto_history()
    {
        $data = $this->m_messages->getReplied($this->session->userdata('user_id'), 1);
        if ($data->num_rows() != 0) {
			$data=$data->result();
		}else{ //tidak ditemukan
            $data = false;
        }
        
        echo json_encode($data);
    }

    public function give_access()
    {
        $id_user_from = $this->input->post('id_user_from');
        $id_message = $this->input->post('id_message');
        $room_id = $this->session->userdata('room_id');
        $token = random_string('sha1');

        $this->m_token->addToken($token, $room_id, $id_user_from);
        $this->m_messages->updateGranted($id_message, 2, 1);

        $data = true;
        echo json_encode($id_message);
    }

    public function decline_access()
    {
        $id_user_from = $this->input->post('id_user_from');
        $id_message = $this->input->post('id_message');
        $room_id = $this->session->userdata('room_id');
        $this->m_messages->updateDeclined($id_message, 3, 1);

        $data = true;
        echo json_encode($id_message);
    }
}
