<?php
	class Logout extends CI_Controller
	{
		function index(){
            $this->load->model('m_login');
            $this->m_login->update_status_off($this->session->userdata('user_id'));
			$this->session->sess_destroy();
			redirect('LandingPage');
		}
	}
?>