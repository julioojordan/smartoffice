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
        $check = $this->m_messages->getUnreplied($this->session->userdata('email'), 1, 0)->result_array();
        if ( function_exists( 'date_default_timezone_set' ) ){
    		date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");
		}

        foreach($check as $row ){
            $time = $row['time'];
            $time = strtotime($time) + 600; //if in 10 minutes not replied then the message will be auto declined
            $time = date('Y-m-d H:i:', $time);
            if($now > $time){// reqeust with older time will be updated to decline nad status to reply
                $this->m_messages->updateUnreplied($row['id'], 3, 1);
            }
        }

        $data['message_1'] = $this->m_messages->getUnreplied($this->session->userdata('email'), 1, 0)->result_array(); // reqeusting
        $data['message_2'] = $this->m_messages->getUnreplied($this->session->userdata('email'), 2, 1)->result_array();// Accepted
        $data['message_3'] = $this->m_messages->getUnreplied($this->session->userdata('email'), 3, 1)->result_array();// Decline
		$this->load->view('v_notification', $data);
    }
    
    //for Request access searching

    public function search_1()
    {
        $keyword = $this->input->post('search');
        $search = $this->m_messages->searchMessages($keyword, $this->session->userdata('email'), 1, 0);

        if ($search->num_rows() != 0) {
			$data=$search->result();
		}else{ //tidak ditemukan
            $data = false;
        }
        echo json_encode($data);
    }

    //for access given searching

    public function search_2()
    {
        $keyword = $this->input->post('search');
        $search = $this->m_messages->searchMessages($keyword, $this->session->userdata('email'), 2, 1);

        if ($search->num_rows() != 0) {
			$data=$search->result();
		}else{ //tidak ditemukan
            $data = false;
        }

        echo json_encode($data);
    }

    //for access declined searching

    public function search_3()
    {
        $keyword = $this->input->post('search');
        $search = $this->m_messages->searchMessages($keyword, $this->session->userdata('email'), 3, 1);

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
        $data = $this->m_messages->getUnreplied($this->session->userdata('email'), 1, 0);
        if ($data->num_rows() != 0) {
			$data=$data->result();
		}else{ //tidak ditemukan
            $data = false;
        }
        
        echo json_encode($data);
    }

    public function auto_2()
    {
        $data = $this->m_messages->getUnreplied($this->session->userdata('email'), 2, 1);
        if ($data->num_rows() != 0) {
			$data=$data->result();
		}else{ //tidak ditemukan
            $data = false;
        }
        echo json_encode($data);
    }

    public function auto_3()
    {
        $data = $this->m_messages->getUnreplied($this->session->userdata('email'), 3, 1);
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
        $user = $this->m_user->getDataUser($id_user_from)->row_array();
        $email = $user['email'];
        $token = random_string('sha1');

        $this->m_token->addToken($token, $room_id, $email);
        $this->m_messages->updateGranted($id_message, 2, 1);

        $data = true;
        echo json_encode($id_message);
    }
}
