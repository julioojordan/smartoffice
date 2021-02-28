<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAutomationControl extends CI_Controller {

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
        $data = $this->m_messages->countUnreplied($this->session->userdata('user_id'));
        $data = (int)$data;
		echo json_encode($data);

    }
    
    public function get_last_message(){
        $data = $this->m_messages->getUnrepliedLast($this->session->userdata('user_id'));
		echo json_encode($data);

    }
    

    public function change_last_user_status()
    {
        if ( function_exists( 'date_default_timezone_set' ) ){
            date_default_timezone_set('Asia/Jakarta');
            $now = date("Y-m-d H:i:s");
      }

      $this->m_user->updateStatus1User1($this->session->userdata('user_id'), $now);

      echo json_encode(true);
    }

}
