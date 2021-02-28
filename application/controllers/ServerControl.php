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
      $this->load->model('m_log');
      $this->load->model('m_devices');
      $this->load->model('m_rooms');
      $this->load->model('m_messages');
  }
    
    
  public function index()
	{	
		  $this->load->view('v_server');
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
            $time = strtotime($time) + 600; //if in 10 minutes user not doing anything then their status1 will be chenged to idle / 1, status 2 will set to be Not in The room
            $time = date('Y-m-d H:i:s', $time);
            if($now > $time){//
                $this->m_user->updateStatus1User($row['user_id']);
                if($this->m_user->updateStatus1User($row['user_id'])){
                  $data = true;
                }else{
                  $data = "updated";
                }
            }
        }

        echo json_encode($data);
    }

    public function user_offline()
    {
        $check = $this->m_user->checkStatus(1);
        if ( function_exists( 'date_default_timezone_set' )){
            date_default_timezone_set('Asia/Jakarta');
            $now = date("Y-m-d H:i:s");
        }

        foreach($check as $row ){
            $time = $row['last_login_time'];
            $time = strtotime($time) + 3600; //if in 1 hours user not doing anything then their status1 will be chenged to offline / 0
            $time = date('Y-m-d H:i:s', $time);
            if($now > $time){//
                $this->m_user->updateStatus1User2($row['user_id']);
                if($this->m_user->updateStatus1User2($row['user_id'])){
                  $data = true;
                }else{
                  $data = "updated";
                }
            }
        }

        echo json_encode($data);
    }

    public function device_status()
    {
        $user = $this->m_user->checkStatus1(1);
        if ( function_exists( 'date_default_timezone_set' )){
            date_default_timezone_set('Asia/Jakarta');
            $now = date("Y-m-d H:i:s");
        }

        foreach($user as $row ){
            $time = $row['last_login_time'];
            $timer = (int)$row['automation_timer'] * 60 ;
            $time = strtotime($time) + $timer; //if in $timer user not doing anything and their automation is on, then all of their room devices will be turning off
            $time = date('Y-m-d H:i:s', $time);
            if($now > $time){//
                //finding user's room
                $user_data = $this->m_user->getUserRoom($row['user_id'])->row_array();
                $room_id = $user_data['room_id'];

                $devices = $this->m_devices->getStatus($room_id);

                $this->m_user->updateDeviceUser($room_id, 0);
                //inserting log
                foreach($devices as $rows){
                  if($rows['type'] != 1 && $rows['status'] != 0){
                    $this->m_log->addLog($rows['device_id'], $now, $room_id, "System", 0);
                  }
                }

                if($this->m_user->updateDeviceUser($room_id, 0)){
                  $data = "updated";
                }else{
                  $data = null ;
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
                if($this->m_user->updateStatusToken($row['no'])){
                  $data = true;
                }else{
                  $data = "updated";
                }
          }
        }
        echo json_encode($data);
    }

    public function automation_status()
    {
        //this function will disable automation function if there are still guest in somebody rooms
        if ( function_exists( 'date_default_timezone_set' )){
          date_default_timezone_set('Asia/Jakarta');
          $now = date("Y-m-d H:i:s");
        }

        $rooms =  $this->m_rooms->getAllRooms2();

        foreach($rooms as $row){
          $check = $this->m_token->checkTokenStatus1($row['room_id'])->row_array();
          if ($check['status'] == 1){ //disable automation user because there are still guest in there
            $this->m_user->updateAutomation($row['owner'], 0);
          }else{ // enable automation user because there is no guest in there
            $this->m_user->updateAutomation($row['owner'], 1);
          }

        }
        $data = "updated";
        echo json_encode($data);
    }

    public function automation_message(){

      $check = $this->m_messages->getUnrepliedServer()->result_array();
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
      $data = "update messages";
      echo json_encode($data);

  }

}
