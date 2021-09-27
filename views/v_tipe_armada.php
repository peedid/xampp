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

  </style>
</head>
<body>
	 <?php
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
               SELECT 
                *
              FROM 
                MST_ARMADA_TIPE
                ORDER BY TIPE;
               ");

             ?>
<div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
	<?php 
         $this->load->view('v_header');
      ?>
      <div data-role="content">
      	<div align="center" style="margin-top: -25px" ><h3><b>DAFTAR TIPE ARMADA</b></h3></div>
      	<div>
          
              <table width="100%" style="margin-top: -10px">
                <tr style="text-align:center;background-color:#2C3E50;color:white; border: 1px solid; " >
             <td width="80%">
              Tipe Armada
             </td>
             
             <td width="40%">
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
              <?= $row->TIPE;?>
             </td>
             
             <td>
              <table align="center">
                <tr>
                  
                  <td>
                    <div align="center" style=" background-color: orange; width:30px;border-radius: 50%;height:30px;" onclick="click_edit('<?= $row->TIPE;?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/ubah.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  <td>
                    <div align="center" style=" background-color: red; width:30px;border-radius: 50%;height:30px;" onclick="click_hapus('<?= $row->TIPE;?>')">
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
      </div><!-- ----------------akhir content -->


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
     
</div><!-- ---------page utama -->
<div data-role="page" id="page_data" data-transision="slide">
  <?php 
         $this->load->view('v_header');
      ?>
       <div data-role='content'>  
        <div align="center">
       <h3 id="tajuk"><b>TAMBAH DATA TIPE ARMADA BARU</b></h3>
        </div>
        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                                <input data-mini="true" type="hidden" name="key" id="key" value="">
                                <label>Tipe Armada:</label>
                                <input data-mini="true" type="text" name="tipe_add" id="tipe_add" value="">
                                
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
	
 function click_detil(kode) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      
      document.getElementById("tipe_add").value = kode;
      document.getElementById("tajuk").innerHTML = 'DETAIL TIPE ARMADA';
      document.getElementById("tipe_add").disabled = true;
     
}

 function click_edit(kode) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("tipe_add").value = kode;
      document.getElementById("key").value = kode;
      document.getElementById("tajuk").innerHTML = 'UBAH TIPE ARMADA';

      status = 'edit';
      
}

function click_hapus(id){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data Tipe Armada ' + id + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value = id;
        document.getElementById("kode_hapus").style.display = "none";
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
                url:'<?php echo home_url()?>MasterData/delete_tipe_armada',
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
                      window.location  = '<?php echo home_url()?>MasterData/tipe_armada'; 
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
      document.getElementById("tipe_add").value = null;
      document.getElementById("key").value = null;
      document.getElementById("tajuk").innerHTML = 'TAMBAH TIPE ARMADA';
      status  = 'tambah';
      // location.reload()
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_tipe_armada'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_tipe_armada'
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
                      window.location  = '<?php echo home_url()?>MasterData/tipe_armada'; 
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
};
</script>   
</body>
</html>