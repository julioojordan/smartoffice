<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessageControl extends CI_Controller {

	public function __construct()
   	{
      parent::__construct();
      if($this->session->userdata('login') != TRUE){
        $url=base_url();
        redirect($url);
	  }
	  $this->load->model('m_messages');
	  $this->load->model('m_user');
   	}

	public function get_message(){
        $data = $this->m_messages->countUnreplied($this->session->userdata('email'));
        $data = (int)$data;
		echo json_encode($data);

    }
    
    public function get_last_message(){

          $check = $this->m_messages->getUnreplied($this->session->userdata('email'), 1, 0)->result_array();
          if ( function_exists( 'date_default_timezone_set' ) ){
              date_default_timezone_set('Asia/Jakarta');
              $now = date("Y-m-d H:i:s");
        }
        foreach($check as $row ){
            $time = $row['time'];
            $time = strtotime($time) + 600;  //if in 10 minutes not replied then the message will be auto declined
            $time = date('Y-m-d H:i:', $time);
            if($now > $time){// reqeust with older time will be updated to decline nad status to reply
                $this->m_messages->updateUnreplied($row['id'], 3, 1);
            }
        }
        $data = $this->m_messages->getUnrepliedLast($this->session->userdata('email'));
		    echo json_encode($data);

    }
    

    public function change_last_user_status()
    {
        if ( function_exists( 'date_default_timezone_set' ) ){
            date_default_timezone_set('Asia/Jakarta');
            $now = date("Y-m-d H:i:s");
      }

      $this->m_user->updateStatus1User1($this->session->userdata('email'), $now);

      echo json_encode(true);
    }

}
