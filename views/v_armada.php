<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
  <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
  

  <style type="text/css">
    .clearfix::after{
      content: "";
      clear: both;
      display: table;
    }
 .flex-container {
  display: flex;
  width: 100%; 
}

.flex-container > div {
  margin: 10px;
  width: 100%;  
}


  </style>
</head>
<body>
        <?php
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
               SELECT 
               NOPOL,WARNA,JENIS,TANGGAL_STNK,TAHUN,NO_LAMBUNG,KATEGORI,MEREK,TIPE,NO_STNK,IMEI,TANGGAL_MULAI_BERGABUNG,NAMA_PEMILIK,ALAMAT_PEMILIK,HP,HARGA_SEWA_JAM,HARGA_SEWA_HARI,HARGA_SEWA_BULAN
               FROM MST_ARMADA ;
               ");
            $ds_warna = $this->db->query("
               SELECT * FROM MST_WARNA ;
               ");
            $ds_jenis = $this->db->query("
               SELECT * FROM MST_ARMADA_JENIS ;
               ");
            $ds_kategori = $this->db->query("
               SELECT * FROM MST_ARMADA_KATEGORI ;
               ");
            $ds_merk = $this->db->query("
               SELECT * FROM MST_ARMADA_MEREK ;
               ");
            $ds_tipe = $this->db->query("
               SELECT * FROM MST_ARMADA_TIPE ;
               ");
           
             ?>
  <div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
    <?php 
         $this->load->view('v_header');
      ?>
  <div><h3 align="center" style="margin-bottom:-25px"><b>DATA ARMADA</b></h3></div>

  <div data-role="content">

   
      <div>
       <form style=" margin-bottom:-5px">
        <?php
              if (empty($this->input->get('cari'))) 
               echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari Armada ...">';
        ?>
       </form>
       <table width="100%" style="height: 50px; ">
         <tr>
             <td>
               <table width="100%" style="height: 50px; " >
                 <tr style="text-align:center;background-color:#2C3E50;color:white;  " >
                  <td align="center" width="33%"  style=" border: 1px solid;border-top-left-radius: 5px; border-bottom-left-radius: 5px; ">
                   NOMOR POLISI
                 </td>
                 <td align="center" width="33%"  style=" border: 1px solid;">
                   NAMA PEMILIK
                 </td>
                 <td width="34%" style=" border: 1px solid;border-bottom-right-radius:5px ; border-top-right-radius:5px ">
                   OPSI
                 </td>
                 </tr>
               </table>
             </td>
           </tr>
        <?php 
          $nomer = 1;
          foreach ($ds_hasil ->result() as $row):
        ?>
           <tr data-filter="true" data-inset="true" data-input="#rich-autocomplete-input">
            <td>
             <div class="flex-container" style="width: 100%">
              <div style="width: 35%">
                <?= $row->NOPOL; ?>
              </div>
              <div style="width: 35%">
                <?= $row->NAMA_PEMILIK; ?>
              </div>
              <div style="width: 30%">
              <table style="width: 100%">
                <tr align="center">
                  <td>
                    <div  align="center" style="background-color: #16a085; width:30px;border-radius: 50%;height:30px;" onclick="click_detil('<?= $row->NOPOL; ?>','<?= $row->WARNA; ?>','<?= $row->JENIS; ?>','<?= $row->TANGGAL_STNK; ?>','<?= $row->TAHUN; ?>','<?= $row->NO_LAMBUNG; ?>','<?= $row->KATEGORI; ?>','<?= $row->MEREK; ?>','<?= $row->TIPE; ?>','<?= $row->NO_STNK; ?>','<?= $row->IMEI; ?>','<?= $row->TANGGAL_MULAI_BERGABUNG; ?>','<?= $row->NAMA_PEMILIK; ?>','<?= $row->ALAMAT_PEMILIK; ?>','<?= $row->HP; ?>','<?= $row->HARGA_SEWA_JAM; ?>','<?= $row->HARGA_SEWA_HARI; ?>','<?= $row->HARGA_SEWA_BULAN; ?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/cari.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  <td>
                    <div align="center" style="background-color: orange; width:30px;border-radius: 50%;height:30px;" onclick="click_edit('<?= $row->NOPOL; ?>','<?= $row->WARNA; ?>','<?= $row->JENIS; ?>','<?= $row->TANGGAL_STNK; ?>','<?= $row->TAHUN; ?>','<?= $row->NO_LAMBUNG; ?>','<?= $row->KATEGORI; ?>','<?= $row->MEREK; ?>','<?= $row->TIPE; ?>','<?= $row->NO_STNK; ?>','<?= $row->IMEI; ?>','<?= $row->TANGGAL_MULAI_BERGABUNG; ?>','<?= $row->NAMA_PEMILIK; ?>','<?= $row->ALAMAT_PEMILIK; ?>','<?= $row->HP; ?>','<?= $row->HARGA_SEWA_JAM; ?>','<?= $row->HARGA_SEWA_HARI; ?>','<?= $row->HARGA_SEWA_BULAN; ?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/ubah.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  <td>
                    <div align="center" style="background-color: red; width:30px;border-radius: 50%;height:30px;" onclick="click_hapus('<?= $row->NOPOL; ?>','<?= $row->NAMA_PEMILIK; ?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/delete.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  
                </tr>
              </table>
                
              </div>
             </div><!--  ------------flex -->
             </td>
           </tr>
           <?php endforeach; ?>
       </table>
      </div>
     
    

        </div><!-- --------------------conten -->

<div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
               <div style="/*box-shadow: 1px 2px 3px grey;*/margin-bottom:20px;margin-left:-45px;background-color: #16a085;position:fixed;bottom:0 !important;width:62px;border-radius: 50%;display: inline-block;height:62px;" onclick="add_data()">
                   <table style="margin-top:5px;">
                      <tr>
                         <td  align='center' style="">
                            <div>
                                <img id="tambah_data" src="<?php echo asset_url();?>gambar/plus.png" style="width:30px;height:30px"><br>
                                <span style="font-size:10px;color:white;"><b>Tambah</b></span>
                            </div>
                         </td>
                    </tr>
                    </table>
               </div>
    </div>
    <div data-role="popup" id="tanya_hapus" data-theme="a" data-transition="slide" align="center">
      <div data-role="header" data-theme="b">
          <h1 id="isi_hapus_label">Tanya Hapus</h1>
      </div>
      <div role="main" class="ui-content">
            <div>
            <p id="isi_hapus">
            <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_delete","name"=>"form_delete","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                <input data-mini="true" type="hidden" name="kode_hapus" id="kode_hapus" value=""> 
            <?php echo form_close(); ?>
            </p>

            <p id="gagal_hapus"></p>
            </div>
            <div align="center">
              <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
              <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" onclick="back()">Cancel</a>
            </div>
      </div>
    </div>


    

 
  </div> <!-- ----------dataroleutama -->

<div data-role="page" id="page_data" data-transision="slide">
  <?php 
         $this->load->view('v_header');
      ?>
         
        <div align="center">
       <h3 id="tajuk"><b>TAMBAH ARMADA BARU</b></h3>
        </div>

        <div>
          <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
          <input data-mini="true" type="hidden" name="key" id="key" value="">
          <label>Nomor Polisi:</label>
          <input data-mini="true" type="text" name="nopol_add" id="nopol_add" value="">
          <table  width="100%">
            <tr>
              <td>
                <label for="warna_add">Warna:</label>
                <select name="warna_add" id="warna_add"  data-mini="true">
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_warna ->result() as $warna):
                  ?>
                  {
                  <option value="<?= $warna->WARNA; ?>"><?= $warna->WARNA; ?></option>
                  }
                  <?php endforeach; ?>
                </select>
              </td>
              <td style="width: 50%">
                <label for="jenis_add">jenis:</label>
                <select name="jenis_add" id="jenis_add"  data-mini="true">
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_jenis ->result() as $jenis):
                  ?>
                  {
                  <option value="<?= $jenis->JENIS_MOBIL; ?>"><?= $jenis->JENIS_MOBIL; ?></option>
                  }
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>
            <tr>
              <td style="width: 50%">
                <label>Tanggal STNK:</label>
                <input data-mini="true" type="date" name="tanggal_stnk_add" id="tanggal_stnk_add" value="">
              </td>
              <td>
                <label>Tahun Kendaraan:</label>
                <input data-mini="true" type="number" name="tahun_add" id="tahun_add" value="">
              </td>
            </tr>
          </table>
          <label>No. Rangka:</label>
          <input data-mini="true" type="text" name="no_lambung_add" id="no_lambung_add" value="">
          <table style="width: 100%">
            <tr>
              <td style="width: 50%">
                <label for="kategori_add">Kategori:</label>
                <select name="kategori_add" id="kategori_add"  data-mini="true">
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_kategori ->result() as $kategori):
                  ?>
                  {
                  <option value="<?= $kategori->KATEGORI; ?>"><?= $kategori->KATEGORI; ?></option>
                  }
                  <?php endforeach; ?>
              </select>
              </td>
              <td style="width: 50%">
                <label for="merk_add">Merek:</label>
                <select name="merk_add" id="merk_add" data-mini="true">
                  <option value="">LAIN-LAIN</option>
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_merk ->result() as $merk):
                  ?>
                  {
                  <option value="<?= $merk->MEREK; ?>"><?= $merk->MEREK; ?></option>
                  }
                  <?php endforeach; ?>
              </select>
              </td>
            </tr>
          </table>
          <label for="tipe_add">Tipe:</label>
          <select name="tipe_add" id="tipe_add" data-mini="true">
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_tipe ->result() as $tipe):
                  ?>
                  {
                  <option value="<?= $tipe->TIPE; ?>"><?= $tipe->TIPE; ?></option>
                  }
                  <?php endforeach; ?>
          </select>
          <table>
            <tr>
              <td>
                <label>No. STNK:</label>
                <input data-mini="true" type="text" name="no_stnk_add" id="no_stnk_add" value="">
              </td>
              <td>
                <label>Imei:</label>
                <input data-mini="true" type="text" name="imei_add" id="imei_add" value="">
              </td>
            </tr>
          </table>
          <label>Tanggal Mulai Bergabung:</label>
          <input data-mini="true" type="date" name="tanggal_gabung_add" id="tanggal_gabung_add" value="">
          <table style="width: 100%">
            <tr>
              <td style="width: 60%">
                <label>Nama Pemilik:</label>
                <input data-mini="true" type="text" name="pemilik_add" id="pemilik_add" value="">
              </td>
              <td>
                <label>No. Telp:</label>
                <input data-mini="true" type="text" name="hp_add" id="hp_add" value="">
              </td>
            </tr>
          </table>
          <label>Alamat Pemilik:</label>
          <input data-mini="true" type="text" name="alamat_add" id="alamat_add" value="">
          <table>
            <tr>
              <td style="width: 33%">
                <label>Harga Sewa Per Jam:</label>
                <input data-mini="true" type="number" name="harga_jam_add" id="harga_jam_add" value="">
              </td>
              <td style="width: 33%">
                <label>Harga Sewa Per Hari:</label>
                <input data-mini="true" type="number" name="harga_hari_add" id="harga_hari_add" value="">
              </td>
              <td style="width: 33%">
                <label>Harga Sewa Per Bulan:</label>
                <input type="number" name="harga_bulan_add" id="harga_bulan_add"  >
                <!-- pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" -->
              </td>
            </tr>
          </table>
                             
        </div>

                      <div align="center">
                          <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" onclick="back()">CANCEL</a>
</div>

 <div data-role="popup" id="error_message" data-theme="a" data-transition="slide">
                  <div data-role="header" data-theme="a">
                      <h1>Maaf Proses Gagal</h1>
                  </div>
                  <div role="main" class="ui-content">
                    <div>
                       <p id="isi_errror"></p>
                             
                    </div>
                  <div align="center">
                     <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Cancel</a>

                  </div>
                  </div>
      </div>
  
</div>        

<script type="text/javascript">
var status =""
  // ----------------pageedit

 function click_detil(nopol,warna,jenis,tanggal_stnk,tahun,no_lambung,kategori,merk,tipe,no_stnk,imei,tanggal_gabung,pemilik,alamat,hp,harga_jam,harga_hari,harga_bulan) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
  
    document.getElementById("nopol_add").value=nopol;
    document.getElementById("nopol_add").disabled=true;
    document.getElementById("pemilik_add").value=pemilik;
    document.getElementById("pemilik_add").disabled=true;
    document.getElementById("alamat_add").value=alamat;
    document.getElementById("alamat_add").disabled=true;
    document.getElementById("hp_add").value=hp;
    document.getElementById("hp_add").disabled=true;
    $('#warna_add').val(warna);
    $("#warna_add").selectmenu("refresh");
    document.getElementById("warna_add").disabled=true;
    $('#jenis_add').val(jenis);
    $("#jenis_add").selectmenu("refresh");
    document.getElementById("jenis_add").disabled=true;
    document.getElementById("tanggal_stnk_add").value=tanggal_stnk;
    document.getElementById("tanggal_stnk_add").disabled=true;
    document.getElementById("tahun_add").value=tahun;
    document.getElementById("tahun_add").disabled=true;
    document.getElementById("no_lambung_add").value=no_lambung;
    document.getElementById("no_lambung_add").disabled=true;
    $('#kategori_add').val(kategori);
    $("#kategori_add").selectmenu("refresh");
    document.getElementById("kategori_add").disabled=true;
    $('#merk_add').val(merk);
    $("#merk_add").selectmenu("refresh");
    document.getElementById("merk_add").disabled=true;
    $('#tipe_add').val(tipe);
    $("#tipe_add").selectmenu("refresh");
    document.getElementById("tipe_add").disabled=true;
    document.getElementById("no_stnk_add").value=no_stnk;
    document.getElementById("no_stnk_add").disabled=true;
    document.getElementById("imei_add").value=imei;
    document.getElementById("imei_add").disabled=true;
    document.getElementById("tanggal_gabung_add").value=tanggal_gabung;
    document.getElementById("tanggal_gabung_add").disabled=true;
    document.getElementById("harga_jam_add").value=harga_jam;
    document.getElementById("harga_jam_add").disabled=true;
    document.getElementById("harga_hari_add").value=harga_hari;
    document.getElementById("harga_hari_add").disabled=true;
    document.getElementById("harga_bulan_add").value=harga_bulan;
    document.getElementById("harga_bulan_add").disabled=true;
    document.getElementById("btn_edit").style.display = 'none';
    document.getElementById("tajuk").innerHTML = 'DETIL DATA ARMADA';
}

 function click_edit(nopol,warna,jenis,tanggal_stnk,tahun,no_lambung,kategori,merk,tipe,no_stnk,imei,tanggal_gabung,pemilik,alamat,hp,harga_jam,harga_hari,harga_bulan) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    document.getElementById("key").value=nopol ;
    document.getElementById("nopol_add").value=nopol;
    document.getElementById("pemilik_add").value=pemilik;
    document.getElementById("alamat_add").value=alamat;
    document.getElementById("hp_add").value=hp;
    $('#warna_add').val(warna);
    $("#warna_add").selectmenu("refresh");
    $('#jenis_add').val(jenis);
    $("#jenis_add").selectmenu("refresh");
    $('#kategori_add').val(kategori);
    $("#kategori_add").selectmenu("refresh");
    $('#merk_add').val(merk);
    $("#merk_add").selectmenu("refresh");
    $('#tipe_add').val(tipe);
    $("#tipe_add").selectmenu("refresh");
    document.getElementById("tanggal_stnk_add").value=tanggal_stnk;
    document.getElementById("tahun_add").value=tahun;
    document.getElementById("no_lambung_add").value=no_lambung;
    document.getElementById("no_stnk_add").value=no_stnk;
    document.getElementById("imei_add").value=imei;
    document.getElementById("tanggal_gabung_add").value=tanggal_gabung;
    document.getElementById("harga_jam_add").value=harga_jam;
    document.getElementById("harga_hari_add").value=harga_hari;
    document.getElementById("harga_bulan_add").value=harga_bulan;
     document.getElementById("tajuk").innerHTML = 'EDIT DATA ARMADA';
      status = 'edit';
}

function click_hapus(id, nama){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data Armada Milik ' + nama + ' Nomor Polisi '+ id + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value = id;
        document.getElementById("kode_hapus").style.display = "none";
}


    function edit_data(){
      $('#form_gudang').submit();
      console.log(kolom_harga_add)
      

    }
  
$('#kolom_harga_add').change(function(){
    console.log($(this).find(':selected').text());
    console.log($(this).find(':selected').val()); 
  });


  // //     //---------------------  klik HAPUS -------------------- // 

$('#form_delete').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>MasterData/delete_armada',
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    console.log(res);
                    hasil = JSON.parse(res);
                    if ( hasil.result=='1') {
                      window.location  = '<?php echo home_url()?>MasterData/armada'; 
                    } else {
                      console.log(res);
                      document.getElementById('isi_hapus_label').innerHTML = 'GAGAL HAPUS';
                      document.getElementById('isi_hapus').innerHTML = hasil.message;
                      document.getElementById('btn_delete').style.display = "none";
                      document.getElementById('tanya_hapus').style.align = "center";


                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
});


      function hapus(){
      $('#form_delete').submit();
    }

  // ------------------------------------pageadd
function add_data(){
    if ($.mobile.activePage.attr( "id" ) == 'page_data')
       $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: false });
    else {
      $.mobile.changePage( "#page_data", { transition: "slide", changeHash: false});
      status  = 'tambah';
    }
      // location.reload()
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_armada'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_armada'
        }

        showModal();
        $.ajax({
                url:alamat,
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    console.log(res);
                    hasil = JSON.parse(res);
                    if ( hasil.result=='1') {
                      window.location  = '<?php echo home_url()?>MasterData/armada'; 
                    } else {
                      document.getElementById('isi_errror').innerHTML = hasil.message;
                      $( "#error_message" ).popup( "open");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
});


function tambahdata(){
         $('#form_gudang').submit();                      
      status="tambah";

}

// -------------------------back
function back(){
        $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });
      location.reload()
}
function GoBack(){
       window.location  = '<?php echo home_url()?>MasterData'; 
}
//---------------option gudang


  $( "#gudang_option" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>MasterData/harga" +"?gudang=" + $('#gudang_option').val() + "&group=" + $('#group_option').val();
       console.log($('#gudang_option').val())
      console.log($('#group_option').val())
  });


   var selected = '<?php echo $this->input->get('gudang') ?>';
   if (selected) {
    $('#gudang_option').val(selected);
  } else {
    $('#gudang_option').val('TOKO')
  }


// ---format uang
// Jquery Dependency

// $("input[data-type='currency']").on({
//     keyup: function() {
//       formatCurrency($(this));
//     },
//     blur: function() { 
//       formatCurrency($(this), "blur");
//     }
// });


// function formatNumber(n) {
//   // format number 1000000 to 1,234,567
//   return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
// }


// function formatCurrency(input, blur) {
//   // appends $ to value, validates decimal side
//   // and puts cursor back in right position.
  
//   // get input value
//   var input_val = input.val();
  
//   // don't validate empty input
//   if (input_val === "") { return; }
  
//   // original length
//   var original_len = input_val.length;

//   // initial caret position 
//   var caret_pos = input.prop("selectionStart");
    
//   // check for decimal
//   if (input_val.indexOf(".") >= 0) {

//     // get position of first decimal
//     // this prevents multiple decimals from
//     // being entered
//     var decimal_pos = input_val.indexOf(".");

//     // split number by decimal point
//     var left_side = input_val.substring(0, decimal_pos);
//     var right_side = input_val.substring(decimal_pos);

//     // add commas to left side of number
//     left_side = formatNumber(left_side);

//     // validate right side
//     right_side = formatNumber(right_side);
    
//     // On blur make sure 2 numbers after decimal
//     if (blur === "blur") {
//       right_side += "00";
//     }
    
//     // Limit decimal to only 2 digits
//     right_side = right_side.substring(0, 2);

//     // join number by .
//     input_val = "Rp" + left_side + "." + right_side;

//   } else {
//     // no decimal entered
//     // add commas to number
//     // remove all non-digits
//     input_val = formatNumber(input_val);
//     input_val = "Rp" + input_val;
    
//     // final formatting
//     if (blur === "blur") {
//       input_val += ".00";
//     }
//   }
  
//   // send updated string to input
//   input.val(input_val);

//   // put caret back in the right position
//   var updated_len = input_val.length;
//   caret_pos = updated_len - original_len + caret_pos;
//   input[0].setSelectionRange(caret_pos, caret_pos);
// }



  </script>
</body>
</html>