<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
  <title></title>
  <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 

</head>
<body>
	 <div data-role="page" id="page_main" data-theme="a" data-transition="slide" data-ajax="false">
        <?php
           $this->load->view("v_header.php");
        ?>
        <div data-role="content">
          <div style="text-align: center;">
            <h2>DAFTAR PASIEN</h2>
          </div>
          <div>
            <input type="button"  value="BARU" onclick="daftar()">
          </div>
          <div>
            <?php
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
              SELECT
              NO_DAFTAR,
              NAMA_PASIEN,
              RUANGAN,
              coalesce(dokter,'Dokter Belum Dipilih')dokter,
              SHIFT,
              TANGGAL
              FROM MST_KESEHATAN
              WHERE COALESCE( BATAL,0)=0"); 
             ?>
            <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer">
              <?php 
                 $ada_data = 0;
                 $nomer = 1;
                 foreach ($ds_hasil ->result() as $row):
              ?>  
              <li style="margin-bottom: 5px;"  nama_pasien = "<?= $row->NAMA_PASIEN; ?>" ruangan = "<?= $row->RUANGAN; ?>" dokter="<?= $row->DOKTER; ?>" tanggal="<?= $row->TANGGAL; ?>" shift="<?= $row->SHIFT; ?>" id="<?= $row->NO_DAFTAR; ?>">
                   <a href="#">
                    <div style="">
                        
                        <div style="float:left;">
                            <p style="font-size:12px !important">NAMA PASIEN</p>
                            <h3 style="font-size:30px !important;margin-top:-10px"><?= $row->NAMA_PASIEN; ?></h3>
                            <p style="font-size:12px !important;margin-top:-10px">No. <?php echo $nomer++;?></p>
                            <p style="font-size:12px !important">DOKTER :</p>
                          <p style="font-size:14px !important; font-weight:bold;"><?= $row->DOKTER;?></p>
                        </div>
                        <div style="float:right">
                          <p style="font-size:12px !important">RUANGAN</p>
                          <p style="font-size:14px !important;font-weight:bold"><?= $row->RUANGAN;?></p>
                          <p style="font-size:12px !important">TANGGAL</p>
                           <p style="font-size:14px !important;font-weight:bold"><?= $row->TANGGAL; ?></p>
                        </div>
                    </div>   
                  </a>
                </li>
              <?php endforeach; ?>
          </ul>
          </div>




        </div>
        <div data-role="popup" id="tanya_hapus" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                  <div data-role="header" data-theme="a">
                      <h1>Tanya</h1>
                  </div>
                  <div role="main" class="ui-content">
                      <div>
                           <p id="isi_info"></p>
                           
                      </div>
                      <div>
                          <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Cancel</a>

                      </div>
                  </div>
        </div>

        <!-- BATAS POP UP -->

        <div data-role="popup" id="edit_data" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                  <div data-role="header" data-theme="a">
                      <h1>EDIT</h1>
                  </div>
                  <div role="main" class="ui-content">
                      <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_pasien","name"=>"form_pasien","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                          <label for="nama_pasien">Nama Pasien:</label>
                          <input type="text" name="nama_pasien" id="nama_pasien" value="">
                          <label>Ruangan</label>
                          <select name="ruangan" id="ruangan">
                            <option isi="Ruangan" value="Poli"> Ruangan Poli</option>
                            <option isi="Ruangan" value="praktek"> Ruangan praktek</option>
                            <option isi="Ruangan" value="bedah"> Ruangan bedah</option>
                            <option isi="Ruangan" value="gigi"> Ruangan gigi</option>
                          </select>
                          <label for="dokter">Dokter :</label>
                          <input type="text" name="dokter" id="dokter" value="">
                          <label for="tanggal" style="margin-bottom: -15px">Tanggal </label>
                            <input type="date" name="tanggal" data-clear-btn="false" id="tanggal" value="" style="">
                        <label for="shift">Shift</label>
                          <select name="shift" id="shift">
                            <option isi="shift" value="Pagi"> Pagi</option>
                            <option isi="shift" value="Siang"> Siang</option>
                            <option isi="shift" value="Sore"> Sore</option>
                            <option isi="shift" value="Malam"> Malam</option>
                          </select>

                          <!-- <button onclick="tambahdata()">save</button> -->
                          <input type="button" data-inline="true" value="save" onclick="tambahdata()">
                           <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Back</a>
                          <?php echo form_close(); ?>
                      
                  </div>
        </div> 
    </div>
    <script type="text/javascript">
     
      function daftar(){
      window.location = "<?php echo home_url() ?>Ciptogudangrabat_pesanan/testone" 
       }
       

      function swipeleftHandler( event ){ 
        $('#btn_delete').attr('hapus_id',$(this).attr('id') );
        document.getElementById('isi_info').innerHTML = 'Data Pasien ' + $(this).attr('nama_pasien') + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
      }

      function swiperightHandler( event ){ 
        $('#btn_edit').attr('edit_id',$(this).attr('id') );
        
        $( "#edit_data" ).popup( "open");
      }

      $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( "li" ).on( "swipeleft", swipeleftHandler );
          $( "li" ).on( "swiperight", swiperightHandler );
          $( "li" ).on( "click", on_click );
        });

      //--------------------- HAPUS -------------------- // 
      function hapus() {
     hapus_id = $('#btn_delete').attr('hapus_id');
     //console.log(hapus_id);
     window.location  = '<?php echo home_url()?>Ciptogudangrabat_pesanan/hapus_data/' + hapus_id; 
  }
    </script>
</body>
</html>