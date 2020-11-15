<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
