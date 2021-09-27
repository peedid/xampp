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
    .master_cabang {
    width: 48px;
    height: 48px;
    background-image: url("<?php echo asset_url();?>gambar/masterdata.png");
    background-size: 48px 48px;
    border-radius: 50%;
    background-repeat: no-repeat;
    position: relative;
    }
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
    <div data-role='content'>
      <div>
        <h3 align="center" ><b>USER ACCESS</b></h3>
      </div>
      <?php
      $trading = $this->model->load_trading();
      $this->db = $trading;
      $ds_hasil = $this->db->query("
        SELECT A.* From MST_OPERATOR A
        ORDER BY A.KODE_OPERATOR_LEVEL ASC;
        ");
      ?>
      <div>
        <?php
        if (empty($this->input->get('cari')))
          echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari User ...">';
        ?>
        <ul  class="list" data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer"  >
          <?php 
          $ada_data = 0;
          $nomer = 1;
          foreach ($ds_hasil ->result() as $row):
          ?>
          <li lass="li_list" >
            <table width="100%">
              <tr >
                <td width="50%">
                  <h3 style="font-size:12px !important;color: white;"><?= $row->NAMA; ?>a</h3>
                  <input type="checkbox" name="aktif" id="aktif" value="1">
                </td>
              </tr>
              <tr>
                <td align=" left">
                        <input type="button" name="klik_edit" id="klik_edit" value="Ubah Akses" data-inline="true" data-theme="b" data-mini="true" onclick="click_edit()" >
                </td>
                <td>
                        <input type="button" name="hapus_klik" id="hapus_klik" value="Copy Akses" data-inline="true" data-theme="b" data-mini="true" onclick="click_hapus('<?= $row->KODE_GUDANG; ?>','<?= $row->GUDANG; ?>')" >
                </td>
              </tr>
            </table>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
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
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
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
        <h3 id="tajuk"><b>TAMBAH DATA CABANG BARU</b></h3>
      </div>
      <div>
        <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
        <input data-mini="true" type="hidden" name="key" id="key" value="">
        <label  for="default_add" >Set Sebagai Default:</label>
        <select name="default_add" id="default_add">
          <option value="0">Tidak</option>
          <option value="1">Ya</option>
        </select>
        <label  >Nama Cabang:</label>
        <input  type="text" name="gudang_add" id="gudang_add" data-mini="true" value="">
        <label id="kode_add_label" >Kode Cabang:</label>
        <input data-mini="true" type="text" name="kode_add" id="kode_add" value=""> 
        <label  >Alamat Cabang:</label>
        <input data-mini="true" type="text" name="alamat_add" id="alamat_add" value="">
        <label width="50px;" >
          <label  >No.Telp Cabang:</label>
          <input  data-mini="true"type="text" name="telp_add" id="telp_add" value="">
          <label  for="do_add" >Surat DO:</label>
          <select name="do_add" id="do_add"  >
            <option  value="0">Tidak</option>
            <option  value="1">Sertakan</option>
          </select>
          <label  for="view_add" >View Barang Detail:</label>
          <select name="view_add" id="view_add">
            <option value="0">Tidak</option>
            <option value="1">Ya</option>
          </select>
          <label  for="mutasi_add"  >Hanya Barang Mutasi:</label>
          <select name="mutasi_add" id="mutasi_add">
            <option value="0">Tidak</option>
            <option value="1">Ya</option>
          </select>
          <label  for="hanya_gudang_add" >Hanya Barang Gudang:</label>
          <select name="hanya_gudang_add" id="hanya_gudang_add">
          <option value="0">Tidak</option>
          <option value="1">Ya</option>
        </select>
        <label  for="semua_barang_add" >Semua Barang:</label>
        <select name="semua_barang_add" id="semua_barang_add">
          <option value="0">Tidak</option>
          <option value="1">Ya</option>
        </select>
        <label  >Header Nota Caption:</label>
        <input data-mini="true" type="text" name="header_add" id="header_add" value="">
        <label  >Footer Nota Caption:</label>
        <input  data-mini="true" type="text" name="footer_add" id="footer_add" value="">
        <label  >Fingerprint Type:</label>
        <input data-mini="true" type="text" name="type_add" id="type_add" value="">
        <label  >Fingerprint Address:</label>
        <input data-mini="true" type="text" name="address_add" id="address_add" value="">
        <label  for="sesuai_gudang_add" >Sesuai Gudang Jual:</label>
        <select name="sesuai_gudang_add" id="sesuai_gudang_add">
          <option value="0">Tidak</option>
          <option value="1">Ya</option>
        </select>
        <label  for="inner_stok_add" >Inner Stok Barang Gudang:</label>
        <select name="inner_stok_add" id="inner_stok_add">
          <option value="0">Tidak</option>
          <option value="1">Ya</option>
        </select>
        <label  for="toleransi_add" >Toleransi Absen Masuk:</label>
        <select name="toleransi_add" id="toleransi_add" >
          <option value="0">Tidak</option>
          <option value="1">Ya</option>
        </select>
        <?php echo form_close(); ?>
      </div>
      </div>

      <div align="center">
        <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">CANCEL</a>
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

 function click_detil(standar,gudang,id,alamat,telp,surat_do,rincian,mutasi,hanya_gudang,semua,header,footer,address,type,sesuai_gudang,inner,toleransi) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      $('#tanya_add').attr('add_id',$(this).attr('id') );
      $('#default_add').val(standar);
      $("#default_add").selectmenu("refresh");
      document.getElementById("gudang_add").value = gudang;
      document.getElementById("kode_add").value = id;
      document.getElementById("alamat_add").value = alamat;
      document.getElementById("telp_add").value = telp;
      $('#do_add').val(surat_do);
      $("#do_add").selectmenu("refresh");
      $('#view_add').val(rincian);
      $("#view_add").selectmenu("refresh");
      $('#mutasi_add').val(mutasi);
      $("#mutasi_add").selectmenu("refresh");
      $('#hanya_gudang_add').val(hanya_gudang);
      $("#hanya_gudang_add").selectmenu("refresh");
      $('#semua_barang_add').val(semua);
      $("#semua_barang_add").selectmenu("refresh");
      document.getElementById("header_add").value = header;
      document.getElementById("footer_add").value =footer;
      document.getElementById("type_add").value = type;
      document.getElementById("address_add").value = address;
      $('#sesuai_gudang_add').val(sesuai_gudang);
      $("#sesuai_gudang_add").selectmenu("refresh");
      $('#inner_stok_add').val(inner);
      $("#inner_stok_add").selectmenu("refresh");
      $('#toleransi_add').val(toleransi);
      $("#toleransi_add").selectmenu("refresh");
      // document.getElementById("kode_add_label").style.display = 'none';
      
      document.getElementById("tajuk").innerHTML = 'DETAIL DATA CABANG';
      document.getElementById("btn_edit").style.display = 'none';
      document.getElementById("kode_add").disabled=true;
      document.getElementById("default_add").disabled = true;
      document.getElementById("gudang_add").disabled = true;
      document.getElementById("kode_add").disabled = true;
      document.getElementById("alamat_add").disabled = true;
      document.getElementById("telp_add").disabled = true;
      document.getElementById("do_add").disabled = true;
      document.getElementById("view_add").disabled = true;
      document.getElementById("mutasi_add").disabled = true;
      document.getElementById("hanya_gudang_add").disabled = true;
      document.getElementById("semua_barang_add").disabled = true;
      document.getElementById("header_add").disabled = true;
      document.getElementById("footer_add").disabled = true;
      document.getElementById("type_add").disabled = true;
      document.getElementById("address_add").disabled = true;
      document.getElementById("sesuai_gudang_add").disabled = true;
      document.getElementById("inner_stok_add").disabled = true;
      document.getElementById("toleransi_add").disabled = true;
}

 function click_edit(standar,gudang,id,alamat,telp,surat_do,rincian,mutasi,hanya_gudang,semua,header,footer,address,type,sesuai_gudang,inner,toleransi) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      $('#tanya_add').attr('add_id',$(this).attr('id') );
      $('#default_add').val(standar);
      $("#default_add").selectmenu("refresh");
      document.getElementById("gudang_add").value = gudang;
      document.getElementById("kode_add").value = id;
      document.getElementById("alamat_add").value = alamat;
      document.getElementById("telp_add").value = telp;
      $('#do_add').val(surat_do);
      $("#do_add").selectmenu("refresh");
      $('#view_add').val(rincian);
      $("#view_add").selectmenu("refresh");
      $('#mutasi_add').val(mutasi);
      $("#mutasi_add").selectmenu("refresh");
      $('#hanya_gudang_add').val(hanya_gudang);
      $("#hanya_gudang_add").selectmenu("refresh");
      $('#semua_barang_add').val(semua);
      $("#semua_barang_add").selectmenu("refresh");
      document.getElementById("header_add").value = header;
      document.getElementById("footer_add").value =footer;
      document.getElementById("type_add").value = type;
      document.getElementById("address_add").value = address;
      $('#sesuai_gudang_add').val(sesuai_gudang);
      $("#sesuai_gudang_add").selectmenu("refresh");
      $('#inner_stok_add').val(inner);
      $("#inner_stok_add").selectmenu("refresh");
      $('#toleransi_add').val(toleransi);
      $("#toleransi_add").selectmenu("refresh");
      document.getElementById("key").value=id;
      document.getElementById("tajuk").innerHTML = 'UBAH DATA CABANG';
      document.getElementById("btn_edit").style.display = 'inline';

      document.getElementById("kode_add").disabled =false;
      document.getElementById("default_add").disabled =false;
      document.getElementById("gudang_add").disabled =false;
      document.getElementById("kode_add").disabled =false;
      document.getElementById("alamat_add").disabled =false;
      document.getElementById("telp_add").disabled =false;
      document.getElementById("do_add").disabled =false;
      document.getElementById("view_add").disabled =false;
      document.getElementById("mutasi_add").disabled =false;
      document.getElementById("hanya_gudang_add").disabled =false;
      document.getElementById("semua_barang_add").disabled =false;
      document.getElementById("header_add").disabled =false;
      document.getElementById("footer_add").disabled =false;
      document.getElementById("type_add").disabled =false;
      document.getElementById("address_add").disabled =false;
      document.getElementById("sesuai_gudang_add").disabled =false;
      document.getElementById("inner_stok_add").disabled =false;
      document.getElementById("toleransi_add").disabled =false;
      status = 'edit';
      
}

function click_hapus(id, gudang){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data Cabang ' + gudang + ' akan di hapus ?';
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
                url:'<?php echo home_url()?>MasterData/delete_cabang',
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
                      window.location  = '<?php echo home_url()?>MasterData/gudang'; 
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
  $('#tanya_add').attr('add_id',$(this).attr('id') );
      $('#tanya_add').attr('add_id',$(this).attr('id') );
      $('#default_add').prop('selectedIndex', 0);
      $("#default_add").selectmenu("refresh");
      document.getElementById("gudang_add").value =null;
      document.getElementById("kode_add").value =null;
      document.getElementById("alamat_add").value =null;
      document.getElementById("telp_add").value =null;
      $('#do_add').prop('selectedIndex', 0);
      $("#do_add").selectmenu("refresh");
      $('#view_add').prop('selectedIndex', 0);
      $("#view_add").selectmenu("refresh");
      $('#mutasi_add').prop('selectedIndex', 0);
      $("#mutasi_add").selectmenu("refresh");
      $('#hanya_gudang_add').prop('selectedIndex', 0);
      $("#hanya_gudang_add").selectmenu("refresh");
      $('#semua_barang_add').prop('selectedIndex', 0);
      $("#semua_barang_add").selectmenu("refresh");
      document.getElementById("header_add").value =null;
      document.getElementById("footer_add").value =null;
      document.getElementById("type_add").value =null;
      document.getElementById("address_add").value =null;
      $('#sesuai_gudang_add').prop('selectedIndex', 0);
      $("#sesuai_gudang_add").selectmenu("refresh");
      $('#inner_stok_add').prop('selectedIndex', 0);
      $("#inner_stok_add").selectmenu("refresh");
      $('#toleransi_add').prop('selectedIndex', 0);
      $("#toleransi_add").selectmenu("refresh");

      document.getElementById("tajuk").innerHTML = 'TAMBAH DATA CABANG';
      document.getElementById("btn_edit").style.display = 'inline';
      document.getElementById("kode_add").disabled =false;
      document.getElementById("default_add").disabled =false;
      document.getElementById("gudang_add").disabled =false;
      document.getElementById("kode_add").disabled =false;
      document.getElementById("alamat_add").disabled =false;
      document.getElementById("telp_add").disabled =false;
      document.getElementById("do_add").disabled =false;
      document.getElementById("view_add").disabled =false;
      document.getElementById("mutasi_add").disabled =false;
      document.getElementById("hanya_gudang_add").disabled =false;
      document.getElementById("semua_barang_add").disabled =false;
      document.getElementById("header_add").disabled =false;
      document.getElementById("footer_add").disabled =false;
      document.getElementById("type_add").disabled =false;
      document.getElementById("address_add").disabled =false;
      document.getElementById("sesuai_gudang_add").disabled =false;
      document.getElementById("inner_stok_add").disabled =false;
      document.getElementById("toleransi_add").disabled =false;

      status  = 'tambah';
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_gudang'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_gudang'
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
                      window.location  = '<?php echo home_url()?>MasterData/gudang';
                      
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