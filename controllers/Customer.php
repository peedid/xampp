<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function index() {
	    $this->load->library('session');
		$this->load->model('model');
		if (!empty($this->session->userdata('username'))) 
		   {
		      $this->load->view('v_customer');
		   } else{
              redirect(home_url());
		   }  
    }

    public function filter($gudang) {
    	$this->load->library('session');
    	$this->load->model('model');
    	echo $this->model->customer_filter(urldecode($gudang)); 
    }


    public function delete($group_customer) {
	    $this->load->library('session');
		$this->load->model('model');
		if (!empty($this->session->userdata('username'))) 
		   {
		   	  try {
		   	  	  $trading = $this->model->load_trading();
		   	  	  $this->db = $trading;
		   	  	  $this->db->trans_begin();
		          $this->db->query("DELETE FROM MST_G_CUSTOMER WHERE GROUP_CUSTOMER = '".$group_customer."'");
		          $this->db->trans_commit();
		      }   catch (Exception $e) {
	              $this->db->trans_rollback();
	   		  }
	   		  redirect(home_url().'Customer_group');
		   } else{
              redirect(home_url());
		   }  
    }

    public function update($group_customer, $new_group_customer) {
	    $this->load->library('session');
		$this->load->model('model');
		if (!empty($this->session->userdata('username'))) 
		   {
		   	  try {
		   	  	  $trading = $this->model->load_trading();
		   	  	  $this->db = $trading;
		   	  	  $this->db->trans_begin();
		          $this->db->query("UPDATE MST_G_CUSTOMER SET GROUP_CUSTOMER = '".$new_group_customer."' WHERE GROUP_CUSTOMER = '".$group_customer."'");
		          $this->db->trans_commit();
		      }   catch (Exception $e) {
	              $this->db->trans_rollback();
	   		  }
	   		  redirect(home_url().'Customer_group');
		   } else{
              redirect(home_url());
		   }  
    }


    public function insert($group_customer) {
	    $this->load->library('session');
		$this->load->model('model');
		if (!empty($this->session->userdata('username'))) 
		   {
		   	  try {
		   	  	  $trading = $this->model->load_trading();
		   	  	  $this->db = $trading;
		   	  	  $this->db->trans_begin();
		          $this->db->query("INSERT INTO MST_G_CUSTOMER(GROUP_CUSTOMER) VALUES('".$group_customer."')");
		          $this->db->trans_commit();
		      }   catch (Exception $e) {
	              $this->db->trans_rollback();
	   		  }
	   		  redirect(home_url().'Customer_group');
		   } else{
              redirect(home_url());
		   }  
    }
}

