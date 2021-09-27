<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Underconstruction extends CI_Controller {
    public function index() {
	   $this->output->set_status_header('404');
	   $this->load->view('v_underconstruction');

    }
}

