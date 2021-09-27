<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function index()
	{
		$this->load->library('session');
		$this->load->model('model');
		if (!empty($this->session->userdata('username'))) {
			$this->load->view('v_menu');
		} else {
			//echo $this->session->userdata('username');
			redirect(home_url());
		}
	}
}
