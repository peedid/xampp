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
    <div style=" margin-top: -20px;"><h3 align="center"><b>OPERATOR GUDANG</b></h3></div>
    
       
      <div  class="clearfix" style="margin-top: -20px;">
       <div style="float: left; margin-top: 10px;">
        <label style=" font-size: 18px;">Operator:</label>
      </div>
      <div style="float: right;">
          <form>
          <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                  <select name="gudang_option" id="gudang_option">
                  <?php 
                  $ada_data = 0;
                  $nomer = 1;
                  foreach ($ds_hasil ->result() as $hasil):
                  ?>
                  while ($hasil = $hasil->fetch_assocc()){
                  <option value="<?= $hasil->KODE_OPERATOR; ?>"><?= $hasil->NAMA; ?></option>
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
               <div style="float:left; width: 50%;">
               <p style=" font-size:12px !important; color: white;">Gudang</p>
               <h3 style="font-size:15px !important;margin-top:-10px; color: white;"><?= $row->GUDANG;?></h3>
                 <table style="margin-top: -10px;">
                    <tr>
                     <td>
                       <p  style=" font-size:12px !important; color: white;">Penyesuaian:</p>
                       <p  style=" font-size:12px !important; color: white; " align="center" ><?php echo($row->PENYESUAIAN_STOCK) == "1" ? "Ya" : "Tidak"; ?>
                      </td>
                      <td>
                       <p style="font-size:12px !important;color: white;">Validasi:</p>
                       <p style="font-size:12px !important;color: white;" align="center"><?php echo($row->VALIDASI_STOK) == "1" ? "Ya" : "Tidak"; ?></p>
                     </td>
                    </tr>
                  </table>
               </div>
                            
              <div style="float: right; width: 50%">
                <p  style=" font-size:12px !important; color: white;" align="center">Kode Gudang</p>
                <p  style=" font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;" align="center"><?= $row->KODE_GUDANG;?></p>
                <div align="center">
                  
                <input align="center" type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" data-theme="e" data-mini="true" onclick="click_edit('<?= $row->PENYESUAIAN_STOCK;?>','<?= $row->VALIDASI_STOK; ?>','<?= $row->KODE_GUDANG;?>')"   >
                <input align="center" type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true"data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->KODE_GUDANG;?>','<?= $row->GUDANG;?>')" >
                </div>
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
         
        <div align="center">
       <h3 id="tajuk"><b>TAMBAH AKSES OPERATOR</b></h3>

        </div>
        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                              <input type="hidden" name="key" id="key">
                              <input type="hidden" name="key_op" id="key_op">
                              <label  for="operator_add" >Pilih Operator:</label>
                                <select name="operator_add" id="operator_add">
                                  <?php 
                                  $ada_data = 0;
                                  $nomer = 1;
                                  foreach ($ds_hasil ->result() as $hasil):
                                  ?>
                                  while ($hasil = $hasil->fetch_assocc()){
                                  <option value="<?= $hasil->KODE_OPERATOR; ?>"><?= $hasil->NAMA; ?></option>
                                  }
                                  <?php endforeach; ?>
                                </select>
                               
                              <label  for="gudang_add" >Pilih Gudang:</label>
                                <select name="gudang_add" id="gudang_add">
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
                                <label for="penyesuaian_add">Penyesuaian Stok:</label>
                                  <select name="penyesuaian_add" id="penyesuaian_add">
                                    <option value="0">Tidak</option>
                                    <option value="1" >Ya</option>
                                  </select>
                                  <label for="validasi_add">Validasi Stok:</label>
                                  <select name="validasi_add" id="validasi_add">
                                    <option value="0">Tidak</option>
                                    <option value="1" >Ya</option>
                                  </select>
                                <?php echo form_close(); ?>
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

 function click_edit(penyesuaian,validasi,kode) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    
    $('#gudang_add').val(kode);
    $("#gudang_add").selectmenu("refresh");
    $('#operator_add').val($('#gudang_option').val());
    $("#operator_add").selectmenu("refresh");
    $('#penyesuaian_add').val(penyesuaian);
    $("#penyesuaian_add").selectmenu("refresh");
    $('#validasi_add').val(validasi);
    $("#validasi_add").selectmenu("refresh");
    document.getElementById("key").value=kode;
    document.getElementById("key_op").value= $('#gudang_option').val();
    document.getElementById("tajuk").innerHTML = 'UBAH AKSES OPERATOR';

      status = 'edit';
      
}

function click_hapus(id,gudang){ 
        $('#btn_delete').attr(id );
        document.getElementById('isi_hapus').innerHTML = 'Data  akes '+$('#gudang_option').val()+' pada gudang ' + gudang + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value=id;
        document.getElementById("operator_hapus").value=$('#gudang_option').val();
        document.getElementById("kode_hapus").style.display = "none";
        document.getElementById("operator_hapus").style.display = "none";
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
                url:'<?php echo home_url()?>MasterData/delete_operator',
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
                      window.location  = '<?php echo home_url()?>MasterData/operator'; 
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
              alamat = '<?php echo home_url()?>MasterData/save_operator'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_operator'
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
                      window.location  = '<?php echo home_url()?>MasterData/operator'; 
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
     window.location  = '<?php echo home_url()?>MasterData'
}
//---------------option gudang


   $( "#gudang_option" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>MasterData/operator" +"?gudang=" + $('#gudang_option').val();

  });

   var selected = '<?php echo $this->input->get('gudang') ?>';
   if (selected) {
    $('#gudang_option').val(selected);
  } else {
    $('#gudang_option').val('DEV1')
  }
   
  </script>
</body>
</html>