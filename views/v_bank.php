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
                  a.*,b.KETERANGAN
                FROM 
                  MST_BANK A
                  LEFT JOIN MST_COA B ON B.KODE_COA = A.KODE_COA 
                  "); 
      $ds_pilih = $this->db->query("
                  SELECT
                  *
                  FROM 
                  MST_COA

                  "); 
      
      ?> 
  <div data-role="content">
    <div style=" margin-top: -20px;"><h3 align="center"><b>DAFTAR DATA BANK</b></h3></div>
    
       

      <div style="margin-top: -5px;">
       <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listCustomer" >
        <?php 
          $nomer = 1;
          foreach ($ds_hasil ->result() as $row):
        ?>
          <li class="li_list" style="margin-bottom: 5px; background-color: #2c3e50; padding-bottom: 10px; " >
             <div style="background-color: #2c3e50; clear: both;">
               <div style="float:left; width: 50%;">
               <p style=" font-size:12px !important; color: white;">Nama Bank:</p>
               <h3 style="font-size:15px !important;margin-top:-10px; color: white;"><?= $row->BANK;?></h3>
               <p style=" font-size:12px !important; color: white;">Akun:</p>
               <h3 style="font-size:15px !important;margin-top:-10px; color: white;"><?= $row->KETERANGAN;?></h3>
                 
               </div>
                            
              <div style="float: right; width: 50%">
                <p  style=" font-size:12px !important; color: white;" align="center">Kode Bank:</p>
                <p  style=" font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;" align="center"><?= $row->KODE_BANK;?></p>
                <div align="center">
                  
                <input align="center" type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" data-theme="e" data-mini="true" onclick="click_edit('<?= $row->BANK;?>','<?= $row->KODE_BANK; ?>','<?= $row->KODE_COA;?>')"   >
                <input align="center" type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true"data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->KODE_BANK;?>','<?= $row->BANK;?>')" >
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
                 <input data-mini="true" type="hidden" name="bank_hapus" id="bank_hapus" value=""> 
            <?php echo form_close(); ?>
            </p>

            <p id="gagal_hapus"></p>
            </div>
            <div align="center">
              <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" hapus_bank="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
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
       <h3 id="tajuk"><b>TAMBAH AKSES BANK</b></h3>

        </div>
        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                              <input type="hidden" name="key" id="key">
                              <label>Kode Bank</label>
                              <input type="text" name="kode_add" id="kode_add" data-mini="true">
                              <label>Bank</label>
                              <input type="text" name="bank_add" id="bank_add" data-mini="true">
                              <label  for="coa_add" >Pilih Akun:</label>
                                <select name="coa_add" id="coa_add" data-mini="true">
                                  <?php 
                                  $ada_data = 0;
                                  $nomer = 1;
                                  foreach ($ds_pilih ->result() as $pilih):
                                  ?>
                                  while ($pilih = $pilih->fetch_assocc()){
                                  <option value="<?= $pilih->KODE_COA; ?>"><?= $pilih->KETERANGAN; ?></option>
                                  }
                                  <?php endforeach; ?>
                                </select>
                                
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

 function click_edit(nama,kode,coa) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    
    $('#coa_add').val(coa);
    $("#coa_add").selectmenu("refresh");
    document.getElementById("key").value=kode;
    document.getElementById("kode_add").value=kode;
    document.getElementById("bank_add").value=nama;
    document.getElementById("tajuk").innerHTML = 'UBAH DATA BANK';

      status = 'edit';
      
}

function click_hapus(id,nama){ 
        $('#btn_delete').attr(id );
        document.getElementById('isi_hapus').innerHTML = 'Data Bank ' + nama + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value=id;
        document.getElementById("bank_hapus").value=$('#gudang_option').val();
        document.getElementById("kode_hapus").style.display = "none";
        document.getElementById("bank_hapus").style.display = "none";
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
                url:'<?php echo home_url()?>MasterData/delete_bank',
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
                      window.location  = '<?php echo home_url()?>MasterData/bank'; 
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
    $('#coa_add').prop('selectedIndex', 0);
    $("#coa_add").selectmenu("refresh");
    document.getElementById("key").value=null;
    document.getElementById("kode_add").value=null;
    document.getElementById("bank_add").value=null;
    document.getElementById("tajuk").innerHTML = 'TAMBAH DATA BANK';
      status  = 'tambah';
 
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_bank'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_bank'
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
                      window.location  = '<?php echo home_url()?>MasterData/bank'; 
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
   
  </script>
</body>
</html>