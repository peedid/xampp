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
      $ds_hasil = $this->db->query("
                 SELECT 
                  *
                FROM 
                  MST_OPERATOR
                  "); 
      $ds_pilih = $this->db->query("
                  SELECT
                  *
                  FROM 
                  MST_GUDANG

                  "); 
      
      ?> 
  <div data-role="content">
    <div style=" margin-top: -20px;"><h3 align="center"><b>KARTU MEMEBER</b></h3></div>
    
       
      <div  class="clearfix" style="margin-top: -20px;">
       <div style="float: left; margin-top: 10px;">
        <label style=" font-size: 18px;">Gudang:</label>
      </div>
      <div style="float: right;">
          <form>
          <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                <select name="gudang_option" id="gudang_option">
                  <option value="ALL">SEMUA</option>
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_pilih ->result() as $hasil):
                  ?>
                  while ($hasil = $hasil->fetch_assocc()){
                  <option value="<?= $hasil->KODE_GUDANG; ?>"><?= $hasil->GUDANG; ?></option>
                  }
                  <?php endforeach; ?>
              </select>

          </fieldset>
          </form>
      </div>
      </div> 

      <div style="margin-top: -16px;">
        <form style=" margin-bottom:-5px">
        <?php
              if (empty($this->input->get('cari'))) 
               echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari Member ...">';
        ?>
       </form>
       <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listCustomer" >
        <?php 
          $nomer = 1;
          foreach ($baris_data ->result() as $row):
        ?>
          <li class="li_list" style="margin-bottom: 5px; background-color: #2c3e50; " >
             <div style="background-color: #2c3e50; margin-left:-10px; " class="flex-container">
              <div style="width: 40%">
                <p style=" font-size:12px !important; color: white;">Nama Customer:</p>
                <h3 style="font-size:15px !important; color: white;"><?= $row->NAMA_CUSTOMER;?></h3>
                <p  style=" font-size:12px !important; color: white;">Point:</p>
                <h3  style=" font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;"><?= $row->TOTAL_POINT;?>
                </h3>
              </div>
              <div style="width: 60%">
                <p style=" font-size:12px !important; color: white;"  align="center">Kode Kartu:</p>
                <h3 style="font-size:12px !important;margin-top:-10px; color: white;" align="center"><?= $row->KODE_KARTU;?></h3>
                <table style="width: 100%" align="center">
                  <td style="width: 33%">
                    <div align="center">
                      <input align="center" type="button" name="edit_klik" id="edit_klik" value="Detil" data-inline="true" data-theme="b" data-mini="true" onclick="click_detil('<?= $row->KODE_KARTU;?>','<?= $row->NAMA_CUSTOMER;?>','<?= $row->TOTAL_POINT;?>','<?= $row->ALAMAT;?>','<?= $row->TANGGAL;?>','<?= $row->EXPIRED_DATE;?>','<?= $row->KODE_GUDANG;?>')"   >
                    </div>
                  </td>
                  <td style="width: 33%">
                    <div align="center">
                      <input align="center" type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" data-theme="e" data-mini="true" onclick="click_edit('<?= $row->KODE_KARTU;?>','<?= $row->NAMA_CUSTOMER;?>','<?= $row->TOTAL_POINT;?>','<?= $row->ALAMAT;?>','<?= $row->TANGGAL;?>','<?= $row->EXPIRED_DATE;?>','<?= $row->KODE_GUDANG;?>')"   >
                    </div>
                  </td>
                  <td style="width: 33%">
                   <div align="center">
                      <input align="center" type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true"data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->KODE_KARTU;?>','<?= $row->NAMA_CUSTOMER;?>')" >
                   </div>
                  </td>
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
                 <input data-mini="true" type="hidden" name="operator_hapus" id="operator_hapus" value=""> 
            <?php echo form_close(); ?>
            </p>

            <p id="gagal_hapus"></p>
            </div>
            <div align="center">
              <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" hapus_operator="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
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
       <h3 id="tajuk"><b>TAMBAH KARTU MEMBER</b></h3>
        </div>
        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                              <input type="hidden" name="key" id="key">
                               <select name="gudang_add" id="gudang_add">
                                <?php
                                $ada_data = 0;
                                $nomer = 1;
                                foreach ($ds_pilih ->result() as $hasil):
                                  ?>
                                  while ($hasil = $hasil->fetch_assocc()){
                                  <option value="<?= $hasil->KODE_GUDANG; ?>"><?= $hasil->GUDANG; ?></option>
                                }
                                <?php endforeach; ?>
                              </select>
                              <table width="100%">
                                <tr>
                                  <td width="70%">
                                    <label>Kode Kartu Member:</label>
                                    <input type="text" name="kode_add" id="kode_add" data-mini="true">
                                  </td>
                                  <td width="30%">
                                    <label name="point_add_label" id="point_add_label"></label>
                                    <h3 name="point_add" id="point_add" data-mini="true" ></h3>
                                  </td>
                                </tr>
                              </table>
                              <label name="nama_add_label" id="nama_add_label"></label>
                              <h3 name="nama_add" id="nama_add" data-mini="true" style="margin-top: -10px"></h3>
                              <label name="alamat_add_label" id="alamat_add_label"></label>
                              <h3 name="alamat_add" id="alamat_add" data-mini="true" style="margin-top: -10px"></h3>
                              <table width="100%">
                                <tr>
                                  <td style="width: 50%">
                                     <label name="tanggal_add_label" id="tanggal_add_label"></label>
                                     <label name="tanggal_add" id="tanggal_add" data-mini="true"></label>
                                  </td>
                                  <td style="width: 50%">
                                     <label name="masa_aktif_add_label" id="masa_aktif_add_label"></label>
                                     <label name="masa_aktif_add" id="masa_aktif_add" data-mini="true"></label>
                                  </td>
                                </tr>
                              </table>
                             
                             

                                <?php echo form_close(); ?>
        </div>

        <div align="center">
          <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" onclick="back()">CANCEL</a>
        </div>
<div data-role='content'>
  
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
  
 <div data-role="popup" id="success_message" data-theme="a" data-transition="slide">
                  <div data-role="header" data-theme="a">
                      <h1>SUKSES</h1>
                  </div>
                  <div role="main" class="ui-content">
                    <div>
                       <p id="isi_success">PROSES BERHASIL</p>
                             
                    </div>
                  <div align="center" onclick="GoBack()">
                     <input type="button" name="konfir_berhasil" value="OK">
                  </div>
                  </div>
</div>  
</div>        

<script type="text/javascript">
var status =""
  // ----------------pageedit

  function click_detil(kode,nama,point,alamat,tanggal,expired,gudang) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    $("#gudang_add").val(gudang);
    $("#gudang_add").selectmenu("refresh");
    document.getElementById("key").value=kode;
    document.getElementById("nama_add").innerHTML=nama;
    document.getElementById("alamat_add").innerHTML=alamat;
    document.getElementById("point_add").innerHTML=point;
    document.getElementById("tanggal_add").innerHTML=tanggal;
    document.getElementById("masa_aktif_add").innerHTML=expired;

    document.getElementById("nama_add_label").innerHTML='Nama:';
    document.getElementById("alamat_add_label").innerHTML='Alamat:';
    document.getElementById("point_add_label").innerHTML='Point:';
    document.getElementById("tanggal_add_label").innerHTML='Tanggal Daftar:';
    document.getElementById("masa_aktif_add_label").innerHTML='Berlaku S/d:';
    document.getElementById("gudang_add").disabled="true";
    document.getElementById("kode_add").disabled="true";
    document.getElementById("kode_add").value=kode;
    document.getElementById("btn_edit").style.display="none";
    document.getElementById("tajuk").innerHTML = 'DETIL DATA KARTU MEMBER';

      status = 'edit';
      
}

 function click_edit(kode,nama,point,alamat,tanggal,expired,gudang) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    $("#gudang_add").val(gudang);
    $("#gudang_add").selectmenu("refresh");
    document.getElementById("key").value=kode;
    document.getElementById("nama_add").innerHTML=nama;
    document.getElementById("nama_add").style.display="none";
    document.getElementById("alamat_add").style.display="none";
    document.getElementById("point_add").style.display="none";
    document.getElementById("tanggal_add").style.display="none";
    document.getElementById("masa_aktif_add").style.display="none";
    document.getElementById("kode_add").disabled=false;
    document.getElementById("kode_add").value=kode;
    document.getElementById("btn_edit").style.display="inline";
        document.getElementById("gudang_add").disabled=false;

    document.getElementById("tajuk").innerHTML = 'UBAH DATA KARTU MEMBER';

      status = 'edit';
      
}

function click_hapus(id,nama){ 
        $('#btn_delete').attr(id );
        document.getElementById('isi_hapus').innerHTML = 'Data  Kartu Member ' + id+ ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value=id;
        document.getElementById("operator_hapus").value=$('#gudang_option').val();
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
                url:'<?php echo home_url()?>MasterData/delete_kartu_member',
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
                       window.location  = '<?php echo home_url()?>MasterData';
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
    $("#gudang_add").prop('selectedIndex', 0);
    $("#gudang_add").selectmenu("refresh");
    document.getElementById("key").value=null;
    document.getElementById("nama_add").innerHTML=null;
    document.getElementById("nama_add").style.display="none";
    document.getElementById("alamat_add").style.display="none";
    document.getElementById("point_add").style.display="none";
    document.getElementById("tanggal_add").style.display="none";
    document.getElementById("masa_aktif_add").style.display="none";
    document.getElementById("kode_add").disabled=false;
    document.getElementById("gudang_add").disabled=false;
    document.getElementById("kode_add").value=null;
    document.getElementById("tajuk").innerHTML = 'TAMBAH DATA KARTU MEMBER';
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
              alamat = '<?php echo home_url()?>MasterData/save_kartu_member'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_kartu_member'
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
                       $( "#success_message" ).popup( "open"); 
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
      if ($.mobile.activePage.attr( "id" ) == 'page_data') {
      $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });
        }
    else
    window.location = "<?php echo home_url() ?>main";
}
//---------------option gudang


   $( "#gudang_option" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>MasterData/kartu_member" +"?gudang=" + $('#gudang_option').val();

  });

   var selected = '<?php echo $this->input->get('gudang') ?>';
   if (selected) {
    $('#gudang_option').val(selected);
  } else {
    $('#gudang_option').val('ALL')
  }
   
  </script>
</body>
</html>