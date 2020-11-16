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
   	}

	public function get_message(){
        $data = $this->m_messages->countUnreplied($this->session->userdata('email'));
        $data = (int)$data;
		echo json_encode($data);

    }
    
    public function get_last_message(){
        $data = $this->m_messages->getUnrepliedLast($this->session->userdata('email'));
		echo json_encode($data);

	}

}
