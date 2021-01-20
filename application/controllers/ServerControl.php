<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServerControl extends CI_Controller {

	public function __construct()
   	{
      parent::__construct();
      if($this->session->userdata('server_login') != TRUE){
        $url=base_url();
        redirect($url);
	  }
    $this->load->model('m_server');
    $this->load->model('m_user');
    $this->load->model('m_token');
   	}
    
    
    public function index()
	{	
		$this->load->view('server');
    }
    
    public function stop()
    {
        $this->m_server->server_off($this->session->userdata('id'));
        $this->session->sess_destroy();
        $data = true;
        echo json_encode($data);
    }

    public function user_status()
    {
        $check = $this->m_user->checkStatus(2);
        if ( function_exists( 'date_default_timezone_set' )){
            date_default_timezone_set('Asia/Jakarta');
            $now = date("Y-m-d H:i:s");
        }

        foreach($check as $row ){
            $time = $row['last_login_time'];
            $time = strtotime($time) + 600; //if in 10 minutes user not doing anything then their status1 will be chenged to idle / 1 and status 2 will be Not in The room
            $time = date('Y-m-d H:i:s', $time);
            if($now > $time){//
                $this->m_user->updateStatus1User($row['email']);
                if($this->m_user->updateStatus1User($row['email'])){
                  $data = true;
                }else{
                  $data = "updated";
                }
            }
        }

        echo json_encode($data);
    }

    public function token_status()
    {
        if ( function_exists( 'date_default_timezone_set' )){
          date_default_timezone_set('Asia/Jakarta');
          $now = date("Y-m-d H:i:s");
        }
        $check = $this->m_token->checkTokenStatus(1);

        foreach($check as $row){
          $time = $row['valid'];
          if($now > $time){
              $this->m_token->updateStatusToken($row['no']);
                if($this->m_user->updateStatus1User($row['no'])){
                  $data = true;
                }else{
                  $data = "updated";
                }
          }
        }
    }

}
