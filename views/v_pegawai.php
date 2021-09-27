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


  </style>


</head>
<body>
  <div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
    <?php 
         $this->load->view('v_header');
      ?>
  
  <?php
      $trading = $this->model->load_trading();
      $this->db = $trading;
      $ds_pilih = $this->db->query("
                  SELECT
                  *
                  FROM 
                  MST_GUDANG

                  "); 
      
      $ds_jabatan = $this->db->query("
                  SELECT
                  *
                  FROM 
                  MST_JABATAN

                  "); 
      ?> 
  <div data-role="content">
    <div style=" margin-top: -20px;"><h3 align="center"><b>DATA PEGAWAI</b></h3></div>
    
       
      <div  class="clearfix" style="margin-top: -20px;">
       <div style="float: left; margin-top: 10px;">
        <label style=" font-size: 18px;">Gudang:</label>
      </div>
      <div style="float: right;">
          <form>
          <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                  <select name="gudang_option" id="gudang_option">
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_pilih ->result() as $pilih):
                  ?>
                  while ($pilih = $pilih->fetch_assocc()){
                  <option value="<?= $pilih->KODE_GUDANG; ?>"><?= $pilih->GUDANG; ?></option>
                  }
                  <?php endforeach; ?>
              </select>

          </fieldset>
          </form>
      </div>
      </div> 

      <div style="margin-top: -16px;">
       <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listCustomer" >
        <?php 
          $nomer = 1;
          foreach ($baris_data ->result() as $row):
        ?>
          <li class="li_list" style="margin-bottom: 5px; background-color: #2c3e50; padding-bottom: 10px; " >
             <div style="background-color: #2c3e50; clear: both;">
               <div style="float:left; width: 40%;">
               <p style=" font-size:12px !important; color: white;">Nama Pegawai:</p>
               <h3 style="font-size:15px !important;margin-top:-10px; color: white;"><?= $row->NAMA_LENGKAP;?></h3>
               <p  style=" font-size:12px !important; color: white;">Jabatan:</p>
                <p  style=" margin-top: -7px; font-size:12px !important; color: white;"><?= $row->JABATAN;?></p>
                      
               </div>
                            
              <div style="float: right; width: 60%">
                
               <table width="100%">
                <tr>
                  <td style="width: 100%">
                    <div align="center">
                      <p  style=" font-size:12px !important; color: white;" align="center">NIP:</p>
                    <p  style=" font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;" align="center"><?= $row->NIP;?></p>
                    </div>
                  </td>
                </tr>
                 <tr>
                   <td style="width: 100%">
                    <div class="flex-container" align="center">
                      <div style="width: 33%;" >
                      <input align="center" type="button" name="edit_klik" id="edit_klik" value="Detil" data-inline="true" data-theme="b" data-mini="true" onclick="click_detil('<?= $row->NIP; ?>','<?= $row->NO_KARTU; ?>','<?= $row->NAMA_LENGKAP; ?>','<?= $row->NAMA_PANGGILAN; ?>','<?= $row->NAMA_MESIN; ?>','<?= $row->MENU_MESIN; ?>','<?= $row->PIN; ?>','<?= $row->AKTIF; ?>','<?= $row->JABATAN; ?>','<?= $row->KODE_GUDANG; ?>','<?= $row->UPAH; ?>')"   >
                    </div>
                  
                    <div style="width: 33%; margin-right: -10px; margin-left: -5px">
                      <input align="center" type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" data-theme="e" data-mini="true" onclick="click_edit('<?= $row->NIP; ?>','<?= $row->NO_KARTU; ?>','<?= $row->NAMA_LENGKAP; ?>','<?= $row->NAMA_PANGGILAN; ?>','<?= $row->NAMA_MESIN; ?>','<?= $row->MENU_MESIN; ?>','<?= $row->PIN; ?>','<?= $row->AKTIF; ?>','<?= $row->JABATAN; ?>','<?= $row->KODE_GUDANG; ?>','<?= $row->UPAH; ?>')"   >
                    </div>
                  
                    <div style="width: 33%">
                      <input align="center" type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true"data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->NIP;?>','<?= $row->NAMA_LENGKAP;?>')" >
                    </div>
                      
                    </div>
                  </td>
                 </tr>
               </table> 
               </div>
                            
             </div>
                   
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

  </div><!-- --------------------conten -->

  <div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
               <div style="box-shadow: 1px 2px 3px grey;margin-bottom:20px;margin-left:-45px;background-color: #16a085;position:fixed;bottom:0 !important;width:62px;border-radius: 50%;display: inline-block;height:62px;" onclick="add_data('<?php echo $this->input->get('gudang') ?>')">
                   <table style="margin-top:5px;">
                      <tr>
                         <td  align='center' style="">
                            <div>
                                <img id="tambah_data" src="<?php echo asset_url();?>gambar/plus.png" style="width:28px;height:30px"><br>
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
                 <input data-mini="true" type="hidden" name="pegawai_hapus" id="pegawai_hapus" value=""> 
            <?php echo form_close(); ?>
            </p>

            <p id="gagal_hapus"></p>
            </div>
            <div align="center">
              <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" hapus_pegawai="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
              <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" onclick="back()">Cancel</a>
            </div>
      </div>
    </div>
 
  </div> <!-- ----------dataroleutama -->

<div data-role="page" id="page_data" data-transision="slide">
  <?php 
         $this->load->view('v_header');
      ?>
      <div data-role='content'>
         
        <div align="center">
       <h3 id="tajuk"><b>TAMBAH AKSES PEGAWAI</b></h3>

        </div>
        <div>
          <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
          <input type="hidden" name="key" id="key">
          <div class="flex-container" style="width: 100%">
            <div style="width: 50%">
              <label  for="gudang_add" style="margin-top: 15px" >Gudang:</label>
            </div>
            <div style="width: 50%">
              <select name="gudang_add" id="gudang_add" data-mini="true">
            <?php
            $ada_data = 0;
            $nomer = 1;
            foreach ($ds_pilih ->result() as $pilih):
            ?>
            {
            <option value="<?= $pilih->KODE_GUDANG; ?>"><?= $pilih->GUDANG; ?></option>
            }
            <?php endforeach; ?>
          </select>
            </div>
            
          </div>
          <label>NIP:</label>
          <input type="text" name="nip_add" id="nip_add"  data-mini="true">
          <label>Nama:</label>
          <input type="text" name="nama_add" id="nama_add"  data-mini="true">
          <div class="flex-container" style="width: 100%">
            <div style="width: 50%">
              <label  for="jabatan_add" style="margin-top: 15px;" >Jabatan:</label>
            </div>
            <div style="width: 50%">
              <select name="jabatan_add" id="jabatan_add"  data-mini="true">
                <?php
                $ada_data = 0;
                $nomer = 1;
                foreach ($ds_jabatan ->result() as $jabatan):
                ?>
                while ($jabatan = $jabatan->fetch_assocc()){
                <option value="<?= $jabatan->JABATAN; ?>"><?= $jabatan->JABATAN; ?></option>
                }
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <label>Nama Di mesin:</label>
          <input type="text" name="nama_mesin_add" id="nama_mesin_add"  data-mini="true">
          <table>
            <tr>
              <td>
                <label>Nomor Kartu Mesin:</label>
                <input type="number" name="kartu_add" id="kartu_add"  data-mini="true">
              </td>
              <td>
                <label>PIN:</label>
                <input type="number" name="pin_add" id="pin_add"  data-mini="true">
              </td>
            </tr>
          </table>
          <label>Gaji:</label>
          <input type="number" name="gaji_add" id="gaji_add"  data-mini="true">
                               
          <?php echo form_close(); ?>
        </div>

        <div align="center">
          <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" onclick="back()">CANCEL</a>
        </div>
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

function click_detil(id,no_kartu,nama,panggilan,nama_mesin,menu,pin,aktif,jabatan,gudang,upah) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    document.getElementById("key").value=id;    
    $('#gudang_add').val(gudang);
    $("#gudang_add").selectmenu("refresh");
    $('#jabatan_add').val(jabatan);
    $("#jabatan_add").selectmenu("refresh");
    document.getElementById("nama_add").value=nama;
    document.getElementById("nama_mesin_add").value=nama_mesin;
    document.getElementById("kartu_add").value=no_kartu;
    document.getElementById("pin_add").value=pin;
    document.getElementById("gaji_add").value=upah;
    document.getElementById("nip_add").value=id;
    document.getElementById("tajuk").innerHTML = 'UBAH DATA PEGAWAI';
    document.getElementById("nama_add").disabled="true";
    document.getElementById("nama_mesin_add").disabled="true";
    document.getElementById("kartu_add").disabled="true";
    document.getElementById("pin_add").disabled="true";
    document.getElementById("gaji_add").disabled="true";
    document.getElementById("nip_add").disabled="true"
    document.getElementById("gudang_add").disabled="true"
    document.getElementById("jabatan_add").disabled="true"
    document.getElementById("btn_edit").style.display="none";
      
}

 function click_edit(id,no_kartu,nama,panggilan,nama_mesin,menu,pin,aktif,jabatan,gudang,upah) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
     document.getElementById("key").value=id;    
    $('#gudang_add').val(gudang);
    $("#gudang_add").selectmenu("refresh");
    $('#jabatan_add').val(jabatan);
    $("#jabatan_add").selectmenu("refresh");
    document.getElementById("nama_add").value=nama;
    document.getElementById("nama_mesin_add").value=nama_mesin;
    document.getElementById("kartu_add").value=no_kartu;
    document.getElementById("pin_add").value=pin;
    document.getElementById("gaji_add").value=upah;
    document.getElementById("nip_add").value=id;
    document.getElementById("tajuk").innerHTML = 'UBAH DATA PEGAWAI';
    document.getElementById("nama_add").disabled=false;
    document.getElementById("nama_mesin_add").disabled=false;
    document.getElementById("kartu_add").disabled=false;
    document.getElementById("pin_add").disabled=false;
    document.getElementById("gaji_add").disabled=false;
    document.getElementById("nip_add").disabled=false
    document.getElementById("gudang_add").disabled=false
    document.getElementById("jabatan_add").disabled=false
    document.getElementById("btn_edit").style.display="inline";

      status = 'edit';
      
}

function click_hapus(id,nama){ 
        $('#btn_delete').attr(id );
        document.getElementById('isi_hapus').innerHTML = 'Data  Pegawai ' + nama + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value=id;
        document.getElementById("pegawai_hapus").value=$('#gudang_option').val();
        document.getElementById("kode_hapus").style.display = "none";
        document.getElementById("pegawai_hapus").style.display = "none";
}


    function edit_data(){
      $('#form_gudang').submit();

    }
  



  // //     //---------------------  klik HAPUS -------------------- // 

$('#form_delete').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>MasterData/delete_pegawai',
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
                      window.location  = '<?php echo home_url()?>MasterData/pegawai'; 
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
 $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
     document.getElementById("key").value=null;    
    $('#gudang_add').prop('selectedIndex', 0);
    $("#gudang_add").selectmenu("refresh");
    $('#jabatan_add').prop('selectedIndex', 0);
    $("#jabatan_add").selectmenu("refresh");
    document.getElementById("nama_add").value=null;
    document.getElementById("nama_mesin_add").value=null;
    document.getElementById("kartu_add").value=null;
    document.getElementById("pin_add").value=null;
    document.getElementById("gaji_add").value=null;
    document.getElementById("nip_add").value=null;
    document.getElementById("tajuk").innerHTML = 'TAMBAH DATA PEGAWAI';
    document.getElementById("nama_add").disabled=false;
    document.getElementById("nama_mesin_add").disabled=false;
    document.getElementById("kartu_add").disabled=false;
    document.getElementById("pin_add").disabled=false;
    document.getElementById("gaji_add").disabled=false;
    document.getElementById("nip_add").disabled=false
    document.getElementById("gudang_add").disabled=false
    document.getElementById("jabatan_add").disabled=false
    document.getElementById("btn_edit").style.display="inline";


      status  = 'tambah';

      // location.reload()
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_pegawai'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_pegawai'
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
                      window.location  = '<?php echo home_url()?>MasterData/pegawai'; 
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
     window.location  = '<?php echo home_url()?>MasterData/pegawai'
}
function GoBack(){
      if ($.mobile.activePage.attr( "id" ) == 'page_data') {
      $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });
        }
    else
    window.location = "<?php echo home_url() ?>main";
}
//---------------option gudang


   $( "#gudang_option" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>MasterData/pegawai" +"?gudang=" + $('#gudang_option').val();

  });

   var selected = '<?php echo $this->input->get('gudang') ?>';
   if (selected) {
    $('#gudang_option').val(selected);
  } else {
    $('#gudang_option').val('TOKO')
  }
   
  </script>
</body>
</html>