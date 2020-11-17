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
        $check = $this->m_messages->getUnreplied($this->session->userdata('email'), 1, 0);
        if ( function_exists( 'date_default_timezone_set' ) ){
    		date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");
		}

        foreach($check as $row ){
            $time = $row['time'];
            $time = strtotime('+30 minutes', strtotime($time)); //if in 10 minutes not replied then the message will be auto declined
            $time = date('Y-m-d H:i:', $time);
            if($now > $time){// reqeust with older time will be updated to decline nad status to reply
                $this->m_messages->updateUnreplied($row['id'], 3, 1);
            }
        }

        $data['message_0'] = $this->m_messages->getUnreplied($this->session->userdata('email'), 1, 0); // reqeusting
        $data['message_1'] = $this->m_messages->getUnreplied($this->session->userdata('email'), 2, 1);// Accepted
        $data['message_2'] = $this->m_messages->getUnreplied($this->session->userdata('email'), 3, 1);// Decline
		$this->load->view('v_notification', $data);
    }
    
    //for Request access searching

    public function search_0()
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

    public function search_1()
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

    public function search_2()
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
}
