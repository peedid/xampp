<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    

    public function encrypt($username, $password) {
          $this->load->model('model');
          $tmp_token = $username.'&'.$password;
          $encrypt = $this->model->_base64_encrypt($tmp_token);
          while (strpos($encrypt,'=')) {
              $encrypt  = $this->model->_base64_encrypt($tmp_token); 
          }
          echo $encrypt; 
    }

    public function direct($token) {
      $this->load->library('session');
      if (!empty($this->session->userdata('username'))) {
            //$this->session->sess_destroy();
            //$this->load->library('session');
      }

      $this->load->model('model');
      
      try {
          /*
          $tmp_token = 'a&a&TRADINGMANAGER';
          $encrypt = $this->model->_base64_encrypt($tmp_token);
          $decrypt = $this->model->_base64_decrypt($encrypt); 
          while (strpos($encrypt,'=')) {
              $encrypt  = $this->model->_base64_encrypt($tmp_token); 
          }
          echo $encrypt;
          echo '<br>';
          echo $decrypt;
          echo '<br>';
          echo $this->model->_base64_decrypt($token);
          echo '<br>';
          $hasil = explode("&",$this->model->_base64_decrypt($token));
          echo $hasil[2];
        */
   
         $token = explode("&",$this->model->_base64_decrypt($token));
         $account = array(
        'username' => $token[0],
        'password' => $token[1]
        );
        
        if (isset($token[2])) {
          $tmp = array("toko" => $token[2]);
          $account = $account + $tmp;
        }

        $this->session->set_userdata('user_id',null);
        $this->goto_main($account);
      } catch (Exception $e) {
          redirect(home_url());
          //echo 'error';
      }
    }

    public function  goto_main($account) {
    	$this->load->library('session');
    	$this->load->model('model');
    	$keluaran = 1;
    	$hasil = $this->model->_CekUsername($account['username'],$account['password']);
		if ( $hasil >= 1) {
			if ($hasil ==1) {
				$keluaran = 1;
			    $this->session->set_userdata($account); 
				  redirect(home_url()."Main","refresh");
			} else {
				$keluaran = 0;
        if (array_key_exists('toko', $account)) {
            $this->session->set_userdata('username',$account['username']);
            $this->session->set_userdata('password',$account['password']);
            $this->goto_toko($account['toko']);
        } else {
            $data['daftar_toko'] = $this->model->daftar_toko($account['username'],$account['password']);
            $data['without_profile'] = 1;
            $this->load->view('v_pilih_toko',$data);  
        }
			}
		}
	    else {
	    	    $keluaran = 0;
	        	$this->session->sess_destroy();
            $data['current_url'] = base_url(uri_string());
	        	$this->load->view('v_login_failed',$data);
	        } 
    }

    public function goto_toko($toko) {
      $this->load->library('session');
    	$this->load->model('model');

    	if ( $this->session->userdata('username') != null) {
           if ( $this->model->get_user_id($this->session->userdata('username'),$this->session->userdata('password'), urldecode($toko)) == 1)
              redirect(home_url()."Main","refresh");
              //echo $this->session->userdata('username');
           else 
              $data['current_url'] = base_url(uri_string());
              $this->load->view('v_database_failure',$data);
        } else
            redirect(home_url());
     
    }

    public function auth() {
    	$this->load->library('session');
    	$this->load->model('model');
        $account = null;

    	if ( count($this->input->post()) ==0) {
    		if(!empty($this->session->userdata('username'))) {
              $account = array(
				'username' => $this->session->userdata('username'),
				'password' => $this->session->userdata('password')  
			  );
			  $this->goto_main($account);
    		} else {
    		   $this->session->sess_destroy();
			   redirect(home_url());	
			}
		} else {
			$account = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')  
			);
			$this->goto_main($account); 
		}
    }
    
    function start_login() {
        $this->load->library('session');
        if (!empty($this->session->userdata('username'))) {
            $this->session->sess_destroy();
            $this->load->library('session');
      }
             
		$this->load->model('model');
        $this->load->view('v_login');	
    }

	public function index()
	{
		$this->start_login();
    }

}

