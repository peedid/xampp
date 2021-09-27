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
  <div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
    <?php 
         $this->load->view('v_header');
      ?>
  <div style="margin-top: -10px; margin-bottom: -40PX"><h3 align="center"><b>DAFTAR CUSTOMER</b></h3></div>
  <?php
      $trading = $this->model->load_trading();
      $this->db = $trading;
      $ds_hasil = $this->db->query("
                  SELECT
                  IIF(COALESCE(A.KODE_GUDANG,'')='','TOKO',A.KODE_GUDANG)KODE_GUDANG,
                  A.GUDANG
                  FROM MST_GUDANG A;

                  "); 
      $ds_group = $this->db->query("
                  SELECT
                  *
                  FROM 
                  MST_G_CUSTOMER
                  ");
      $ds_harga = $this->db->query("
                  SELECT   
                  HARGA_JUAL1_JUDUL,
                  HARGA_JUAL2_JUDUL,
                  HARGA_JUAL3_JUDUL,
                  HARGA_JUAL4_JUDUL,
                  HARGA_JUAL5_JUDUL
                 FROM 
                  MST_CONFIG ;
                  "); 
      ?> 
  <div data-role="content">
    
       
      <div>
       <form>
        <?php
              if (empty($this->input->get('cari'))) 
               echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari User ...">';
        ?>
       </form>
       <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listCustomer">
        <?php 
          $nomer = 1;
          foreach ($baris_data ->result() as $row):
        ?>
          <li class="li_list" style="margin-bottom: 5px; background-color: #2c3e50; padding-bottom: 10px; " >
             <div style="background-color: #2c3e50; clear: both;">
               <div style="float:left; width: 40%;">
               <p style=" font-size:12px !important; color: white;">Nama Customer</p>
               <h3 style="font-size:15px !important;margin-top:-10px; color: white;"><?= $row->NAMA_CUSTOMER; ?></h3>
               <p style="font-size:12px !important;color: white;">Alamat</p>
               <h3 style="font-size:12px !important;margin-top:-10px;color: white;"><?= $row->ALAMAT; ?></h3>
               </div>
                            
              <div style="float: right; width: 60%">
                <p  style=" font-size:12px !important; color: white;" align="center">Kode Customer</p>
                <p  style=" font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;" align="center"><?= $row->KODE_CUSTOMER;?></p>
                <div align="center" style="width: 100%" class="flex-container"> 
                  <div >
                  <input align="center" type="button" name="detil_klik" id="detil_klik" value="detil" data-inline="true" data-theme="b" data-mini="true" onclick="click_detil('<?= $row->NAMA_CUSTOMER; ?>','<?= $row->ALAMAT; ?>','<?= $row->NAMA_ORANGTUA; ?>','<?= $row->GROUP_CUSTOMER; ?>','<?= $row->TELP; ?>','<?= $row->PLAFOND_KREDIT; ?>','<?= $row->HARGA_JUAL; ?>','<?= $row->KODE_CUSTOMER; ?>','<?= $row->KODE_GUDANG; ?>')"   >                    
                  </div>
                <div  style="margin-left: -17px" >
                  <input align="center" type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" data-theme="e" data-mini="true" onclick="click_edit('<?= $row->NAMA_CUSTOMER; ?>','<?= $row->ALAMAT; ?>','<?= $row->NAMA_ORANGTUA; ?>','<?= $row->GROUP_CUSTOMER; ?>','<?= $row->TELP; ?>','<?= $row->PLAFOND_KREDIT; ?>','<?= $row->HARGA_JUAL; ?>','<?= $row->KODE_CUSTOMER; ?>','<?= $row->KODE_GUDANG; ?>')"   >
                </div>
                <div  style="margin-left: -17px" >
                  <input align="center" type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true"data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->KODE_CUSTOMER;?>','<?= $row->NAMA_CUSTOMER;?>')" >
                </div>
                </div>
                </div>
                            
             </div>
                   
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

  <div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
               <div style="box-shadow: 1px 2px 3px grey;margin-bottom:20px;margin-left:-45px;background-color: #16a085;position:fixed;bottom:0 !important;width:62px;border-radius: 50%;display: inline-block;height:62px;" onclick="add_data('<?php echo $this->input->get('gudang') ?>')">
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
                <input data-mini="true" type="text" name="kode_hapus" id="kode_hapus" value=""> 
            <?php echo form_close(); ?>
            </p>

            <p id="gagal_hapus"></p>
            </div>
            <div align="center">
              <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
              <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
            </div>
      </div>
    </div>


    
  </div><!-- --------------------content -->
 
  </div> <!-- ----------dataroleutama -->

<div data-role="page" id="page_data" data-transision="slide">
  <?php 
         $this->load->view('v_header');
      ?>
         
        <div align="center">
       <h3 id="tajuk"><b>TAMBAH DATA CUSTOMER BARU</b></h3>
        </div>
      <div data-role='content'>

        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                              <input data-mini="true" type="hidden" name="key" id="key" value="">
                              <label  for="kode_gudang_add" >Gudang:</label>
                                  <select name="kode_gudang_add" id="kode_gudang_add">
                                  <option value="">TIDAK ADA</option>
                                    <?php 
                                        $ada_data = 0;
                                        $nomer = 1;
                                        foreach ($ds_hasil ->result() as $hasil):
                                        ?>
                                        while ($hasils = $hasil->fetch_assocc()){
                                        <option value="<?= $hasil->KODE_GUDANG; ?>"><?= $hasil->GUDANG; ?></option>
                                        }
                                        <?php endforeach; ?>

                                  </select>
                              <label id="kode_add_label">Kode Customer:</label>
                              <input autocomplete="off" data-mini="true" type="text" name="kode_add" id="kode_add" value="">
                               <label>Nama Customer:</label>
                               <input autocomplete="off" data-mini="true" type="text" name="nama_add" id="nama_add" value="">
                               <label>Alamat:</label>
                               <input autocomplete="off" data-mini="true" type="text" name="alamat_add" id="alamat_add" value="">
                               <label>Nama Orang Tua/Penjamin:</label>
                               <input autocomplete="off" data-mini="true" type="text" name="penjamin_add" id="penjamin_add" value="">
                               <label  for="group_add" >Group Customer:</label>

                                  <select name="group_add" id="group_add">
                                    <option value="">TIDAK ADA</option>
                                    <?php 
                                        $ada_data = 0;
                                        $nomer = 1;
                                        foreach ($ds_group ->result() as $group):
                                        ?>
                                        while ($groups = $group->fetch_assocc()){
                                        <option value="<?= $group->GROUP_CUSTOMER; ?>"><?= $group->GROUP_CUSTOMER; ?></option>
                                        }
                                        <?php endforeach; ?>

                                  </select>
                               <label>Nomor HP:</label>
                               <input autocomplete="off" data-mini="true" type="text" name="hp_add" id="hp_add" value="">
                               <label>Plafond Kredit:</label>
                               <input autocomplete="off" data-mini="true" type="number" name="kredit_add" id="kredit_add" value="">
                                <label for="kolom_harga_add" >Kolom Harga:</label>
                                  <select name="kolom_harga_add" id="kolom_harga_add">
                                    <?php
                                         if ($ds_harga) {
                                            $harga = $ds_harga->row();
                                         }
                                      ?>
                                      <option value="0">TIDAK ADA</option>
                                      <option value="1"><?= $harga->HARGA_JUAL1_JUDUL; ?></option>
                                      <option value="2"><?= $harga->HARGA_JUAL2_JUDUL; ?></option>
                                      <option value="3"><?= $harga->HARGA_JUAL3_JUDUL; ?></option>
                                      <option value="4"><?= $harga->HARGA_JUAL4_JUDUL; ?></option>
                                      <option value="5"><?= $harga->HARGA_JUAL5_JUDUL; ?></option>
                                  </select>
        </div>

                      <div align="center">
                          <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">CANCEL</a>
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
                  <div align="center" onclick="window.location  = '<?php echo home_url()?>MasterData'">
                     <input type="button" name="konfir_berhasil" value="OK">
                  </div>
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

 function click_detil(nama,alamat,penjamin,group,hp,kredit,kolom_harga,kode,kode_gudang) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    document.getElementById("kode_add").style.display ="inline";
    document.getElementById("kode_add_label").style.display ="inline";
    document.getElementById("kode_add").value = kode;
    $('#kode_gudang_add').val(kode_gudang);
    $("#kode_gudang_add").selectmenu("refresh");
    document.getElementById("nama_add").value =nama ;
    document.getElementById("alamat_add").value =alamat ;
    document.getElementById("penjamin_add").value =penjamin ;
    $('#group_add').val(group);
    $("#group_add").selectmenu("refresh");
    document.getElementById("hp_add").value =hp ;
    document.getElementById("kredit_add").value =kredit ;
    $('#kolom_harga_add').val(kolom_harga);
    $("#kolom_harga_add").selectmenu("refresh");
    document.getElementById("kode_add").disabled=false;
    document.getElementById("nama_add").disabled = true;
    document.getElementById("alamat_add").disabled = true;
    document.getElementById("penjamin_add").disabled = true;
    document.getElementById("group_add").disabled = true;
    document.getElementById("hp_add").disabled = true;
    document.getElementById("kredit_add").disabled = true;
    document.getElementById("kolom_harga_add").disabled = true;
    document.getElementById("kode_gudang_add").disabled = true;
    document.getElementById("btn_edit").style.display = 'none';
    document.getElementById("tajuk").innerHTML = 'DETIL DATA CUSTOMER';
}

 function click_edit(nama,alamat,penjamin,group,hp,kredit,kolom_harga,kode,kode_gudang) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
    document.getElementById("kode_add").style.display ="none";
    document.getElementById("kode_add_label").style.display ="none";
    document.getElementById("kode_add").value = kode;
    $('#kode_gudang_add').val(kode_gudang);
    $("#kode_gudang_add").selectmenu("refresh");
    document.getElementById("nama_add").value =nama ;
    document.getElementById("alamat_add").value =alamat ;
    document.getElementById("penjamin_add").value =penjamin ;
    $('#group_add').val(group);
    $("#group_add").selectmenu("refresh");
    document.getElementById("hp_add").value =hp ;
    document.getElementById("kredit_add").value =kredit ;
    $('#kolom_harga_add').val(kolom_harga);
    $("#kolom_harga_add").selectmenu("refresh");
     document.getElementById("key").value = kode;
    document.getElementById("btn_edit").style.display = 'inline';
     document.getElementById("tajuk").innerHTML = 'EDIT DATA CUSTOMER';
    document.getElementById("btn_edit").style.display = 'inline';

    document.getElementById("kode_add").disabled=false;
    document.getElementById("nama_add").disabled = false;
    document.getElementById("alamat_add").disabled = false;
    document.getElementById("penjamin_add").disabled = false;
    document.getElementById("group_add").disabled = false;
    document.getElementById("hp_add").disabled = false;
    document.getElementById("kredit_add").disabled = false;
    document.getElementById("kolom_harga_add").disabled = false;
    document.getElementById("kode_gudang_add").disabled = false;

      status = 'edit';
      console.log(nama,alamat,penjamin,group,hp,kredit,kolom_harga,kode,kode_gudang)
}

function click_hapus(id, gudang){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data Customer ' + gudang + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value = id;
        document.getElementById("btn_delete").style.display= "inline"
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
                url:'<?php echo home_url()?>MasterData/delete_customer',
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
                      // window.location  = '<?php echo home_url()?>MasterData/customer'; 
                      document.getElementById('isi_hapus_label').innerHTML = 'SUKSES';
                      document.getElementById('isi_hapus').innerHTML = 'Proses Hapus Customer Berhasil';
                      document.getElementById('btn_delete').style.display = "none";
                      document.getElementById('tanya_hapus').style.align = "center";

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
    document.getElementById("kode_add").style.display ="none";
    document.getElementById("kode_add_label").style.display ="none";
    document.getElementById("kode_add").value = null;
    $('#kode_gudang_add').prop('selectedIndex', 0);
    $("#kode_gudang_add").selectmenu("refresh");
    document.getElementById("nama_add").value = null ;
    document.getElementById("alamat_add").value = null ;
    document.getElementById("penjamin_add").value = null ;
    $('#group_add').prop('selectedIndex', 0);
    $("#group_add").selectmenu("refresh");
    document.getElementById("hp_add").value = null;
    document.getElementById("kredit_add").value = null ;
    $('#kolom_harga_add').prop('selectedIndex', 0);
    $("#kolom_harga_add").selectmenu("refresh");
     document.getElementById("key").value = null;
     document.getElementById("tajuk").innerHTML = 'TAMBAH DATA CUSTOMER BARU';
    document.getElementById("btn_edit").style.display = 'inline';
    document.getElementById("kode_add").disabled=false;
    document.getElementById("nama_add").disabled = false;
    document.getElementById("alamat_add").disabled = false;
    document.getElementById("penjamin_add").disabled = false;
    document.getElementById("group_add").disabled = false;
    document.getElementById("hp_add").disabled = false;
    document.getElementById("kredit_add").disabled = false;
    document.getElementById("kolom_harga_add").disabled = false;
    document.getElementById("kode_gudang_add").disabled = false;
      status  = 'tambah';
      // location.reload()
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_customer'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_customer'
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
                      window.location  = '<?php echo home_url()?>MasterData/customer';
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