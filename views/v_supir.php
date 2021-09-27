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
    .flex-container {
      display: flex;
      flex-wrap: nowrap;
    }
  </style>


</head>
<body>
  <div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
    <?php 
         $this->load->view('v_header');
      ?>
      <div>
      <h3 align="center" ><b>DAFTAR SUPIR</b></h3>
      </div>

      <?php
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
               SELECT
                A.*
                FROM SUPIR A;
               "); 

            $ds_foto = $this->db->query("
               SELECT 
                FOTO,NAMA
                FROM SUPIR 
                WHERE KODE = 'SN028';
               "); 
             ?>
    <!-- <div>
        <?php
               if ($ds_foto) {
                  $foto = $ds_foto->row();
               }
            ?>
     
      <br><img src="imageView.php?image_id=<?php echo $foto->FOTO; ?>" style="width:30px;height:30px"><br/>
    </div> -->
    <div>
      <?php
              if (empty($this->input->get('cari'))) 
               echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari User ...">';
          ?>
      <ul class="list" data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer" >
        <?php 
        $ada_data = 0;
        $nomer = 1;
        foreach ($ds_hasil ->result() as $row):
        ?>  

        <li class="li_list" style="margin-bottom: 5px; background-color: #2c3e50; padding-bottom: -20px;">
          <div class="flex-container" style="background-color: #2c3e50; width: 100%; margin-bottom: -10px" >
            <div style="width: 50%">

              <p style=" font-size:12px !important; color: white;">NAMA SUPIR</p>
              <h3 style="font-size:17px !important;margin-top:-5px; color: white;"><?= $row->NAMA; ?></h3>
              <p style="font-size:12px !important;color: white;">ALAMAT</p>
              <h3 style="font-size:12px !important;margin-top:-5px;color: white;"><?= $row->ALAMAT; ?></h3>
            </div>
            <div style="width: 40%">
             <table width="100%">
                <tr>
                  <td style="width: 100%">
                    <div align="center">
                      <p  style=" font-size:12px !important; color: white;" align="center">JENIS SIM:</p>
                    <p  style=" font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;" align="center"><?= $row->JENIS_SIM;?></p>
                    </div>
                  </td>
                </tr>
                 <tr>
                   <td style="width: 100%">
                    <div class="flex-container" align="center">
                      <div style="width: 33%;" >
                      <input align="center" type="button" name="edit_klik" id="edit_klik" value="Detil" data-inline="true" data-theme="b" data-mini="true" onclick="click_detil( '<?= $row->KODE;?>', '<?= $row->NAMA;?>', '<?= $row->ALAMAT;?>', '<?= $row->SIM;?>', '<?= $row->JENIS_SIM;?>', '<?= $row->KTP;?>', '<?= $row->KK;?>', '<?= $row->HP;?>', '<?= $row->EMAIL;?>')"   >
                    </div>
                  
                    <div style="width: 33%; margin-right: -10px; margin-left: -5px">
                      <input align="center" type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" data-theme="e" data-mini="true" onclick="click_edit( '<?= $row->KODE;?>', '<?= $row->NAMA;?>', '<?= $row->ALAMAT;?>', '<?= $row->SIM;?>', '<?= $row->JENIS_SIM;?>', '<?= $row->KTP;?>', '<?= $row->KK;?>', '<?= $row->HP;?>', '<?= $row->EMAIL;?>')"   >
                    </div>
                  
                    <div style="width: 33%">
                      <input align="center" type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true"data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->KODE;?>','<?= $row->NAMA;?>')" >
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

    <div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
               <div style="box-shadow: 1px 2px 3px grey;margin-bottom:20px;margin-left:-45px;background-color: #16a085;position:fixed;bottom:0 !important;width:62px;border-radius: 50%;display: inline-block;height:62px;" onclick="add_data()">
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
       <h3 id="tajuk"><b>TAMBAH DATA SUPIR BARU</b></h3>
        </div>
        <div>
          <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
          <input type="hidden" name="key" id="key">
          <table style="width: 100%">
            <tr>
              <td width="30%">
                <label>Kode Supir:</label>
              </td>
              <td width="70">
                <input data-mini="true" type="text" name="kode_add" id="kode_add" value=""> 
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Nama Supir:</label>
              </td>
              <td width="70">
                <input data-mini="true" type="text" name="nama_add" id="nama_add" value="">
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Alamat:</label>
              </td>
              <td width="70">
                <input data-mini="true" type="text" name="alamat_add" id="alamat_add" value="">
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Nomor SIM:</label>
              </td>
              <td width="70">
                <input data-mini="true" type="text" name="sim_add" id="sim_add" value="">
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Jenis SIM:</label>
              </td>
              <td width="70">
                <input data-mini="true" type="text" name="jenis_sim_add" id="jenis_sim_add" value="">
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Nomor KTP:</label>
              </td>
              <td width="70">
                <input data-mini="true" type="number" name="ktp_add" id="ktp_add" value=""> 
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Nomor KK:</label> 
              </td>
              <td width="70">
                <input data-mini="true" type="number" name="kk_add" id="kk_add" value=""> 
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Nomor HP:</label>
              </td>
              <td width="70">
                <input data-mini="true" type="text" name="hp_add" id="hp_add" value="">
              </td>
            </tr>
            <tr>
              <td width="30%">
                <label>Email Address:</label>
              </td><td width="70">
                <input data-mini="true" type="email" name="email_add" id="email_add" value=""> 
               </td>
             </tr>
             </table>
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

 function click_detil(kode,nama,alamat,sim,jenis_sim,ktp,kk,hp,email) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("kode_add").value = kode;
      document.getElementById("nama_add").value = nama;
      document.getElementById("alamat_add").value = alamat;
      document.getElementById("sim_add").value = sim;
      document.getElementById("jenis_sim_add").value = jenis_sim;
      document.getElementById("ktp_add").value = ktp;
      document.getElementById("kk_add").value = kk;
      document.getElementById("hp_add").value = hp;
      document.getElementById("email_add").value = email;
      document.getElementById("tajuk").innerHTML = 'DETAIL DATA SUPIR';
      document.getElementById("kode_add").disabled = true;
      document.getElementById("nama_add").disabled = true;
      document.getElementById("alamat_add").disabled = true;
      document.getElementById("sim_add").disabled = true;
      document.getElementById("jenis_sim_add").disabled = true;
      document.getElementById("ktp_add").disabled = true;
      document.getElementById("kk_add").disabled = true;
      document.getElementById("hp_add").disabled = true;
      document.getElementById("email_add").disabled = true;
     
}

 function click_edit(kode,nama,alamat,sim,jenis_sim,ktp,kk,hp,email) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("key").value = kode;
      document.getElementById("kode_add").value = kode;
      document.getElementById("nama_add").value = nama;
      document.getElementById("alamat_add").value = alamat;
      document.getElementById("sim_add").value = sim;
      document.getElementById("jenis_sim_add").value = jenis_sim;
      document.getElementById("ktp_add").value = ktp;
      document.getElementById("kk_add").value = kk;
      document.getElementById("hp_add").value = hp;
      document.getElementById("email_add").value = email;
      document.getElementById("tajuk").innerHTML = 'UBAH DATA SUPIR';
      status = 'edit';
      
}

function click_hapus(id, nama){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data Supir ' + nama + ' akan di hapus ?';
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
                url:'<?php echo home_url()?>MasterData/delete_supir',
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
                      window.location  = '<?php echo home_url()?>MasterData/supir'; 
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
      status  = 'tambah';
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_supir'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_supir'
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
                      window.location  = '<?php echo home_url()?>MasterData/supir';
                      
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
function GoBack(){
       window.location  = '<?php echo home_url()?>MasterData';
};
function back(){
  window.location  = '<?php echo home_url()?>MasterData/supir';
};
    </script>
</body>
</html>