<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    public function index() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_transaksi');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

// ---piutang customer--

     function piutang() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_piutang_cusstomer');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function hutang() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_hutang_supplier');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
  } //end controller