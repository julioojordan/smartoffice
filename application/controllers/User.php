<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
   	{
      parent::__construct();
      if($this->session->userdata('login') != TRUE){
        $url=base_url();
        redirect($url);
	  }

	  $this->load->model('m_user');
      $this->load->model('m_rooms');
      $this->load->model('m_devices');
   	}

	public function index()
	{	
		$data['dashboard_class'] = "";
		$data['myroom_class'] = "";
		$data['find_class'] = "";
		$data['notif_class'] = "";
		$data['profile_class'] = "active";
		$data['access_class'] = "";
		$data['location'] = "Profile";

		$data['user'] = $this->m_user->getDataUser($this->session->userdata('user_id'))->result_array();
		
		$this->load->view('v_user', $data);
    }

    public function ChangePassword()
	{	
		$data['dashboard_class'] = "";
		$data['myroom_class'] = "";
		$data['find_class'] = "";
		$data['notif_class'] = "";
		$data['profile_class'] = "active";
		$data['access_class'] = "";
		$data['location'] = "Profile";

		$data['user'] = $this->m_user->getDataUser($this->session->userdata('user_id'))->result_array();
		
		$this->load->view('v_change_password', $data);
    }
    
    public function register()
    {
        $email = $this->input->post('email');
        $name = $this->input->post('name');

        $check_email = $this->m_user->checkEmail($email, $this->session->userdata('user_id'))->num_rows();

        if($check_email != 0){
            $data = "email_used";
        }else{
            //update user information & room information
            $this->m_user->updateUser($this->session->userdata('user_id'), $email, $name, $this->session->userdata('room_type'));

            $room_id = $this->m_rooms->getRoom($this->session->userdata('user_id'));
            $room_id = $room_id['room_id'];
            
            //registering devices
            $this->m_devices->addDevice($room_id, $this->session->userdata('room_type'));

            $this->session->set_flashdata('registered', 'registered');
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('name', $name);
            $this->session->set_userdata('room_id', $room_id);
            $data = "success";
        }
        echo json_encode($data);

    }

    public function savedata()
    {
        $id = $this->input->post('user_id');
        $email = $this->input->post('user_email');
        $name = $this->input->post('user_name');
        $password = $this->input->post('user_password');

        $check_email = $this->m_user->checkEmail($email, $id)->num_rows();
        $check_user = $this->m_user->checkUser($id, $password)->num_rows();

        if($check_email != 0){
            $data = "email_used";
        }elseif($check_user == 0){
            $data = "pass_wrong";
        }else{
            //update user information & room information
            $this->m_user->updateUser1($id, $email, $name, $this->session->userdata('room_id'));
            

            $this->session->set_flashdata('updated', 'Updated');
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('name', $name);
            $data = "success";
        }
            

        echo json_encode($data);

    }

    public function savedata_password()
    {
        $password = $this->input->post('user_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        $check_user = $this->m_user->checkUser($this->session->userdata('user_id'), $password)->num_rows();

        if($new_password != $confirm_password){
            $data = "pass_different";
        }elseif($check_user == 0){
            $data = "pass_wrong";
        }else{
            //update user password
            $this->m_user->updatePasswordUser($this->session->userdata('user_id'), $confirm_password);
            
            $this->session->set_flashdata('updated_password', 'Updated');
            $data = "success";
        }
            

        echo json_encode($data);

    }

}
