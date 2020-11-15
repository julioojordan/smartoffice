<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
   	{
      parent::__construct();
      if($this->session->userdata('login') != TRUE){
        $url=base_url();
        redirect($url);
      }
   	}

	public function index()
	{	
		$data['dashboard_class'] = "active";
		$data['myroom_class'] = "";
		$data['find_class'] = "";
		$data['notif_class'] = "";
		$data['profile_class'] = "";
		$data['location'] = "Dashboard";
		$this->load->view('v_dashboard', $data);
	}

}
