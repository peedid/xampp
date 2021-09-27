<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciptogudangrabat_pesanan extends CI_Controller {
    public function index() {
    	$this->load->library('session');
    	$this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          
          $this->load->view('v_ciptogudangrabat_pesanan');
            
       } else{
              redirect(home_url()."Main","refresh");
       }  
	    
    }
    
    public function delete($kode_antrian) {
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
          try {
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $this->db->trans_begin();
              $this->db->query("update mst_antrian_layanan set status_antrian ='CANCEL' where kode_antrian = '".$kode_antrian."'");
              if ($this->db->trans_status() === FALSE)
              	$this->db->trans_rollback();
              else
                $this->db->trans_commit();
          }   catch (Exception $e) {
                $this->db->trans_rollback();
          }
          $this->load->view('v_ciptogudangrabat_pesanan_today');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }


    public function delete_today($kode_antrian) {
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
          try {
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $this->db->trans_begin();
              $this->db->query("update mst_antrian_layanan set status_antrian ='CANCEL' where kode_antrian = '".$kode_antrian."'");
              if ($this->db->trans_status() === FALSE)
              	$this->db->trans_rollback();
              else
                $this->db->trans_commit();
          }   catch (Exception $e) {
                $this->db->trans_rollback();
          }
          $this->load->view('v_ciptogudangrabat_pesanan_today_all');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }

    public function today() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          $this->load->view('v_ciptogudangrabat_pesanan_today');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }


    public function today_all() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          $this->load->view('v_ciptogudangrabat_pesanan_today_all');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }

// ---------------------------- CHANDRA ------------------------//
    public function report_kinerja() {
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
           try {

              $date=new DateTime();

              if (count($this->input->get()) > 0) {
                if (($this->input->get('tgl1') != null) && ($this->input->get('tgl2') != null)) {
                  $tgl1 = $this->input->get('tgl1');
                  $tgl2 = $this->input->get('tgl2');

                } else {
                  $tgl1 = $date->format('Y-m-d');
                  $tgl2 = $tgl1;    
                }
              } else {
                $tgl1 = $date->format('Y-m-d');
                $tgl2 = $tgl1;
              }

              $trading = $this->model->load_trading();
              $this->db = $trading;
              $ds_hasil = $this->db->query("select pegawai, banyak_nota, jumlah_menit from cipto_kinerja_pegawai(?,?)",array($tgl1,$tgl2));

              $ds_rekap = $this->db->query(
                "SELECT 
                sum(ONLINE_SELESAI+ONLINE_TIDAK_SELESAI)ONLINE,
                sum(OFFLINE_SELESAI+OFFLINE_TIDAK_SELESAI)OFFLINE
                FROM CIPTO_VW_REKAP(?,?);",array($tgl1,$tgl2));

              // $ds_uc =$this->db->query(
              //   "SELECT 
              //   first 10
              //   A.NAMA_CUSTOMER,
              //   A.KODE_CUSTOMER,
              //   A.ALAMAT
              //   FROM 
              //   MST_CUSTOMER A
              //   WHERE
              //   COALESCE(A.BATAL,0)=0
              //   ORDER BY A.WAKTU_INPUT DESC");

              $data['tgl1'] = $tgl1;
              $data['tgl2'] = $tgl2;
              $data['baris_data'] = $ds_hasil;
              $data['baris_rekap'] = $ds_rekap;
              // $data['baris_yussi'] = $ds_uc;
          }   catch (Exception $e) {
              $data['baris_data'] = null;
          }

          //$trading = $this->model->load_trading();
          //$this->db = $trading;
          //$ds_hasil = $this->db->query("select jumlah_offline, offline_tidakselesai, offline_selesai, jumlah_online, online_tidakselesai, online_selesai, total_keseluruhan from cipto_total_transaksi(?,?)"
           // array($tgl1,$tgl2));
         // $data['tgl1'] = $tgl1;
          //    $data['tgl2'] = $tgl2;
          //    $data['data_trans'] = $ds_hasil;
          //}   catch (Exception $e) {
           //   $data['baris_data'] = null;


          //echo $this->input->get('tgl2');
          $this->load->view('v_ciptogudangrabat_report_kinerja',$data);
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }

    function detail_online() {
        $this->load->library('session');
        $this->load->model('model');
        if (count($this->input->get()) > 0) {
            if (($this->input->get('tgl1') != null) && ($this->input->get('tgl2') != null)) {
                  $tgl1 = $this->input->get('tgl1');
                  $tgl2 = $this->input->get('tgl2');

                } else {
                  $tgl1 = $date->format('Y-m-d');
                  $tgl2 = $tgl1;    
                }
            } else {
              $tgl1 = $date->format('Y-m-d');
              $tgl2 = $tgl1;
            }
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
              SELECT
              A.ATAS_NAMA,
              A.NAMA_PEGAWAI
              FROM CIPTO_VW_REKAP (?,?) A
              WHERE A.ONLINE_SELESAI=1;",array($tgl1,$tgl2));

            $ds_detail = $this->db->query("
              SELECT
              A.ATAS_NAMA,
              A.NAMA_PEGAWAI
              FROM CIPTO_VW_REKAP (?,?) A
              WHERE A.ONLINE_TIDAK_SELESAI=1;
              ",array($tgl1,$tgl2));
            $data['baris_data'] = $ds_hasil;
            $data['baris_detail'] = $ds_detail;
            $this->load->view('v_daftar_online',$data);
     
       
    }



    function detail_offline() {
        $this->load->library('session');
        $this->load->model('model');
        if (count($this->input->get()) > 0) {
            if (($this->input->get('tgl1') != null) && ($this->input->get('tgl2') != null)) {
                  $tgl1 = $this->input->get('tgl1');
                  $tgl2 = $this->input->get('tgl2');

                } else {
                  $tgl1 = $date->format('Y-m-d');
                  $tgl2 = $tgl1;    
                }
            } else {
              $tgl1 = $date->format('Y-m-d');
              $tgl2 = $tgl1;
            }
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
              SELECT
              A.ATAS_NAMA,
              A.NAMA_PEGAWAI
              FROM CIPTO_VW_REKAP (?,?) A
              WHERE A.OFFLINE_SELESAI=1",array($tgl1,$tgl2));

            $ds_detail = $this->db->query("
              SELECT
              A.ATAS_NAMA,
              IIF(COALESCE(A.NAMA_PEGAWAI,'')='' and COALESCE(A.STATUS_ANTRIAN,'')='TUNGGU', 'HANYA TUNGGU', (iif(COALESCE(A.NAMA_PEGAWAI,'')='' 
              and COALESCE(A.STATUS_ANTRIAN,'')='CANCEL', 'SUDAH CANCEL' , A.NAMA_PEGAWAI)))PEGAWAI
              FROM CIPTO_VW_REKAP (?,?) A
              WHERE A.OFFLINE_TIDAK_SELESAI=1;
              ",array($tgl1,$tgl2));

            $data['baris_data'] = $ds_hasil;
            $data['baris_detail'] = $ds_detail;
            $this->load->view('v_daftar_offline',$data);
       
    }

    function testone(){
        $this->load->library('session');
        $this->load->model('model');
        if (!empty($this->session->userdata('username'))) 
       {
          $this->load->view('testone');
       } 
    }

    function save_testone() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_KESEHATAN (NAMA_PASIEN,RUANGAN,DOKTER,TANGGAL,SHIFT) VALUES (?,?,?,?,?)";
                 $ds_hasil = $this->db->query($query,array($this->input->post('nama_pasien'),$this->input->post('ruangan'),$this->input->post('dokter'),$this->input->post('tanggal'),$this->input->post('shift')));

                 if ($this->db->trans_status() === FALSE)
                  {
                      $this->db->trans_rollback();
                      echo "GAGAL";
                  }
                  else
                  {
                      $this->db->trans_commit();
                      echo "sukses";
                  }
              }
        }   
          catch(ErrorException $e) {
                    $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
        }

      echo $result_data = '{ ' .$result_data.','.$result_data_2.' }';
       
   }

    // function save_testone() {
    //     $this->load->library('session');
    //     $this->load->model('model');
    //     $this->load->helper(array('form', 'url'));

    //     $result_data = '"token" : "'.$this->security->get_csrf_hash().'"';

    //    {
    //       //var_dump($this->input->post());
    //       echo '{"token":"'.$this->security->get_csrf_hash().'"}';
    //       $trading = $this->model->load_trading();
    //          $this->db = $trading;
    //          $this->db->trans_begin();
    //          $query = "
    //          INSERT INTO MST_KESEHATAN
    //          NO_DAFTAR,WAKTU_DAFTAR,NAMA_PASIEN,RUANGAN,DOKTER,TANGGAL,SHIFT)
    //          VALUES (null,null,?,?,?,?,?)";
    //          $ds_hasil = $this->db->query($query,array($this->input->post('nama_pasien'),$this->input->post('ruangan'),$this->input->post('dokter'),$this->input->post('tanggal'),$this->input->post('shift')));



    //    } 
    // }

// function tambahdata(){
//   $nama_pasien = $this->input->post('nama_pasien');
//   $ruangan = $this->input->post('ruangan');
//   $tanggal = $this->input->post('tanggal');
//   $shift = $this->input->post('shift');


//   if($nama_pasien==''){
//     $result['pesan']="NAMA PASIEN HARUS DIISI!!";
//   } elseif ($ruangan==''){
//     $result['pesan']="RUANGAN HARUS DIISI!!";
//   } elseif ($tanggal==''){
//     $result['pesan']="TANGGAL HARUS DIISI!!";
//   } elseif ($shift==''){
//     $result['pesan']="shift HARUS DIISI!!";
//   } else {
//     $result['pesan']="";
  

//     $data=array(
//       'NAPA_PASIEN'=>$nama_pasien,
//       'RUANGAN'=>$ruangan,
//       'TANGGAL'=>$tanggal,
//       'SHIFT'=>$shift,
//     );
//     $this->model->tambahdata($data,'MST_KESEHATAN');
//  }
//     echo json_encode($result);
//  }



   function kesehatan(){
        $this->load->library('session');
        $this->load->model('model');
        $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
              SELECT
              NAMA_PASIEN,
              RUANGAN,
              DOKTER,
              SHIFT,
              TANGGAL
              FROM MST_KESEHATAN");

            $data['baris_data'] = $ds_hasil;
            $this->load->view('v_kesehatan');

    }
    

// ---------------------------------- AKHIR CHANDRA ---------------------------- //

    public function detil_customer(){
      $this->load->library('session');
      $this->load->model('model');
      if (!empty($this->session->userdata('username'))) 
       {
          $this->load->view('detil_customer');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }

    function input_member(){
      $this->load->library('session');
      $this->load->model('model');
      $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
               SELECT 
              first 10
              A.NAMA_CUSTOMER,
              A.KODE_CUSTOMER,
              A.ALAMAT
            FROM 
              MST_CUSTOMER A
            WHERE
              COALESCE(A.BATAL,0)=0
            ORDER BY A.WAKTU_INPUT DESC");

       $data['baris_data'] = $ds_hasil;
       $this->load->view('v_input_member');

    }

    function riwayat(){
      $this->load->library('session');
      $this->load->model('model');
      $trading = $this->model->load_trading();
       $this->load->view('v_riwayat_hapus');

    }


     function save_member() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
      try {
          if (!empty($this->session->userdata('username')))
            {
                 $trading = $this->model->load_trading();
                 $this->db = $trading;
                 $this->db->trans_begin();
                 $query = "INSERT INTO MST_CUSTOMER (NAMA_CUSTOMER,KODE_CUSTOMER,ALAMAT) VALUES (?,?,?)";
                 $ds_hasil = $this->db->query($query,array($this->input->post('customer'),$this->input->post('kode'),$this->input->post('alamat')));

                 if ($this->db->trans_status() === FALSE)
                  {
                      $this->db->trans_rollback();
                      echo "GAGAL";
                  }
                  else
                  {
                      $this->db->trans_commit();
                      echo "sukses";
                  }
              }
        }   
          catch(ErrorException $e) {
                    $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
        }

      echo $result_data = '{ ' .$result_data.','.$result_data_2.' }';
       
   }

function delete_customer($KODE_CUSTOMER) {
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
          try {
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $this->db->trans_begin();
              $this->db->query("
                UPDATE MST_CUSTOMER SET BATAL = 1 WHERE KODE_CUSTOMER = '".$KODE_CUSTOMER."'
                ");
              if ($this->db->trans_status() === FALSE)
                $this->db->trans_rollback();
              else
                $this->db->trans_commit();
          }   catch (Exception $e) {
                $this->db->trans_rollback();
          }
          $this->load->view('v_input_member');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }

    function delete_permanen($KODE_CUSTOMER) {
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
          try {
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $this->db->trans_begin();
              $this->db->query("
                DELETE 
                FROM MST_CUSTOMER
                WHERE KODE_CUSTOMER = '".$KODE_CUSTOMER."'
                ");
              if ($this->db->trans_status() === FALSE)
                $this->db->trans_rollback();
              else
                $this->db->trans_commit();
          }   catch (Exception $e) {
                $this->db->trans_rollback();
          }
          $this->load->view('v_riwayat_hapus');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }

    function restore($KODE_CUSTOMER) {
    $this->load->library('session');
    $this->load->model('model');
    if (!empty($this->session->userdata('username'))) 
       {
          try {
              $trading = $this->model->load_trading();
              $this->db = $trading;
              $this->db->trans_begin();
              $this->db->query("
                UPDATE MST_CUSTOMER SET BATAL = Null WHERE KODE_CUSTOMER = '".$KODE_CUSTOMER."'
                ");
              if ($this->db->trans_status() === FALSE)
                $this->db->trans_rollback();
              else
                $this->db->trans_commit();
          }   catch (Exception $e) {
                $this->db->trans_rollback();
          }
          $this->load->view('v_riwayat_hapus');
       } else{
              redirect(home_url()."Main","refresh");
       }  
    }


     function edit_member() {
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
                            MST_CUSTOMER 
                            SET 
                            NAMA_CUSTOMER = ? ,
                            NOMER_KTP = ?,
                            TELP = ?,
                            ALAMAT = ?
                            WHERE 
                            KODE_CUSTOMER = ?";
                 $ds_hasil = $this->db->query($query,array($this->input->post('customer_edit'),$this->input->post('ktp_edit'),$this->input->post('telp_edit'),$this->input->post('alamat_edit'),$this->input->post('kode_edit')));

                 if ($this->db->trans_status() === FALSE)
                  {
                      $this->db->trans_rollback();
                      echo "GAGAL";
                  }
                  else
                  {
                      $this->db->trans_commit();
                      echo "sukses";
                  }
              }
        }   
          catch(ErrorException $e) {
                    $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
        }

      echo $result_data = '{ ' .$result_data.','.$result_data_2.' }';
       
   }

   function yussi(){
      $this->load->library('session');
      $this->load->model('model');
      $trading = $this->model->load_trading();
       $this->load->view('v_master_data');

    }

// ----------------------------------------------uc-------------------------------------------------------------
    
    function save() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
       //$post_data =  json_decode(json_encode($this->input->post('data')));
       //echo trim($this->input->post('jelaskan_1'));
       //die();
       //echo "<br><br><br>";
      //var_dump($_FILES);
      //die();

       $result_data = '"token" : "'.$this->security->get_csrf_hash().'"';

       try {
           $allowedTypes = array(IMAGETYPE_JPEG);
           $error = false;
           foreach ($_FILES as $filename => $value) {
              if((!empty($value['name'])) && (!empty($_FILES[$filename]['tmp_name'])) ) {
                $detectedType = exif_imagetype($_FILES[$filename]['tmp_name']); 
                $error = !in_array($detectedType, $allowedTypes);
                if ( $error) 
                   break;
              }
            }
          } catch(ErrorException $e) {
             $error = true;
          }

        if ($error) {
            $result_data_2 = '"info_header" : "Oops..", "info_content" :"Type file gambar yang di upload tidak dikenali ! "';
            $result_data = 
            '{'.
               $result_data.','.
               $result_data_2. ','.
               '"result" : "error"'.
            '}';
            echo $result_data;
            return;
        }

        $result_data_2 = '"info_header" : "Oops..", "info_content"  : "Unknown Error", "result" : "error"';

        if ($this->session->userdata('kode_buildup') != '') {
	        try {
	        	 
             $kode_antrian ='';
		         $nomer = 0;
		         $trading = $this->model->load_trading();
             $this->db = $trading;
		         $this->db->trans_begin();
		         $query = "insert into mst_antrian_layanan(kode_customer, atas_nama, alamat, online) values(?, ?, ?,1)";
		         $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->session->userdata('nama'),$this->session->userdata('alamat')));
             
             $query = "select first 1 kode_antrian from mst_antrian_layanan where kode_customer = ? and tanggal = current_date
                       order by no_data desc                  ";
             $ds_cek = $this->db->query($query,array($this->session->userdata('kode_buildup')));
              foreach ($ds_cek->result() as $result) {
                $kode_antrian = $result->KODE_ANTRIAN;
              }

              if ($kode_antrian != '') {
                  $upload_sukses = true;
    		          $nomer = 0;
    		          foreach ($_FILES as $filename => $value) {
    		              $nomer = $nomer + 1;
    		              $judul= $this->session->userdata('kode_buildup').'_'.$kode_antrian.'_'.$nomer;
    		              // upload gambar
    		              $config['upload_path']          = './assets/images/';
    		              $config['allowed_types']        = 'jpg|jpeg';
    		              $config['max_size']             = 0;
    		              $config['max_width']            = 0;
    		              $config['max_height']           = 0;
    		              $config['encrypt_name'] = FALSE;
    		              $config['overwrite'] = TRUE;
    		              $config['file_name'] = $judul;
    		              $this->load->library('upload', $config);
    		              $this->upload->initialize($config);

    		              if(!empty($_FILES[$filename]['name'])){
    		                  if ($this->upload->do_upload($filename)){
    		                  } else {
    		                    $error = array('error' => $this->upload->display_errors());
    		                    $upload_sukses = false;
    		                    $result_data_2 = '"info_header" : "Oops..", "info_content"  : "'.$error['error'].'", "result" : "error"';
    		                    break;
    		                  }
    		                            
    		              } else {
    		                 // jika gambar kosong tetapi harus di clear
    		                  try {
    		                     if (file_exists('./assets/images/'.$judul.".jpg"))
    		                       unlink('./assets/images/'.$judul.".jpg");
    		                  } catch(ErrorException $e) {

    		                  }
    		              }  
    		          }

              }

              if ( $upload_sukses==true) {
              	if ($this->db->trans_status() === FALSE) {
              		$this->db->trans_rollback();
              		$result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
                }
              	else {
		                $this->db->trans_commit();
		                $data ='{"method_name":"send_to_user","workspace":"'.$this->session->userdata('namatoko').'", "kode_user":"AGENT", "data" : {"method_name":"CETAK_ANTRIANONLINE","kode_antrian":"'.$kode_antrian.'"}}';
		                $result_data_2 = '"info_header" : "Alhamdulillah", "info_content"  : "Proses SIMPAN BERHASIL", "result" : "ok","data":'.$data;
		             }
              }
              else {
                 $this->db->trans_rollback();
                 if (!$upload_sukses) {
                     $urutan = 0;
                     while ($urutan < $nomer) {
                        $urutan = $urutan + 1;
                        $judul= $this->session->userdata('username').'_'.$kode_antrian.'_'.$nomer;
                        try {
                             if (file_exists('./assets/images/'.$judul.".jpg"))
                               unlink('./assets/images/'.$judul.".jpg");
                          } catch(ErrorException $e) {

                          }  
                     }
                     $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Upload Foto", "result" : "error"';
                 }
                  if (!$ds_hasil)
                    $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
              }
	        } catch(ErrorException $e) {
	                  $this->db->trans_rollback();
	                  $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
	        }

	      } else {
	      	 $result_data_2 = '"info_header" : "Oops..", "info_content"  : "Mohon Lengkapi Data Customer Anda", "result" : "error"';
	      }

      echo $result_data = '{ ' .$result_data.','.$result_data_2.' }';
       
   }


   function save_bebas() {
       $this->load->library('session');
       $this->load->model('model');
       $this->load->helper(array('form', 'url'));
       //$post_data =  json_decode(json_encode($this->input->post('data')));
       //echo trim($this->input->post('jelaskan_1'));
       //die();
       //echo "<br><br><br>";
      //var_dump($_FILES);
      //die();

       $result_data = '"token" : "'.$this->security->get_csrf_hash().'"';

       try {
           $allowedTypes = array(IMAGETYPE_JPEG);
           $error = false;
           foreach ($_FILES as $filename => $value) {
              if((!empty($value['name'])) && (!empty($_FILES[$filename]['tmp_name'])) ) {
                $detectedType = exif_imagetype($_FILES[$filename]['tmp_name']); 
                $error = !in_array($detectedType, $allowedTypes);
                if ( $error) 
                   break;
              }
            }
          } catch(ErrorException $e) {
             $error = true;
          }

        if ($error) {
            $result_data_2 = '"info_header" : "Oops..", "info_content" :"Type file gambar yang di upload tidak dikenali ! "';
            $result_data = 
            '{'.
               $result_data.','.
               $result_data_2. ','.
               '"result" : "error"'.
            '}';
            echo $result_data;
            return;
        }

        $result_data_2 = '"info_header" : "Oops..", "info_content"  : "Unknown Error", "result" : "error"';

        if ($this->session->userdata('kode_buildup') != '') {
          try {
             
             $kode_antrian ='';
             $nomer = 0;
             $trading = $this->model->load_trading();
             $this->db = $trading;
             
             $this->db->trans_begin();
             $query = "insert into mst_antrian_layanan(kode_customer, atas_nama, alamat, pesanan, online) values(?, ?, ?,?,1)";
             $ds_hasil = $this->db->query($query,array($this->session->userdata('kode_buildup'),$this->session->userdata('nama'),$this->session->userdata('alamat'),$this->input->post('txt_pesanan')));

             if ($this->db->trans_status() === FALSE)
              {
                  $this->db->trans_rollback();
                  $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
              }
              else
              {
                  $this->db->trans_commit();
                 $query = "select first 1 kode_antrian from mst_antrian_layanan where kode_customer = ? and tanggal = current_date
                           order by no_data desc                  ";
                 $ds_cek = $this->db->query($query,array($this->session->userdata('kode_buildup')));
                  foreach ($ds_cek->result() as $result) {
                    $kode_antrian = $result->KODE_ANTRIAN;
                  }

                  $data ='{"method_name":"send_to_user","workspace":"'.$this->session->userdata('namatoko').'", "kode_user":"AGENT", "data" : {"method_name":"CETAK_ANTRIANONLINE","kode_antrian":"'.$kode_antrian.'"}}';
                    $result_data_2 = '"info_header" : "Alhamdulillah", "info_content"  : "Proses SIMPAN BERHASIL", "result" : "ok","data":'.$data;
              }
 

          } catch(ErrorException $e) {
                    $result_data_2 = '"info_header" : "Oops..", "info_content"  : "GAGAL Menyimpan Pesanan, Silahkan dicoba kembali", "result" : "error"';
          }

        } else {
           $result_data_2 = '"info_header" : "Oops..", "info_content"  : "Mohon Lengkapi Data Customer Anda", "result" : "error"';
        }

      echo $result_data = '{ ' .$result_data.','.$result_data_2.' }';
       
   }
}

