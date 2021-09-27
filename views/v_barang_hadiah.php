<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
	<link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
  
	<title></title>
  <style type="text/css">
    .flex-container {
      display: flex;
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
                  a.KODE_BARANG,
                  a.POINT,
                  b.NAMA_BARANG
                FROM 
                  MST_BARANG_HADIAH a
                 inner join MST_BARANG b on b.KODE_BARANG = a.KODE_BARANG ;
               ");

            $ds_barang = $this->db->query("
               SELECT 
               KODE_BARANG,
               NAMA_BARANG
               FROM
               MST_BARANG 

               ORDER BY NAMA_BARANG ASC;
                  "); 
             ?>
<div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
	<?php 
         $this->load->view('v_header');
      ?>
      <div align="center" style="margin-top: -15px" ><h3><b>DAFTAR BARANG HADIAH</b></h3></div>
        <div>
          
              <table width="100%" style="margin-top: -10px">
                <tr style="text-align:center;background-color:#2C3E50;color:white; border: 1px solid; " >
             <td width="25%">
              Kode Barang
             </td>
             <td width="40%">
              Nama Barang
             </td>
             <td width="5%">
               Point
             </td>
             <td width="30%">
               Opsi
             </td>
           </tr>
           <?php 
                 $ada_data = 0;
                 $nomer = 1;
                 foreach ($ds_hasil ->result() as $row):
              ?>  
           <tr>
             <td>
              <?= $row->KODE_BARANG;?>
             </td>
             <td>
              <?= $row->NAMA_BARANG;?>
             </td>
             <td>
               <?= $row->POINT; ?>
             </td>
             <td>
              <table align="center">
                <tr>
                  <td>
                    <div align="center" style=" background-color: #16a085; width:30px;border-radius: 50%;height:30px;" onclick="click_detil('<?= $row->KODE_BARANG;?>','<?= $row->NAMA_BARANG;?>','<?= $row->POINT; ?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/cari.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  <td>
                    <div align="center" style=" background-color: orange; width:30px;border-radius: 50%;height:30px;" onclick="click_edit('<?= $row->KODE_BARANG;?>','<?= $row->NAMA_BARANG;?>','<?= $row->POINT; ?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/ubah.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  <td>
                    <div align="center" style=" background-color: red; width:30px;border-radius: 50%;height:30px;" onclick="click_hapus('<?= $row->KODE_BARANG;?>','<?= $row->NAMA_BARANG;?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/delete.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                </tr>
              </table>
             </td>
           </tr>
         <?php endforeach; ?>
              </table>
        </div>


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

     <div data-role="popup" id="pop_cari_user"  data-theme="a" data-dismissible="false" data-position-to='window'  style="margin-top:200px;max-width:400px;max-height: 200px;">
                  <div data-role="header" style="height:45px">
                      <div id="info_header" align="center" style="width:100%;padding-top:10px">
                        <label id="tajuk_popup"></label>
                     </div>
                  </div>
                  <div align="center" data-role="content">
                      
                      <div>
                          <input tyle="text" id="txt_cari_user" value="" data-clear-btn="true" placholder="ketik disini">
                      </div>
                      <a onclick="" id ='btn_cancel' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                      <a onclick="CariUser_sekarang()" id ='btn_action' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
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

                                    <input data-mini="true" type="text" name="kode_hapus" id="kode_hapus" value=""> 
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
</div>
     
</div><!-- ---------page utama -->


<div data-role="page" id="page_barang" data-transision="slide">
  <?php $this->load->view('v_header') ?>
  <div align="center"><h3>PILIH BARANG HADIAH</h3></div>
  <div class="content">
    <div>
      <ul data-role="listview" data-filter="true" data-filter-placeholder="Cari Barang Hadiah..." data-inset="true">
        <?php 
                 $ada_data = 0;
                 $nomer = 1;
                 foreach ($ds_barang ->result() as $barang):
              ?>  
          <li>
            <a href="#"><?= $barang->NAMA_BARANG;?>
            <input type="hidden" name="kode_hadiah" id="kode_hadiah" value="<?= $barang->KODE_BARANG;?>">
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  
  
</div> 


<div data-role="page" id="page_data" data-transision="slide">
  <?php 
         $this->load->view('v_header');
  ?>
         
        <div align="center">
          <h3 id="tajuk"><b>TAMBAH DATA BARANG HADIAH BARU</b></h3>
        </div>
        <div>
          <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
          <input data-mini="true" type="hidden" name="key" id="key" value="">
          <table width="100%">
            <tr>
              <td style="width: 35%">
                <label>Kode Barang:</label>
              </td>
              <td style="width:  65%">
                <input type="text" name="kode_add" id="kode_add" data-mini="true">
              </td>
            </tr>
            <tr>
              <td style="width: 35%">
                <label>Nama Barang:</label>
              </td>
              <td style="width:  65%">
                <div class="flex-container">
                  <div>
                    <input type="text" name="nama_add" id="nama_add" data-mini="true">
                  </div>
                  <div>
                    <input type="button" name="cari_barang" id="cari_barang" value="Cari" data-mini="true" data-inline="true" onclick="pagebarang_direct()">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td style="width: 35%">
                <label>Point:</label>
              </td>
              <td style="width:  65%">
                <input type="number" name="point_add" id="point_add" data-mini="true">
              </td>
            </tr>
          </table>

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
  
</div><!-- - END PAGE DATA -->

<script type="text/javascript">
	
 function click_detil(kode,nama,point) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("kode_add").value = kode;
      document.getElementById("nama_add").value = nama;
      document.getElementById("point_add").value = point;

      
      document.getElementById("tajuk").innerHTML = 'DETAIL DATA BARANG HADIAH';
      document.getElementById("btn_edit").style.display = 'none';
      document.getElementById("kode_add").disabled=true;
      document.getElementById("nama_add").disabled = true;
      document.getElementById("point_add").disabled = true;
     
}

 function click_edit(kode,nama,point) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("kode_add").value = kode;
      document.getElementById("nama_add").value = nama;
      document.getElementById("point_add").value = point;
      document.getElementById("key").value = kode;
      status = 'edit';
      
}

function click_hapus(id, gudang){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data barang_hadiah ' + gudang + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value = id;
        document.getElementById("kode_hapus").style.display = "none";
}


    function edit_data(){
      $('#form_gudang').submit();

    }
function pagebarang_direct(){
  console.log('yash')
  $.mobile.changePage( "#page_barang", { transition: "slide", changeHash: true });
}

  



//---------------------  klik HAPUS -------------------- // 

$('#form_delete').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>MasterData/delete_barang_hadiah',
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
                      window.location  = '<?php echo home_url()?>MasterData/barang_hadiah'; 
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

$(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          
          $( "li" ).on( "tap", on_tap );
        });
function on_tap( event ){
   console.log(<?php $this->KODE_BARANG ?>)
  }

  // ------------------------------------pageadd
function add_data(){
      document.getElementById("tajuk_popup").innerHTML = 'Cari Barang Hadiah';
       $( "#pop_cari_user" ).popup({ "data-position-to" : "window" });
      $( "#pop_cari_user" ).popup( "open" );
      $('#txt_cari_user').focus();
      status="member"
      // location.reload()
}
function CariUser_sekarang() {
        if (status == "member") {
        window.location = '<?php echo home_url(); ?>MasterData/barang_hadiah#page_barang';
        }else{
        
        window.location = '<?php echo home_url(); ?>MasterData/barang_hadiah#page_barang';
      }
      }

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_barang_hadiah'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_barang_hadiah'
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
                      window.location  = '<?php echo home_url()?>MasterData/barang_hadiah'; 
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
};
</script>   
</body>
</html>