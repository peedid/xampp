<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
  <link rel="stylesheet" href="<?php echo asset_url();?>css/general.css" />
    <style>
      #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #customers tr:nth-child(even){background-color: #f2f2f2;}

      #customers tr:hover {background-color: #ddd;}

      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }
      
      label   {margin-bottom:-20px !important;text-align:left !important;}
      
    </style>
</head>
<body>
    <div data-role="page" id="page_main" data-theme="a" data-transition="slide" data-ajax="false">
        <?php
           $this->load->view("v_header.php");
           
        ?>
        <div data-role="content">
          <p align="center" style='font-size:15px;font-weight:bold'> PESANAN-KU </p>
          <p id="div_batal" align="center" style='font-size:12px;font-weight:bold'>Untuk Membatalkan Bisa Menghubungi <br>Admin di 085x-xxxx-xxxx</p>
          <div style="clear: both;"></div>          
        <?php
          $trading = $this->model->load_trading();
          $this->db = $trading;
          $q_antrian = $this->db->query("select (
               SELECT               
               FIRST 1    
               IIF(
                   DATEDIFF(minute,x.WAKTU_INPUT,cast('now' as timestamp)) =0,'',
                   DATEDIFF(minute,x.WAKTU_INPUT,cast('now' as timestamp)) || CHR(13) || 'MENIT'
               )
               FROM MST_ANTRIAN_LAYANAN_STATUS X
               WHERE                                  
               X.KODE_ANTRIAN = A.KODE_ANTRIAN
               ORDER BY NO_DATA DESC
              ) lama_menit
              , a.kode_antrian, a.nomer_antrian, a.status_antrian, a.online_cetak, a.online, atas_nama, ( select x.nama_lengkap from mst_pegawai x where x.nip = a.nip ) nama_pegawai from mst_antrian_layanan a where ( status_antrian <> 'CANCEL' and status_antrian <> 'SELESAI') and kode_customer = ? and tanggal = current_date",array($this->session->userdata('kode_buildup')));
          ?>
          <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer">
              <?php 
                 $ada_data = 0;
                 foreach ($q_antrian ->result() as $row):
              ?>  
                <li style="margin-bottom: 5px;"  status_antrian = "<?= $row->STATUS_ANTRIAN; ?>" nomer_antrian = "<?= $row->NOMER_ANTRIAN; ?>" id="<?= $row->KODE_ANTRIAN; ?>">
                   <a href="#">
                    <div style="">
                        
                        <div style="float:left;">
                            <p style="font-size:12px !important">Pelayan : <?= $row->NAMA_PEGAWAI; ?></p>
                            <p style="font-size:14px !important"><?= $row->ATAS_NAMA; ?></p>
                            <h2 style="font-size:30px !important;margin-top:-10px">No. <?= $row->NOMER_ANTRIAN; ?></h2>
                        </div>
                        <div style="float:right">
                           <?php 
                              $ada_data = $ada_data + 1;
                              if (($row->STATUS_ANTRIAN !='CANCEL' && $row->STATUS_ANTRIAN != 'SELESAI' ))
                                echo '<p style="text-align:center;margin-top:10px">Dah nunggu</p>';
                          ?>
                           <p style="text-align:center;font-size:12px;margin-top:-5px"><?= $row->LAMA_MENIT; ?></p>
                        </div>
                    
                    
                        <table style="float:left;color:white;margin-top:-20px">
                          <tr>
                            <td style="text-align:left">
                              <p>Status :</p><p style="font-size:15px;margin-top:-5px;color:orange"> <?= $row->STATUS_ANTRIAN; ?></p>
                            </td>
                            <td style="width:40px">
                            </td>
                            <td style="text-align:left">
                              <p>Cara :</p><p style="font-size:15px;margin-top:-5px;color:orange"> <?php if ($row->ONLINE==1) echo "Online"; else echo "Datang Langsung"; ?></p>
                            </td>
                            <td style="width:40px">
                            </td>
                            <td style="text-align:left">
                              <p>Dicetak :</p><p style="font-size:15px;margin-top:-5px;color:orange"> 
                                <?php 
                                     if ($row->ONLINE == 1) {
                                        if ($row->ONLINE_CETAK==1)
                                          echo "Udah"; 
                                        else
                                          echo "Belum";
                                     }
                                    else 
                                       echo "Udah"; 
                                ?>
                              </p>
                            </td>
                            
                          </tr>
                        </table>

                    </div>   
                    
                  </a>
                </li>
              <?php endforeach; ?>
          </ul>
      </div>

        <div data-role="popup" id="tanya_hapus" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                  <div data-role="header" data-theme="a">
                      <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Back</a>
                      <h1>Tanya</h1>
                  </div>
                  <div role="main" class="ui-content">
                      <div>
                           <p id="isi_info"></p>
                           
                      </div>
                      <div>
                          <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
                      </div>
                  </div>
        </div> 
    </div>
    
<script>
  $('#div_batal').hide();

  <?php
     if ($ada_data >0)
     echo "$('#div_batal').show();"; 
  ?>

  function swipeleftHandler( event ){
    if ($(this).attr('status_antrian')=='SEDANG DISIAPKAN') {
      alert('PESANAN YANG SEDANG DISIAPKAN TIDAK BOLEH DIBATALKAN !')
      return;
    } 
    $('#btn_delete').attr('hapus_id',$(this).attr('id') );
    document.getElementById('isi_info').innerHTML = 'Nomer Pesanan ' + $(this).attr('nomer_antrian') + ' akan di hapus ?';
    $( "#tanya_hapus" ).popup( "open");
  }

  function on_tap(event) {
    
  }

  $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( "li" ).on( "swipeleft", swipeleftHandler );
          $( "li" ).on( "swiperight", swipeleftHandler );
          $( "li" ).on( "taphold", on_tap );
        });

  function hapus() {
     hapus_id = $('#btn_delete').attr('hapus_id');
     //console.log(hapus_id);
     window.location  = '<?php echo home_url()?>Ciptogudangrabat_pesanan/delete/' + hapus_id; 
  }

  function item_click(sender,id) {
    GROUP_CUSTOMER = id;
    console.log('masuk');
  }

  document.getElementById('goback').href = "<?php echo home_url() ?>main";

</script>
</body>
</html>