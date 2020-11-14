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
		$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
		$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		
		$auth=$this->m_login->auth($email,$password);

		if($auth->num_rows()!= 0){
			$this->m_login->update_status($email,$password);
			$data=$this->m_login->auth($email,$password)->row_array();
			$name=$data['name'];
			$email=$data['email'];
			$status=$data['status1'];
			$this->session->set_userdata('login', true);
			$this->session->set_userdata('name', $name);
			$this->session->set_userdata('email', $email);
			$this->session->set_userdata('status', $status);
			$data = true;
		}else{
			$data = false;
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
