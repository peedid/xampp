<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterData extends CI_Controller {
    public function index() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_master_data');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    
    function gudang() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_gudang');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

    function add_gudang() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_tambah_gudang');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

    function save_gudang() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_GUDANG (GUDANG,KODE_GUDANG,ALAMAT, TELP, SURAT_DO,STANDAR,TAMPIL_RINCIAN_BARANG, HANYA_BARANG_MUTASI,HANYA_BARANG_GUDANG,SEMUA_BARANG,HEADER_NOTA,FOOTER_NOTA,FINGER_TYPE,FINGERPRINT_ADDRESS,SESUAI_GUDANG_JUAL,INNER_STOCK_BARANG_GUDANG,WAKTU_TOLERANSI,USER_INPUT,WAKTU_INPUT) VALUES (UPPER(?),UPPER(?),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_DATE)";
                 $ds_hasil = $this->db->query($query,array($this->input->post('gudang_add'),$this->input->post('kode_add') <> ("") ? $this->input->post('kode_add') : null,$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('do_add'),$this->input->post('default_add'),$this->input->post('view_add'),$this->input->post('mutasi_add'),$this->input->post('hanya_gudang_add'),$this->input->post('semua_barang_add'),$this->input->post('header_add'),$this->input->post('footer_add'),$this->input->post('type_add'),$this->input->post('address_add'),$this->input->post('sesuai_gudang_add'),$this->input->post('inner_stok_add'),$this->input->post('toleransi_add'),$this->session->userdata('kode_buildup')));


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

 function edit_gudang() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "UPDATE MST_GUDANG A
                            SET 
                            A.STANDAR= ?,
                            A.GUDANG = UPPER(?),
                            A.ALAMAT= ?, 
                            A.TELP= ?, 
                            A.SURAT_DO= ?,
                            A.TAMPIL_RINCIAN_BARANG= ?, 
                            A.HANYA_BARANG_MUTASI= ?,
                            A.HANYA_BARANG_GUDANG= ?,
                            A.SEMUA_BARANG= ?,
                            A.HEADER_NOTA= ?,
                            A.FOOTER_NOTA= ?,
                            A.FINGER_TYPE= ?,
                            A.FINGERPRINT_ADDRESS= ?,
                            A.SESUAI_GUDANG_JUAL= ?,
                            A.INNER_STOCK_BARANG_GUDANG= ?,
                            A.WAKTU_TOLERANSI= ?,
                            a.KODE_GUDANG = UPPER(?),
                            A.USER_EDIT = ?,
                            A.WAKTU_EDIT = CURRENT_DATE
                            WHERE 
                            a.KODE_GUDANG = ?";
                 $ds_hasil = $this->db->query($query,array($this->input->post('default_add'),$this->input->post('gudang_add'),$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('do_add'),$this->input->post('view_add'),$this->input->post('mutasi_add'),$this->input->post('hanya_gudang_add'),$this->input->post('semua_barang_add'),$this->input->post('header_add'),$this->input->post('footer_add'),$this->input->post('type_add'),$this->input->post('address_add'),$this->input->post('sesuai_gudang_add'),$this->input->post('inner_stok_add'),$this->input->post('toleransi_add'),$this->input->post('kode_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));

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
     function delete_cabang() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE 
                           FROM MST_GUDANG
                           WHERE KODE_GUDANG = ?";
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
   // ___________________data barang
    
   function databarang() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_databarang');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
// --------------------------------v_mst_customer
   
function customer($gudang){
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
        try {
              if (count($this->input->get()) > 0) {
                if($this->input->get('cari') != null)
                {
                  $nama = $this->input->get('cari');
                } else {
                  $nama = $this->input->get('cari');
                }
                } else {
                  $nama = $this->input->get('cari');
                }
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $query =
              "SELECT
              NAMA_CUSTOMER,
              KODE_CUSTOMER,
              ALAMAT,
              NAMA_ORANGTUA,
              GROUP_CUSTOMER,
              TELP,
              COALESCE(HARGA_JUAL,0)HARGA_JUAL,
              PLAFOND_KREDIT,
              KODE_GUDANG
              
            FROM 
              MST_CUSTOMER
                WHERE
                  NAMA_CUSTOMER like ?

            ORDER BY KODE_CUSTOMER DESC ;
              ";
              $ds_hasil = $this->db->query($query,array('%'.$nama.'%'));
              
              $data['baris_data'] = $ds_hasil;
            }catch (Exception $e) {
              $data['baris_data'] = null;
            }
    $this->load->view('v_mst_customer',$data);
       } else{
        redirect(home_url()."Main","refresh");
       }  
  }
      

function delete_customer() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE 
                           FROM MST_CUSTOMER
                           WHERE KODE_CUSTOMER = ?";
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

function save_customer() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "
                 INSERT INTO MST_CUSTOMER
                  (NAMA_CUSTOMER,ALAMAT,NAMA_ORANGTUA,TELP,PLAFOND_KREDIT,GROUP_CUSTOMER,HARGA_JUAL,USER_INPUT,WAKTU_INPUT,KODE_GUDANG)
                   VALUES (UPPER(?),?,?,?,?,?,?,?,CURRENT_DATE,?)";
                 $ds_hasil = $this->db->query($query,array($this->input->post('nama_add'),$this->input->post('alamat_add'),$this->input->post('penjamin_add'),$this->input->post('hp_add'),$this->input->post('kredit_add') <> ("") ? $this->input->post('kredit_add') : 0 ,$this->input->post('group_add') <> ("") ? $this->input->post('group_add') : NULL ,$this->input->post('kolom_harga_add'),$this->session->userdata('kode_buildup'),$this->input->post('kode_gudang_add') <> ("") ? $this->input->post('kode_gudang_add') : NULL ));

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

function edit_customer() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "UPDATE  MST_CUSTOMER
                            SET 
                            NAMA_CUSTOMER = UPPER(?),
                            ALAMAT=?,
                            NAMA_ORANGTUA=?,
                            PLAFOND_KREDIT=?,
                            TELP=?,
                            HARGA_JUAL=?,
                            GROUP_CUSTOMER=?,
                            KODE_GUDANG =?,
                            KODE_CUSTOMER =?,
                            USER_EDIT= ?,
                            WAKTU_EDIT = CURRENT_DATE
                            WHERE 
                              KODE_CUSTOMER =?;";
                 $ds_hasil = $this->db->query($query,array($this->input->post('nama_add'),$this->input->post('alamat_add'),$this->input->post('penjamin_add'),$this->input->post('kredit_add') <> ("") ? $this->input->post('kredit_add') : 0 ,$this->input->post('hp_add'),$this->input->post('kolom_harga_add'),$this->input->post('group_add') <> ("") ? $this->input->post('group_add') : NULL,$this->input->post('kode_gudang_add') <> ("") ? $this->input->post('kode_gudang_add') : NULL,$this->input->post('kode_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));


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

// --------------------operator gudang
function operator($gudang){
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
        try {
              if (count($this->input->get()) > 0) {
                if($this->input->get('gudang') != null)
                {
                  $gudang = $this->input->get('gudang');
                } else {
                  $gudang = 'DEV1';
                }
                } else {
                  $gudang = 'DEV1';
                }
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $query =
              "SELECT
                A.KODE_GUDANG,
                A.KODE_OPERATOR,
                A.PENYESUAIAN_STOCK,
                A.VALIDASI_STOK,
                B.GUDANG
                FROM MST_OPERATOR_GUDANG A
                INNER JOIN MST_GUDANG B ON B.KODE_GUDANG = A.KODE_GUDANG
                WHERE A.KODE_OPERATOR = ?;
              ";
              $ds_hasil = $this->db->query($query,array($gudang));
              
              $data['baris_data'] = $ds_hasil;
            }catch (Exception $e) {
              $data['baris_data'] = null;
            }
    $this->load->view('v_operator',$data);
       } else{
        redirect(home_url()."Main","refresh");
       }  
  }

  function save_operator() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_OPERATOR_GUDANG(KODE_OPERATOR, KODE_GUDANG,PENYESUAIAN_STOCK, VALIDASI_STOK,USER_INPUT,WAKTU_INPUT)
                    VALUES (?,?,?,?,?,CURRENT_DATE)";
                 $ds_hasil = $this->db->query($query,array($this->input->post('operator_add'),$this->input->post('gudang_add'),$this->input->post('penyesuaian_add'),$this->input->post('validasi_add'),$this->session->userdata('kode_buildup')));

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

   function edit_operator() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "
                 UPDATE 
                    MST_OPERATOR_GUDANG  
                  SET
                    KODE_OPERATOR = ?,
                    KODE_GUDANG = ?,
                    PENYESUAIAN_STOCK = ?,
                    VALIDASI_STOK = ?,
                    USER_EDIT= ?,
                    WAKTU_EDIT= CURRENT_TIMESTAMP
                   
                  WHERE 
                    KODE_OPERATOR = ? AND 
                    KODE_GUDANG = ?
                 ";
                 $ds_hasil = $this->db->query($query,array($this->input->post('operator_add'),$this->input->post('gudang_add'),$this->input->post('penyesuaian_add'),$this->input->post('validasi_add'),$this->session->userdata('kode_buildup'),$this->input->post('key_op'),$this->input->post('key')));

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

   function delete_operator() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM 
                              MST_OPERATOR_GUDANG 
                            WHERE 
                              KODE_OPERATOR = ? AND 
                              KODE_GUDANG = ?
                            ;";
                 $ds_hasil = $this->db->query($query,array($this->input->post('operator_hapus'),$this->input->post('kode_hapus')));

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

  // -----------------SUPLIER

function supplier() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_supplier');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function save_supplier() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_SUPPLIER
                            (KODE_SUPP,NAMA_SUPP,ALAMAT,TELP,AKUN_HUTANG,USER_INPUT,WAKTU_INPUT)
                            VALUES (UPPER(?),UPPER(?),?,?,?,?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('supplier_add'),$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('coa_add'),$this->session->userdata('kode_buildup')));

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

 function edit_supplier() {
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
                 MST_SUPPLIER SET 
                 NAMA_SUPP = UPPER(?),
                 ALAMAT = ?,
                 TELP = ?,
                 AKUN_HUTANG = ?,
                 KODE_SUPP = UPPER(?),
                 USER_EDIT = ?,
                 WAKTU_EDIT = CURRENT_TIMESTAMP
                 WHERE 
                  KODE_SUPP = ?
                ;";
                 $ds_hasil = $this->db->query($query,array($this->input->post('supplier_add'),$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('coa_add'),$this->input->post('kode_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));

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
     function delete_supplier() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_SUPPLIER 
                            WHERE 
                            KODE_SUPP = ?
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
   // ____________satuan

   function satuan() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_satuan');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function save_satuan() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_SATUAN (USER_INPUT,WAKTU_INPUT,PENANDA_CETAK,TINGKATAN_HARGA,KODE_SATUAN,SATUAN)
                    VALUES(?, CURRENT_TIMESTAMP ,?,?,UPPER(?),UPPER(?))";
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('penanda_add'),$this->input->post('tingkatan_add') <> ("") ? $this->input->post('tingkatan_add') : null ,$this->input->post('kode_satuan_add'),$this->input->post('satuan_add')));


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

 function edit_satuan() {
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
                        MST_SATUAN  
                      SET 
                        USER_EDIT = ?,
                        WAKTU_EDIT = CURRENT_TIMESTAMP ,
                        PENANDA_CETAK = ?,
                        TINGKATAN_HARGA = ?,
                        KODE_SATUAN =UPPER(?), 
                        SATUAN = UPPER(?)
                      WHERE 
                        KODE_SATUAN = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('penanda_add'),$this->input->post('tingkatan_add') <> ("") ? $this->input->post('tingkatan_add') : null ,$this->input->post('kode_satuan_add'),$this->input->post('satuan_add'),$this->input->post('key')));


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
     function delete_satuan() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_satuan 
                            WHERE 
                            KODE_SATUAN = ?
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
// -----------------------------------GROUP BARANG
 function group() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_group');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function save_group_barang() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_GROUPBARANG (USER_INPUT,WAKTU_INPUT,KODE_GROUPBARANG,GROUP_BARANG)
                    VALUES(?, CURRENT_TIMESTAMP ,UPPER(?),UPPER(?))";
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('kode_group_add'),$this->input->post('kode_group_add')));
                 

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

 function edit_group_barang() {
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
                        MST_GROUPBARANG
                      SET 
                        USER_EDIT = ?,
                        WAKTU_EDIT = CURRENT_TIMESTAMP ,
                        KODE_GROUPBARANG=UPPER(?),
                        GROUP_BARANG=UPPER(?)
                      WHERE 
                        KODE_GROUPBARANG = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('kode_group_add'),$this->input->post('kode_group_add'),$this->input->post('key')));


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
     function delete_group_barang() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_GROUPBARANG
                            WHERE 
                            KODE_GROUPBARANG = ?
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
   // -----------------------------------HARGA BARANG
function harga($gudang){
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
        try {
            
              if (count($this->input->get()) > 0) {
                if (($this->input->get('gudang') != null) && 
                    ($this->input->get('group') != null) ) 
                {
                  $gudang = $this->input->get('gudang');
                  $group = str_replace('ALL','%%',$this->input->get('group'));
                } else {
                  $gudang ='TOKO';
                 $group = '%%';
                }
                } else {
                  $gudang ='TOKO';
                 $group = '%%';
                }

              $trading = $this->model->load_trading();
              $this->db = $trading;

              $ds_gudang = $this->db->query("
                  SELECT
                  A.KODE_GUDANG,
                  A.GUDANG
                  FROM MST_GUDANG A;
                  "); 
              $ds_group = $this->db->query("
                  SELECT
                  *
                  FROM 
                  MST_GROUPBARANG

                  "); 
              $ds_harga = $this->db->query("
                  SELECT   
                  HARGA_JUAL1_JUDUL,
                  HARGA_JUAL2_JUDUL,
                  HARGA_JUAL3_JUDUL,
                  HARGA_JUAL4_JUDUL,
                  HARGA_JUAL5_JUDUL
                 FROM 
                  MST_CONFIG ;
                  "); 
              $query =
              "SELECT
                  A.NAMA_BARANG,
                  A.KODE_GUDANG,
                  A.KODE_GROUPBARANG,
                  B.KODE_BARANG,
                  B.KODE_JUAL,
                  B.KODE_SATUAN,
                  B.HARGA_POKOK,
                  B.HARGA_JUAL,
                  B.HARGA_POKOK_KOTOR,
                  B.HARGA_JUAL_TINGGI,
                  B.HARGA_JUAL_RENDAH,
                  B.HARGA_JUAL2,
                  B.HARGA_JUAL3,
                  B.HARGA_JUAL4,
                  B.HARGA_JUAL5,
                  B.HARGA_JUAL_PERSEN,
                  B.HARGA_JUAL_2_PERSEN,
                  B.HARGA_JUAL_3_PERSEN,
                  B.HARGA_JUAL_4_PERSEN,
                  B.HARGA_JUAL_5_PERSEN
                 FROM MST_BARANG A
                 LEFT JOIN MST_BARANG_JUAL B ON B.KODE_BARANG = A.KODE_BARANG
                 WHERE COALESCE(A.KODE_GUDANG,'')LIKE ?
                 AND  COALESCE(A.KODE_GROUPBARANG,'')LIKE ?
              ";
             
              
              $ds_hasil = $this->db->query($query,array($gudang,$group));
              $data['ds_gudang'] = $ds_gudang;
              $data['ds_group'] = $ds_group;
              $data['baris_data'] = $ds_hasil;
              $data['ds_harga'] = $ds_harga;
            }catch (Exception $e) {
              $data['baris_data'] = null;
            }
    $this->load->view('v_harga_barang',$data);
       } else{
        redirect(home_url()."Main","refresh");
       }  
  }

// ------------------SALES
function sales() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_sales');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

function save_sales() {
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
                            MST_SALES
                          (KODE_SALES,NAMA_SALES,USER_INPUT,WAKTU_INPUT) 
                          VALUES (UPPER(?),UPPER(?),?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('sales_add'),$this->session->userdata('kode_buildup')));
                 

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

function edit_sales() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "UPDATE MST_SALES  
                            SET 
                              USER_EDIT = ?,
                              KODE_SALES = UPPER(?),
                              NAMA_SALES = UPPER(?),
                              WAKTU_EDIT = CURRENT_TIMESTAMP
                            WHERE 
                              KODE_SALES = ?;"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('kode_add'),$this->input->post('sales_add'),$this->input->post('key')));


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
     function delete_sales() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM MST_SALES WHERE KODE_SALES = ?
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
// ------------------BARANG HADIAH
    function barang_hadiah() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_barang_hadiah');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function barang_hadiah2($barang){
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
        try {
              if (count($this->input->get()) > 0) {
                if($this->input->get('cari') != null)

                {
                  $nama = $this->input->get('cari');
                } else {
                  $nama = $this->input->get('cari');
                }
                } else {
                  $nama =  '%%';
                }
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $query =
              "SELECT 
              KODE_BARANG,
              NAMA_BARANG
            FROM 
              MST_BARANG 
            WHERE COALESCE(NAMA_BARANG,'')LIKE ?;;
              ";
              $ds_hadiah = $this->db->query($query,array('%'.$nama.'%'));
              
              $data['baris_data'] = $ds_hadiah;
            }catch (Exception $e) {
              $data['baris_data'] = null;
            }
    $this->load->view('v_barang_hadiah#page_barang',$data);
       } else{
        redirect(home_url()."Main","refresh");
       }  
  }
// ------------------RAK BARANG
    function rak_barang() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_rak_barang');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }


function save_rak_barang() {
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
                            MST_RAKBARANG
                          (KODE_RAKBARANG,RAK_BARANG,USER_INPUT,WAKTU_INPUT) 
                          VALUES (UPPER(?),UPPER(?),?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('rak_barang_add'),$this->session->userdata('kode_buildup')));
                 

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

function edit_rak_barang() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "UPDATE MST_RAKBARANG
                            SET 
                              USER_EDIT = ?,
                              KODE_RAKBARANG = UPPER(?),
                              RAK_BARANG = UPPER(?),
                              WAKTU_EDIT = CURRENT_TIMESTAMP
                            WHERE 
                              KODE_RAKBARANG = ?;"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('kode_add'),$this->input->post('rak_barang_add'),$this->input->post('key')));


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
     function delete_rak_barang() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM MST_RAKBARANG WHERE KODE_RAKBARANG = ?
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
// ------------------TINGKATAN HARGA
    function tingkatan_harga() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_tingkatan_harga');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

function save_tingkatan_harga() {
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
                           MST_TINGKATAN_HARGA
                           (TINGKATAN_HARGA,PERSEN_HARGAJUAL,USER_INPUT,WAKTU_INPUT)
                           VALUES (UPPER(?),?,?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),
                  $this->input->post('persen_add'),$this->session->userdata('kode_buildup')));
                 

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

function edit_tingkatan_harga() {
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
                            MST_TINGKATAN_HARGA  
                          SET
                            USER_EDIT = ?,
                            TINGKATAN_HARGA = UPPER(?),
                            PERSEN_HARGAJUAL = ?,
                            WAKTU_EDIT = CURRENT_TIMESTAMP
                          WHERE 
                            TINGKATAN_HARGA = ?;"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('kode_add'),$this->input->post('persen_add'),$this->input->post('key')));


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
     function delete_tingkatan_harga() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM MST_TINGKATAN_HARGA WHERE TINGKATAN_HARGA = ?
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



   // ---------------------group customer
function group_customer() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_group_customer');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
function save_group_customer() {
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
                           MST_G_CUSTOMER
                           ( GROUP_CUSTOMER,TINGKATAN_HARGA,USER_INPUT,WAKTU_INPUT)
                           VALUES (UPPER(?),?,?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),
                  $this->input->post('tingkatan_add'),$this->session->userdata('kode_buildup')));
                 

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

function edit_group_customer() {
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
                            MST_G_CUSTOMER
                          SET
                            USER_EDIT = ?,
                            GROUP_CUSTOMER = UPPER(?),
                            TINGKATAN_HARGA = ?,
                            WAKTU_EDIT = CURRENT_TIMESTAMP
                          WHERE 
                            group_customer = ?;"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('kode_add'),$this->input->post('tingkatan_add'),$this->input->post('key')));


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
     function delete_group_customer() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM MST_G_CUSTOMER WHERE GROUP_CUSTOMER = ?
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

   // kartu member
   function kartu_member($gudang){
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
        try {
              if (count($this->input->get()) > 0) {
                if($this->input->get('gudang') != null)

                {
                  $gudang = str_replace('ALL','%%',$this->input->get('gudang'));
                  $nama = $this->input->get('cari');
                } else {
                  $gudang = '%%';
                  $nama = $this->input->get('cari');
                }
                } else {
                  $gudang = '%%';
                  $nama =  '%%';
                }
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $query =
              "SELECT A.*, B.*, C.* FROM MST_MEMBER A 
                RIGHT JOIN MST_KARTU_MEMBER B ON B.KODE_KARTU = A.KODE_MEMBER
                LEFT JOIN MST_CUSTOMER C ON C.KODE_MEMBER = A.KODE_MEMBER
                WHERE COALESCE(b.KODE_GUDANG,'')LIKE ? and COALESCE(C.NAMA_CUSTOMER,'')LIKE ?;
              ";
              $ds_hasil = $this->db->query($query,array($gudang,'%'.$nama.'%'));
              
              $data['baris_data'] = $ds_hasil;
            }catch (Exception $e) {
              $data['baris_data'] = null;
            }
    $this->load->view('v_kartu_member',$data);
       } else{
        redirect(home_url()."Main","refresh");
       }  
  }

  function save_kartu_member() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_KARTU_MEMBER(KODE_KARTU,KODE_GUDANG)
                            VALUES (UPPER(?),?);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('gudang_add')));

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

   function edit_kartu_member() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "
                 UPDATE 
                    MST_KARTU_MEMBER  
                  SET 
                      KODE_KARTU = UPPER(?),
                      KODE_GUDANG = ?
                  WHERE 
                    KODE_KARTU = ?
                  ;
                 ";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('gudang_add'),$this->input->post('key')));

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

   function delete_kartu_member() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM 
                            MST_KARTU_MEMBER 
                          WHERE 
                            KODE_KARTU = ?
                          ;
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
// pelayan

function pelayan() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_pelayan');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function save_pelayan() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_PELAYAN (USER_INPUT,WAKTU_INPUT,PELAYAN)
                    VALUES(?, CURRENT_TIMESTAMP ,UPPER(?))";
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('pelayan_add')));
                 

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

 function edit_pelayan() {
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
                        MST_PELAYAN
                      SET 
                        USER_EDIT = ?,
                        WAKTU_EDIT = CURRENT_TIMESTAMP ,
                        PELAYAN=UPPER(?)
                      WHERE 
                        PELAYAN = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('pelayan_add'),$this->input->post('key')));


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
     function delete_pelayan() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_PELAYAN
                            WHERE 
                            PELAYAN= ?
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

  // jabatan
   function jabatan() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_jabatan');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function save_jabatan() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_JABATAN (USER_INPUT,WAKTU_INPUT,JABATAN)
                    VALUES(?, CURRENT_TIMESTAMP ,UPPER(?))";
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('jabatan_add')));
                 

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

 function edit_jabatan() {
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
                        MST_JABATAN
                      SET 
                        USER_EDIT = ?,
                        WAKTU_EDIT = CURRENT_TIMESTAMP ,
                        JABATAN=UPPER(?)
                      WHERE 
                        JABATAN = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('jabatan_add'),$this->input->post('key')));


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
     function delete_jabatan() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_JABATAN
                            WHERE 
                            JABATAN= ?
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

   // ---pegawai
function pegawai($gudang){
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
        try {
              if (count($this->input->get()) > 0) {
                if($this->input->get('gudang') != null)
                {
                  $gudang = $this->input->get('gudang');
                } else {
                  $gudang ='TOKO';
                }
                } else {
                  $gudang = 'TOKO';
                }
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $query =
              "SELECT
              *
               FROM
               MST_PEGAWAI
                WHERE
                  KODE_GUDANG like ?
                ORDER BY NIP ASC;
              ";
              $ds_hasil = $this->db->query($query,array($gudang));
              
              $data['baris_data'] = $ds_hasil;
            }catch (Exception $e) {
              $data['baris_data'] = null;
            }
    $this->load->view('v_pegawai',$data);
       } else{
        redirect(home_url()."Main","refresh");
       }  
  }
      
    
    function save_pegawai() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_PEGAWAI
                 (NIP,NO_KARTU,NAMA_LENGKAP,NAMA_MESIN,PIN,JABATAN,KODE_GUDANG,UPAH,USER_INPUT,WAKTU_INPUT,MENU_MESIN) 
                 VALUES (UPPER(?),?,UPPER(?),UPPER(?),?,?,?,?,?,CURRENT_TIMESTAMP,?);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('nip_add') <> ("") ? $this->input->post('nip_add') : null,$this->input->post('kartu_add') <> ("") ? $this->input->post('kartu_add') : null ,$this->input->post('nama_add'),$this->input->post('nama_mesin_add'),$this->input->post('pin_add') <> ("") ? $this->input->post('pin_add') : null,$this->input->post('jabatan_add') <> ("") ? $this->input->post('jabatan_add') : null,$this->input->post('gudang_add'),$this->input->post('gaji_add') <> ("") ? $this->input->post('gaji_add') : null,$this->session->userdata('kode_buildup'),$this->input->post('menu_add')));
                 

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

 function edit_pegawai() {
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
                            MST_PEGAWAI  
                          SET
                            NIP = ?,
                            NO_KARTU = ?,
                            NAMA_LENGKAP = UPPER(?),
                            NAMA_MESIN = UPPER(?),
                            PIN =?,
                            JABATAN = ?,
                            KODE_GUDANG = ?,
                            UPAH = ?,
                            USER_EDIT = ?,
                            WAKTU_EDIT = CURRENT_TIMESTAMP,
                            MENU_MESIN = ?
                           
                          WHERE 
                            NIP = ?;"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->input->post('nip_add') <> ("") ? $this->input->post('nip_add') : null,$this->input->post('kartu_add') <> ("") ? $this->input->post('kartu_add') : null ,$this->input->post('nama_add'),$this->input->post('nama_mesin_add'),$this->input->post('pin_add') <> ("") ? $this->input->post('pin_add') : null,$this->input->post('jabatan_add') <> ("") ? $this->input->post('jabatan_add') : null,$this->input->post('gudang_add'),$this->input->post('gaji_add') <> ("") ? $this->input->post('gaji_add') : null,$this->session->userdata('kode_buildup'),$this->input->post('menu_add'),$this->input->post('key')));


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
     function delete_pegawai() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_PEGAWAI
                            WHERE 
                            NIP= ?
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


   // ---armada

   function armada() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_armada');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
    function save_armada() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_ARMADA
                 (NOPOL,WARNA,JENIS,TANGGAL_STNK,TAHUN,NO_LAMBUNG,KATEGORI,MEREK,TIPE,NO_STNK,IMEI,TANGGAL_MULAI_BERGABUNG,NAMA_PEMILIK,ALAMAT_PEMILIK,HP,HARGA_SEWA_JAM,HARGA_SEWA_HARI,HARGA_SEWA_BULAN,USER_INPUT,WAKTU_INPUT) 
                 VALUES (UPPER(?),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('nopol_add'),$this->input->post('warna_add'),$this->input->post('jenis_add'),$this->input->post('tanggal_stnk_add'),$this->input->post('tahun_add'),$this->input->post('no_lambung_add'),$this->input->post('kategori_add'),$this->input->post('merk_add') <> ("") ? $this->input->post('merk_add') : null ,$this->input->post('tipe_add'),$this->input->post('no_stnk_add'),$this->input->post('imei_add'),$this->input->post('tanggal_gabung_add'),$this->input->post('pemilik_add'),$this->input->post('alamat_add'),$this->input->post('hp_add'),$this->input->post('harga_jam_add'),$this->input->post('harga_hari_add'),$this->input->post('harga_bulan_add'),$this->session->userdata('kode_buildup')));


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

 function edit_armada() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "UPDATE MST_ARMADA
                            SET
                            NOPOL = ?,
                            WARNA= ?,
                            JENIS= ?,
                            TANGGAL_STNK= ?,
                            TAHUN= ?,
                            NO_LAMBUNG= ?,
                            KATEGORI= ?,
                            MEREK= ?,
                            TIPE= ?,
                            NO_STNK= ?,
                            IMEI= ?,
                            TANGGAL_MULAI_BERGABUNG= ?,
                            NAMA_PEMILIK= ?,
                            ALAMAT_PEMILIK= ?,
                            HP= ?,
                            HARGA_SEWA_JAM= ?,
                            HARGA_SEWA_HARI= ?,
                            HARGA_SEWA_BULAN= ?,
                            USER_EDIT= ?,
                            WAKTU_EDIT = CURRENT_TIMESTAMP
                            WHERE
                            NOPOL= ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->input->post('nopol_add'),$this->input->post('warna_add'),$this->input->post('jenis_add'),$this->input->post('tanggal_stnk_add'),$this->input->post('tahun_add'),$this->input->post('no_lambung_add'),$this->input->post('kategori_add'),$this->input->post('merk_add') <> ("") ? $this->input->post('merk_add') : null ,$this->input->post('tipe_add'),$this->input->post('no_stnk_add'),$this->input->post('imei_add'),$this->input->post('tanggal_gabung_add'),$this->input->post('pemilik_add'),$this->input->post('alamat_add'),$this->input->post('hp_add'),$this->input->post('harga_jam_add'),$this->input->post('harga_hari_add'),$this->input->post('harga_bulan_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));


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
     function delete_armada() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_ARMADA 
                            WHERE 
                            NOPOL = ?
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

//---tipe bayar

function tipe_bayar() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_tipe_bayar');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }


function save_tipe_bayar() {
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
                            MST_TIPE_BAYAR
                          (VISIBLE,KODE_TIPEBAYAR,TUNAI,VIA_BANK,CLEARING,USED_TRADING,AKUNTANSI_SUMBERDANA,AKUNTANSI_SUMBERDANA_IN,AKUNTANSI_SUMBERDANA_OUT,KODE_COA,USER_INPUT,WAKTU_INPUT) 
                          VALUES (?,UPPER(?),?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('visible_add'),$this->input->post('kode_add'),$this->input->post('tunai_add'),$this->input->post('tunai_add') <> ("1") ? 1 : 0 ,$this->input->post('clearing_add'),$this->input->post('trading_add'),$this->input->post('sumber_add'),$this->input->post('s_in_add'),$this->input->post('s_out_add'),$this->input->post('coa_add'),$this->session->userdata('kode_buildup')));

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

function edit_tipe_bayar() {
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
                              MST_TIPE_BAYAR  
                            SET 
                            VISIBLE=?,
                            KODE_TIPEBAYAR=UPPER(?),
                            TUNAI=?,
                            VIA_BANK=?,
                            CLEARING=?,
                            USED_TRADING=?,
                            AKUNTANSI_SUMBERDANA=?,
                            AKUNTANSI_SUMBERDANA_IN=?,
                            AKUNTANSI_SUMBERDANA_OUT=?,
                            KODE_COA=?,
                            USER_EDIT=?,
                            WAKTU_EDIT=CURRENT_TIMESTAMP
                             
                            WHERE 
                              KODE_TIPEBAYAR =?
                            ;"
                        ;
                  $ds_hasil = $this->db->query($query,array($this->input->post('visible_add'),$this->input->post('kode_add'),$this->input->post('tunai_add'),$this->input->post('tunai_add') <> ("1") ? 1 : 0 ,$this->input->post('clearing_add'),$this->input->post('trading_add'),$this->input->post('sumber_add'),$this->input->post('s_in_add'),$this->input->post('s_out_add'),$this->input->post('coa_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));


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
     function delete_tipe_bayar() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM MST_TIPE_BAYAR WHERE KODE_TIPEBAYAR = ?
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
//---bank

function bank() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_bank');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }


function save_bank() {
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
                              MST_BANK
                            (KODE_BANK,BANK,KODE_COA,USER_INPUT,WAKTU_INPUT) 
                            VALUES (UPPER(?),UPPER(?),?,?,CURRENT_TIMESTAMP);";
                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('bank_add'),$this->input->post('coa_add'),$this->session->userdata('kode_buildup')));

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

function edit_bank() {
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
                              MST_BANK  
                            SET 
                              KODE_BANK=UPPER(?),
                              BANK=UPPER(?),
                              KODE_COA=?,
                              USER_EDIT=?,
                              WAKTU_EDIT=CURRENT_TIMESTAMP
                              WHERE 
                              KODE_BANK =?
                            ;"
                        ;
                  $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('bank_add'),$this->input->post('coa_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));


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
     function delete_bank() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM MST_BANK WHERE KODE_BANK = ?
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

// --mst_armada_merk
   function merk_armada() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_merk_armada');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

    function save_merk_armada() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_ARMADA_MEREK (USER_INPUT,WAKTU_INPUT,MEREK)
                    VALUES(?, CURRENT_TIMESTAMP ,UPPER(?))";
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('merk_add')));
                 

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

 function edit_merk_armada() {
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
                        MST_ARMADA_MEREK
                      SET 
                        USER_EDIT = ?,
                        WAKTU_EDIT = CURRENT_TIMESTAMP ,
                        MEREK=UPPER(?)
                      WHERE 
                        MEREK = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('merk_add'),$this->input->post('key')));


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
     function delete_merk_armada() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_ARMADA_MEREK
                            WHERE 
                            MEREK = ?
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
// --mst_tipe_armada
   function tipe_armada() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_tipe_armada');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }
function save_tipe_armada() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_ARMADA_TIPE (USER_INPUT,WAKTU_INPUT,TIPE)
                    VALUES(?, CURRENT_TIMESTAMP ,UPPER(?))";
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('tipe_add')));
                 

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

 function edit_tipe_armada() {
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
                        MST_ARMADA_TIPE
                      SET 
                        USER_EDIT = ?,
                        WAKTU_EDIT = CURRENT_TIMESTAMP ,
                        TIPE=UPPER(?)
                      WHERE 
                        TIPE = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('tipe_add'),$this->input->post('key')));


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
     function delete_tipe_armada() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_ARMADA_TIPE
                            WHERE 
                            TIPE = ?
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
// --mst_warna
   function warna() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_warna');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

function save_warna() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_WARNA (USER_INPUT,WAKTU_INPUT,WARNA)
                    VALUES(?, CURRENT_TIMESTAMP ,UPPER(?))";
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('warna_add')));
                 

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

 function edit_warna() {
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
                        MST_WARNA
                      SET 
                        USER_EDIT = ?,
                        WAKTU_EDIT = CURRENT_TIMESTAMP ,
                        WARNA=UPPER(?)
                      WHERE 
                        WARNA = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->input->post('warna_add'),$this->input->post('key')));


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
     function delete_warna() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            MST_WARNA
                            WHERE 
                            WARNA = ?
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
// --mst_supir
    function supir() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_supir');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }



// function save_supir() {
//        $this->load->library('session');
//        $this->load->model('model');
//        $this->load->helper(array('form', 'url'));
//       try {
//           if (!empty($this->session->userdata('username')))
//             {
//                  $trading = $this->model->load_trading();
//                  $this->db = $trading;
//                  $this->db->trans_begin();
//                  $query = "INSERT INTO
//                  SUPIR
//                  (KODE,NAMA,ALAMAT,SIM,JENIS_SIM,KTP,KK,HP,EMAIL) 
//                  VALUES (UPPER(?),UPPER(?),?,UPPER(?),UPPER(?),?,?,?,?);";
//                  $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('nama_add'),$this->input->post('alamat_add'),$this->input->post('sim_add'),$this->input->post('jenis_sim_add'),$this->input->post('ktp_add'),$this->input->post('kk_add'),$this->input->post('hp_add'),$this->input->post('email_add')));

//                  if ($this->db->trans_status() === FALSE)
//                   {
//                       $error = $this->db->error();
//                       $error_add = $this->model->get_exception($error['message']);
//                       $error_add = str_replace('"',"",$error_add);
//                       $this->db->trans_rollback();
//                       echo '{"result":"0","message":"'.$error_add.'"}';
//                   }
//                   else
//                   {
//                       $this->db->trans_commit();
//                       echo '{"result":"1","message":"ok"}';
//                   }
//               }
//         }   
//           catch(ErrorException $e) {
//             echo '{"result":"0","message":"'.$e->message().'"}';   
//         }

//    }
    

 // function edit_supir() {
 //       $this->load->library('session');
 //       $this->load->model('model');
 //       $this->load->helper(array('form', 'url'));
 //      try {
 //          if (!empty($this->session->userdata('username')))
 //            {
 //                 $trading = $this->model->load_trading();
 //                 $this->db = $trading;
 //                 $this->db->trans_begin();
 //                 $query = "UPDATE 
 //                        SUPIR
 //                      SET 
 //                        KODE = UPPER(?),
 //                        NAMA= UPPER(?),
 //                        ALAMAT=?,
 //                        SIM= UPPER(?),
 //                        JENIS_SIM= UPPER(?),
 //                        KTP=?,
 //                        KK=?,
 //                        HP=?,
 //                        EMAIL=?
 //                      WHERE 
 //                        KODE = ?"
 //                        ;
 //                 $ds_hasil = $this->db->query($query,array($this->input->post('kode_add'),$this->input->post('nama_add'),$this->input->post('alamat_add'),$this->input->post('sim_add'),$this->input->post('jenis_sim_add'),$this->input->post('ktp_add'),$this->input->post('kk_add'),$this->input->post('hp_add'),$this->input->post('email_add'),$this->input->post('key')));


 //                 if ($this->db->trans_status() === FALSE)
 //                  {
 //                      $error = $this->db->error();
 //                      $error_edit = $this->model->get_exception($error['message']);
 //                      $error_edit = str_replace('"',"",$error_edit);
 //                      $this->db->trans_rollback();
 //                      echo '{"result":"0","message":"'.$error_edit.'"}';
 //                  }
 //                  else
 //                  {
 //                      $this->db->trans_commit();
 //                      echo '{"result":"1","message":"ok"}';
 //                  }
 //              }
 //        }   
 //          catch(ErrorException $e) {
 //            echo '{"result":"0","message":"'.$e->message().'"}';   
 //        }

 //   }
     function delete_supir() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM
                            SUPIR
                            WHERE 
                            KODE = ?
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

// user operator
function user() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_user');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

function save_user() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_OPERATOR ( NAMA, USERNAME, PASS, CONFIRM, KODE_OPERATOR_LEVEL,WAKTU_INPUT,KODE_CEPAT,KODE_GUDANG,RUBAH_TANGGAL,OPERATOR_POS,PENJUALAN,PEMBELIAN, RETUR_PENJUALAN,RETUR_PEMBELIAN,BARANG_RUSAK,BARANG_MASUK,BARANG_KELUAR,KARTUSTOCK, AKTIF, BATAL_DOKUMEN,HARGA_POKOK,RESEP, RUBAH_HARGA_NONJASA, RUBAH_HARGA_JASA, SURAT_JALAN_BYFAKTUR, SURAT_JALAN_BYORDERFAKTUR, ORDER_CUSTOMER,TRADING_BARANGBARU, GANTI_TINGKATAN_HARGA, TINGKATAN_HARGA_OTOMATIS,USER_INPUT)
                           VALUES (UPPER(?),UPPER(?),UPPER(?),UPPER(?),?,CURRENT_TIMESTAMP,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

                 $ds_hasil = $this->db->query($query,array($this->input->post('nama_add'),$this->input->post('username_add'),$this->input->post('password_add'),$this->input->post('password2_add'),$this->input->post('level_add'),$this->input->post('quick_kode_add'),$this->input->post('gudang_add') <> ("ALL") ? $this->input->post('gudang_add') : null,$this->input->post('rubah_tanggal_add'),$this->input->post('autokasir_add'),$this->input->post('penjualan_add'),$this->input->post('pembelian_add'),$this->input->post('retur_penjualan_add'),$this->input->post('retur_pembelian_add'),$this->input->post('barang_rusak_add'),$this->input->post('mutasi_add'),$this->input->post('mutasi_add'),$this->input->post('kartu_stock_add'),$this->input->post('aktif_add'),$this->input->post('batal_dokumen_add'),$this->input->post('tampil_harga_pokok_add'),$this->input->post('resep_dokter_add'),$this->input->post('rubah_harga_jasa_add'),$this->input->post('rubah_harga_non_jasa_add'),$this->input->post('sj_faktur_add'),$this->input->post('sj_order_add'),$this->input->post('order_customer_add'),$this->input->post('input_add'),$this->input->post('ganti_tingkatan_add'),$this->input->post('tingkatan_harga_otomastis_add'),$this->session->userdata('kode_buildup')));
                 

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

 function edit_user() {
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
                        MST_OPERATOR
                      SET 
                         NAMA = UPPER(?),
                         USERNAME = UPPER(?),
                         PASS = UPPER(?),
                         CONFIRM = UPPER(?),
                         KODE_OPERATOR_LEVEL = ?,
                         WAKTU_EDIT = CURRENT_TIMESTAMP,
                         KODE_CEPAT = ?,
                         KODE_GUDANG = ?,
                         RUBAH_TANGGAL = ?,
                         OPERATOR_POS = ?,
                         PENJUALAN = ?,
                         PEMBELIAN = ?,
                         RETUR_PENJUALAN = ?,
                         RETUR_PEMBELIAN = ?,
                         BARANG_RUSAK = ?,
                         BARANG_MASUK = ?,
                         BARANG_KELUAR = ?,
                         KARTUSTOCK = ?,
                         AKTIF = ?,
                         BATAL_DOKUMEN = ?,
                         HARGA_POKOK = ?,
                         RESEP = ?,
                         RUBAH_HARGA_NONJASA = ?,
                         RUBAH_HARGA_JASA = ?,
                         SURAT_JALAN_BYFAKTUR = ?,
                         SURAT_JALAN_BYORDERFAKTUR = ?,
                         ORDER_CUSTOMER = ?,
                         TRADING_BARANGBARU = ?,
                         GANTI_TINGKATAN_HARGA = ?,
                         TINGKATAN_HARGA_OTOMATIS=?,
                         USER_EDIT=?
                      WHERE 
                        KODE_OPERATOR = ?"
                        ;
                 $ds_hasil = $this->db->query($query,array($this->input->post('nama_add'),$this->input->post('username_add'),$this->input->post('password_add'),$this->input->post('password2_add'),$this->input->post('level_add'),$this->input->post('quick_kode_add'),$this->input->post('gudang_add') <> ("ALL") ? $this->input->post('gudang_add') : null,$this->input->post('rubah_tanggal_add'),$this->input->post('autokasir_add'),$this->input->post('penjualan_add'),$this->input->post('pembelian_add'),$this->input->post('retur_penjualan_add'),$this->input->post('retur_pembelian_add'),$this->input->post('barang_rusak_add'),$this->input->post('mutasi_add'),$this->input->post('mutasi_add'),$this->input->post('kartu_stock_add'),$this->input->post('aktif_add'),$this->input->post('batal_dokumen_add'),$this->input->post('tampil_harga_pokok_add'),$this->input->post('resep_dokter_add'),$this->input->post('rubah_harga_jasa_add'),$this->input->post('rubah_harga_non_jasa_add'),$this->input->post('sj_faktur_add'),$this->input->post('sj_order_add'),$this->input->post('order_customer_add'),$this->input->post('input_add'),$this->input->post('ganti_tingkatan_add'),$this->input->post('tingkatan_harga_otomastis_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));


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
     function delete_user() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE FROM 
                            MST_OPERATOR 
                            WHERE KODE_OPERATOR = ?
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
// ------------------------------------------coa
   function coa() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_coa');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

    function add_coa() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_tambah_coa');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

    function save_coa() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_coa (coa,KODE_coa,ALAMAT, TELP, SURAT_DO,STANDAR,TAMPIL_RINCIAN_BARANG, HANYA_BARANG_MUTASI,HANYA_BARANG_coa,SEMUA_BARANG,HEADER_NOTA,FOOTER_NOTA,FINGER_TYPE,FINGERPRINT_ADDRESS,SESUAI_coa_JUAL,INNER_STOCK_BARANG_coa,WAKTU_TOLERANSI,USER_INPUT,WAKTU_INPUT) VALUES (UPPER(?),UPPER(?),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_DATE)";
                 $ds_hasil = $this->db->query($query,array($this->input->post('coa_add'),$this->input->post('kode_add') <> ("") ? $this->input->post('kode_add') : null,$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('do_add'),$this->input->post('default_add'),$this->input->post('view_add'),$this->input->post('mutasi_add'),$this->input->post('hanya_coa_add'),$this->input->post('semua_barang_add'),$this->input->post('header_add'),$this->input->post('footer_add'),$this->input->post('type_add'),$this->input->post('address_add'),$this->input->post('sesuai_coa_add'),$this->input->post('inner_stok_add'),$this->input->post('toleransi_add'),$this->session->userdata('kode_buildup')));


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

 function edit_coa() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "UPDATE MST_coa A
                            SET 
                            A.STANDAR= ?,
                            A.coa = UPPER(?),
                            A.ALAMAT= ?, 
                            A.TELP= ?, 
                            A.SURAT_DO= ?,
                            A.TAMPIL_RINCIAN_BARANG= ?, 
                            A.HANYA_BARANG_MUTASI= ?,
                            A.HANYA_BARANG_coa= ?,
                            A.SEMUA_BARANG= ?,
                            A.HEADER_NOTA= ?,
                            A.FOOTER_NOTA= ?,
                            A.FINGER_TYPE= ?,
                            A.FINGERPRINT_ADDRESS= ?,
                            A.SESUAI_coa_JUAL= ?,
                            A.INNER_STOCK_BARANG_coa= ?,
                            A.WAKTU_TOLERANSI= ?,
                            a.KODE_coa = UPPER(?),
                            A.USER_EDIT = ?,
                            A.WAKTU_EDIT = CURRENT_DATE
                            WHERE 
                            a.KODE_coa = ?";
                 $ds_hasil = $this->db->query($query,array($this->input->post('default_add'),$this->input->post('coa_add'),$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('do_add'),$this->input->post('view_add'),$this->input->post('mutasi_add'),$this->input->post('hanya_coa_add'),$this->input->post('semua_barang_add'),$this->input->post('header_add'),$this->input->post('footer_add'),$this->input->post('type_add'),$this->input->post('address_add'),$this->input->post('sesuai_coa_add'),$this->input->post('inner_stok_add'),$this->input->post('toleransi_add'),$this->input->post('kode_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));

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
     function delete_coa() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE 
                           FROM MST_coa
                           WHERE KODE_GUDANG = ?";
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

   // user akes
    function access() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_user_aksess');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
      
    }

  
    function save_acess() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_coa (coa,KODE_coa,ALAMAT, TELP, SURAT_DO,STANDAR,TAMPIL_RINCIAN_BARANG, HANYA_BARANG_MUTASI,HANYA_BARANG_coa,SEMUA_BARANG,HEADER_NOTA,FOOTER_NOTA,FINGER_TYPE,FINGERPRINT_ADDRESS,SESUAI_coa_JUAL,INNER_STOCK_BARANG_coa,WAKTU_TOLERANSI,USER_INPUT,WAKTU_INPUT) VALUES (UPPER(?),UPPER(?),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_DATE)";
                 $ds_hasil = $this->db->query($query,array($this->input->post('coa_add'),$this->input->post('kode_add') <> ("") ? $this->input->post('kode_add') : null,$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('do_add'),$this->input->post('default_add'),$this->input->post('view_add'),$this->input->post('mutasi_add'),$this->input->post('hanya_coa_add'),$this->input->post('semua_barang_add'),$this->input->post('header_add'),$this->input->post('footer_add'),$this->input->post('type_add'),$this->input->post('address_add'),$this->input->post('sesuai_coa_add'),$this->input->post('inner_stok_add'),$this->input->post('toleransi_add'),$this->session->userdata('kode_buildup')));


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

 function edit_acess() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "UPDATE MST_coa A
                            SET 
                            A.STANDAR= ?,
                            A.coa = UPPER(?),
                            A.ALAMAT= ?, 
                            A.TELP= ?, 
                            A.SURAT_DO= ?,
                            A.TAMPIL_RINCIAN_BARANG= ?, 
                            A.HANYA_BARANG_MUTASI= ?,
                            A.HANYA_BARANG_coa= ?,
                            A.SEMUA_BARANG= ?,
                            A.HEADER_NOTA= ?,
                            A.FOOTER_NOTA= ?,
                            A.FINGER_TYPE= ?,
                            A.FINGERPRINT_ADDRESS= ?,
                            A.SESUAI_coa_JUAL= ?,
                            A.INNER_STOCK_BARANG_coa= ?,
                            A.WAKTU_TOLERANSI= ?,
                            a.KODE_coa = UPPER(?),
                            A.USER_EDIT = ?,
                            A.WAKTU_EDIT = CURRENT_DATE
                            WHERE 
                            a.KODE_coa = ?";
                 $ds_hasil = $this->db->query($query,array($this->input->post('default_add'),$this->input->post('coa_add'),$this->input->post('alamat_add'),$this->input->post('telp_add'),$this->input->post('do_add'),$this->input->post('view_add'),$this->input->post('mutasi_add'),$this->input->post('hanya_coa_add'),$this->input->post('semua_barang_add'),$this->input->post('header_add'),$this->input->post('footer_add'),$this->input->post('type_add'),$this->input->post('address_add'),$this->input->post('sesuai_coa_add'),$this->input->post('inner_stok_add'),$this->input->post('toleransi_add'),$this->input->post('kode_add'),$this->session->userdata('kode_buildup'),$this->input->post('key')));

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
     function delete_acess() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "DELETE 
                           FROM MST_coa
                           WHERE KODE_GUDANG = ?";
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

