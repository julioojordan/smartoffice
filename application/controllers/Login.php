<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('v_login');
	}

    public function signup()
	{
		$this->load->view('v_signup');
	}

	public function auth()
	{
		$this->load->model('m_login');
		$this->load->model('m_server');
		$this->load->model('m_rooms');
		$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
		$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);

		if ( function_exists( 'date_default_timezone_set' )){
            date_default_timezone_set('Asia/Jakarta');
            $now = date("Y-m-d H:i:s");
        }
		
		$auth=$this->m_login->auth($email,$password);
		$auth_server=$this->m_server->auth($email,$password);

		//check wheter there is on server or not
		$check_server= $this->m_server->getOnServer();

		if($auth_server->num_rows()!= 0){
			$data=$auth_server->row_array();
			$this->m_server->server_on($email,$password);
			$this->session->set_userdata('server_login', true);
			$this->session->set_userdata('server', true);
			$this->session->set_userdata('id', $data['id']);
			$data = "server_on";
		}else{
			if($check_server->num_rows()!= 0){
				if($auth->num_rows()!= 0){
					$this->m_login->update_status($email,$password, 1, $now);
					$data=$this->m_login->auth($email,$password)->row_array();
					$name=$data['name'];
					$email=$data['email'];
					$status=$data['status1'];
		
					$room_id = $this->m_rooms->getRoom($email);
					$room_id = $room_id['room_id'];
					$this->session->set_userdata('login', true);
					$this->session->set_userdata('name', $name);
					$this->session->set_userdata('email', $email);
					$this->session->set_userdata('room_id', $room_id);
					$this->session->set_userdata('status', $status);
					$data = "success";
				}else{
					$data = "failed";
				}
			}else{
				$data = "server_off";
			}
		}
		

		echo json_encode($data);

	}

	public function register()
	{
		$this->load->model('m_signup');
		$name=htmlspecialchars($this->input->post('fullname',TRUE),ENT_QUOTES);
		$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
		$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		
		$check=$this->m_signup->check_email($email);

		if($check->num_rows()!= 0){
			$data = false;
		}else{
			$this->m_signup->add_user($name, $email, $password);
			$this->session->set_flashdata('done', 'done');
			$data = true;
		}

		echo json_encode($data);
	}
}
