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
          <p align="center" style='font-size:15px;font-weight:bold'> DAFTAR DINA KIEN</p>
          <div style="clear: both;"></div>          
        <?php
          $trading = $this->model->load_trading();
          $this->db = $trading;
          $q_antrian = $this->db->query("select IIF(a.status_antrian='SELESAI' OR a.status_antrian = 'CANCEL', '', (
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
              )) lama_menit,
              kode_antrian, nomer_antrian, status_antrian, online_cetak, online, atas_nama, ( select x.nama_lengkap from mst_pegawai x where x.nip = a.nip ) nama_pegawai from mst_antrian_layanan a where tanggal = current_date order by nomer_antrian",array($this->session->userdata('kode_buildup')));
          ?>

          <div id="div_tambahan" style="height:100px">
               <div style="float:left">
                  <input type="button" data-mini="true" data-inline="true" value="Print Me" id="btn_print_me" onclick="print_me()">
               </div>
               <div style="float:left;">
                  <p id="info_tambahan"></p>
               </div>
          </div>

          <div style="clear:both;"></div>
          <ul data-role="listview" data-filter="true" data-filter-placeholder="Search Here" data-inset="true" id="listGCustomer">
              <?php 
                 $belum_dicetak = 0;
                 $nomer_1 = 0;
                 $nomer_2 = 0;
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
                              if (($row->STATUS_ANTRIAN !='CANCEL' && $row->STATUS_ANTRIAN != 'SELESAI' ))
                                echo '<p style="text-align:center;margin-top:10px">Dah nunggu</p>';
                          ?>
                           <p style="text-align:center;font-size:12px;margin-top:-5px"><?= $row->LAMA_MENIT; ?></p>
                        </div>
                    
                    
                        <table style="float:left;color:white;margin-top:-20px">
                          <tr>
                            <td style="text-align:left">
                              <p>Status :</p>
                              <p id="status_<?php $nomer_1 = $nomer_1 + 1; echo $row->KODE_ANTRIAN."_".$nomer_1; ?>" style="font-size:15px;margin-top:-5px;color:orange"> <?= $row->STATUS_ANTRIAN; ?></p>
                            </td>
                            <td style="width:40px">
                            </td>
                            <td style="text-align:left">
                              <p>Cara :</p><p style="font-size:15px;margin-top:-5px;color:orange"> <?php if ($row->ONLINE==1) echo "Online"; else echo "Datang Langsung"; ?></p>
                            </td>
                            <td style="width:40px">
                            </td>
                            <td style="text-align:left">
                              <p >Dicetak :</p>
                              <p id="dicetak_<?php $nomer_2 = $nomer_2 + 1; echo $row->KODE_ANTRIAN.'_'.$nomer_2; ?>" style="font-size:15px;margin-top:-5px;color:orange"> 
                                <?php 
                                     if ($row->ONLINE == 1) {
                                        if ($row->ONLINE_CETAK==1)
                                          echo "Udah"; 
                                        else {
                                          if ($row->STATUS_ANTRIAN != 'CANCEL')
                                              $belum_dicetak = $belum_dicetak + 1;
                                          echo "Belum";
                                        }
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


        <div data-role="popup" id="tanya"  data-theme="b" data-dismissible="false" style="max-width:400px;" position="window">
            <div data-role="header" style="margin-top:-20px;height:45px">
                <div id="info_header" align="center" style="width:100%;padding-top:10px">
                    Tanya
               </div>
            </div>
            <div align="center" data-theme='d' data-role="content">
                <p id="info_tanya"></p>
                <a id="kerjakan_sekarang" href="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">OK</a>
                <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">CANCEL</a>
            </div>
      </div>

    </div>
<div>NEXT</div>    
<script>
  var namatoko = '<?php echo $this->session->userdata('namatoko');?>';

  $('#div_tambahan').hide();

  <?php 
    if ($belum_dicetak > 0) {
       echo "document.getElementById('info_tambahan').innerHTML = '*) Ada $belum_dicetak pesanan Online belum dicetak';";
       echo "$('#div_tambahan').show();";
    }
  ?>

  var data = "";

  function swipeleftHandler( event ){
    $('#btn_delete').attr('hapus_id',$(this).attr('id') );
    document.getElementById('isi_info').innerHTML = 'Nomer Pesanan ' + $(this).attr('nomer_antrian') + ' akan di hapus ?';
    $( "#tanya_hapus" ).popup( "open");
  }

  function on_tap(event) {
    data = '{"method_name":"send_to_user","workspace":"<?php echo $this->session->userdata('namatoko');?>", "kode_user":"AGENT", "data" : {"method_name":"CETAK_ANTRIANONLINE","kode_antrian":"'+ $(this).attr('id') +'"}}';
    document.getElementById('info_tanya').innerHTML = ''document.getElementById($(this).attr('id')).innerHTML'';
    $('#tanya').popup('open');
    //
  }

  $('#kerjakan_sekarang').on('click',function() {
  	$('#tanya').popup('close');
    send_websocket(data);
    window.location  = '<?php echo home_url()?>Ciptogudangrabat_pesanan/today_all';
  });




  $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( "li" ).on( "swipeleft", swipeleftHandler );
          $( "li" ).on( "swiperight", swipeleftHandler );
          $( "li" ).on( "taphold", on_tap );
        });

  function hapus() {
     hapus_id = $('#btn_delete').attr('hapus_id');
     //console.log(hapus_id);
     window.location  = '<?php echo home_url()?>Ciptogudangrabat_pesanan/delete_today/' + hapus_id; 
  }

  function item_click(sender,id) {
    GROUP_CUSTOMER = id;
    console.log('masuk');
  }

function print_me() {
    nomer = 0;
    $("#listGCustomer li").each(function(idx, li) {
        nomer = nomer + 1;
        if ( 
              (document.getElementById('status_' + $(li).attr('id') +'_'+ nomer).innerHTML).trim() != 'SELESAI' && 
              (document.getElementById('status_' + $(li).attr('id') +'_'+ nomer).innerHTML).trim() != 'CANCEL' &&
              (document.getElementById('dicetak_' + $(li).attr('id') +'_'+ nomer).innerHTML).trim() == 'Belum'
           ) {

            data = '{"method_name":"send_to_user","workspace":"'+ namatoko +'", "kode_user":"AGENT", "data" : {"method_name":"CETAK_ANTRIANONLINE","kode_antrian":"'+ $(li).attr('id') +'"}}';
            send_websocket(data);
            //console.log(data);
        }
    });
    if (nomer >0)
      window.location  = '<?php echo home_url()?>Ciptogudangrabat_pesanan/today_all';
}


  document.getElementById('goback').href = "<?php echo home_url() ?>main";

  function GoBack() {
    window.location = "<?php echo home_url() ?>main";
  }

</script>

</body>
</html>