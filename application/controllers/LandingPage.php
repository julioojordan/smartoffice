<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPage extends CI_Controller {

	public function index()
	{
		$this->load->view('v_landing_page');
	}

    public function elements()
	{
		$this->load->view('elements');
	}
}
