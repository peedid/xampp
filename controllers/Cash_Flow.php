<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_Flow extends CI_Controller {
    public function index() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_kas');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
function save_kas() {
  $this->load->library('session');
  $this->load->model('model');
  $this->load->helper(array('form', 'url'));
  try {
    if (!empty($this->session->userdata('username')))
    {
      $trading = $this->model->load_trading();
      $this->db = $trading;
      $this->db->trans_begin();
      $query = "INSERT INTO
                DT_CASHFLOW
                (TANGGAL_CASH,URAIAN,SUMBER_DANA,PENGGUNA,PEMASUKAN,PENGELUARAN,USER_INPUT,WAKTU_INPUT)
                VALUES (?,?,UPPER(?),?,?,?,?,CURRENT_TIMESTAMP);";
      $ds_hasil = $this->db->query($query,array($this->input->post('tanggal_add') <> ("") ? $this->input->post('tanggal_add') : null ,$this->input->post('uraian_add'),$this->input->post('sumber_add'),$this->input->post('pengguna_add'),$this->input->post('pemasukan_add') <> ("") ? $this->input->post('pemasukan_add') : null ,$this->input->post('pengeluaran_add') <> ("") ? $this->input->post('pengeluaran_add') : null ,$this->session->userdata('kode_buildup')));
    if ($this->db->trans_status() === FALSE)
        {
          $error = $this->db->error();
          $error_add = $this->model->get_exception($error['message']);
          $error_add = str_replace('"',"",$error_add);
          $this->db->trans_rollback();
          echo '{"result":"0","message":"'.$error_add.'"}';
        }
        else
        {
          $this->db->trans_commit();
          echo '{"result":"1","message":"ok"}';
        }
      }
    }
    catch(ErrorException $e) {
      echo '{"result":"0","message":"'.$e->message().'"}';
    }
  }

function edit_kas() {
  $this->load->library('session');
  $this->load->model('model');
  $this->load->helper(array('form', 'url'));
  try {
    if (!empty($this->session->userdata('username')))
    {
      $trading = $this->model->load_trading();
      $this->db = $trading;
      $this->db->trans_begin();
      $query = "UPDATE 
                DT_CASHFLOW
                SET 
                TANGGAL_CASH=?,
                URAIAN=?,
                SUMBER_DANA=UPPER(?),
                PENGGUNA=?,
                PEMASUKAN=?,
                PENGELUARAN=?,
                USER_EDIT=?,
                WAKTU_EDIT = CURRENT_TIMESTAMP
                WHERE 
                NO_CASH = ?;";
      $ds_hasil = $this->db->query($query,array($this->input->post('tanggal_add') <> ("") ? $this->input->post('tanggal_add') : null ,$this->input->post('uraian_add'),$this->input->post('sumber_add'),$this->input->post('pengguna_add'),$this->input->post('pemasukan_add') <> ("") ? $this->input->post('pemasukan_add') : null ,$this->input->post('pengeluaran_add') <> ("") ? $this->input->post('pengeluaran_add') : null ,$this->session->userdata('kode_buildup'),$this->input->post('key')));
      if ($this->db->trans_status() === FALSE)
        {
          $error = $this->db->error();
          $error_edit = $this->model->get_exception($error['message']);
          $error_edit = str_replace('"',"",$error_edit);
          $this->db->trans_rollback();
          echo '{"result":"0","message":"'.$error_edit.'"}';
        }
      else
      {
        $this->db->trans_commit();
        echo '{"result":"1","message":"ok"}';
      }
    }
  }
  catch(ErrorException $e) {
    echo '{"result":"0","message":"'.$e->message().'"}';
  }
}
function delete_kas() {
  $this->load->library('session');
  $this->load->model('model');
  $this->load->helper(array('form', 'url'));
  try {
    if (!empty($this->session->userdata('username')))
    {
      $trading = $this->model->load_trading();
      $this->db = $trading;
      $this->db->trans_begin();
      $query = "UPDATE DT_CASHFLOW
                SET BATAL = 1
                WHERE
                NO_CASH = ?
                ;";
      $ds_hasil = $this->db->query($query,array($this->input->post('kode_hapus')));
      if ($this->db->trans_status() === FALSE)
        {
          $error = $this->db->error();
          $error_delete = $this->model->get_exception($error['message']);
          $error_delete = str_replace('"',"",$error_delete);
          $this->db->trans_rollback();
          echo '{"result":"0","message":"'.$error_delete.'"}';
        }
        else
        {
          $this->db->trans_commit();
          echo '{"result":"1","message":"ok"}';
        }
      }
    }   
    catch(ErrorException $e) {
      echo '{"result":"0","message":"'.$e->message().'"}';
    }
  }
} //----------end MasterData jadi jan dihapus