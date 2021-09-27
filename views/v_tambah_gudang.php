<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
  <title></title>
  <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 

</head>
<body>
   <?php 
         $this->load->view('v_header');
      ?>
         
        <div align="center">
       <h3><b>TAMBAH DATA CABANG BARU</b></h3>
        </div>
        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                              <label  for="default" >Set Sebagai Default:</label>
                                  <select name="default" id="default">
                                    <option isi="default" value="0">Tidak</option>
                                    <option isi="default" value="1">Ya</option>
                                  </select>
                                <label  >Nama Cabang:</label>
                                <input  type="text" name="gudang" id="gudang" data-mini="true" value="">
                                <label >Kode Cabang:</label>
                                <input data-mini="true" type="text" name="kode" id="kode" value=""> 
                                 <label  >Alamat Cabang:</label>
                                <input data-mini="true" type="text" name="alamat" id="alamat" value="">
                                <label width="50px;" >
                                <label  >No.Telp Cabang:</label>
                                <input  data-mini="true"type="text" name="telp" id="telp" value="">
                                <label  for="do" >Surat DO:</label>
                                  <select name="do" id="do"  >
                                    <option isi="do" value="0">Tidak</option>
                                    <option isi="do" value="1">Sertakan</option>
                                  </select>
                                  <label  for="view" >View Barang Detail:</label>
                                  <select name="view" id="view">
                                    <option isi="view" value="0">Tidak</option>
                                    <option isi="view" value="1">Ya</option>
                                  </select>
                                  <label  for="mutasi"  >Hanya Barang Mutasi:</label>
                                  <select name="mutasi" id="mutasi">
                                    <option isi="mutasi" value="0">Tidak</option>
                                    <option isi="mutasi" value="1">Ya</option>
                                  </select>
                                  </select>
                                  <label  for="hanya_gudang" >Hanya Barang Gudang:</label>
                                  <select name="hanya_gudang" id="hanya_gudang">
                                    <option isi="hanya_gudang" value="0">Tidak</option>
                                    <option isi="hanya_gudang" value="1">Ya</option>
                                  </select>
                                  <label  for="semua_barang" >Semua Barang:</label>
                                  <select name="semua_barang" id="semua_barang">
                                    <option isi="semua_barang" value="0">Tidak</option>
                                    <option isi="semua_barang" value="1">Ya</option>
                                  </select>
                                <label  >Header Nota Caption:</label>
                                <input data-mini="true" type="text" name="header" id="header" value="">
                                <label  >Footer Nota Caption:</label>
                                <input  data-mini="true" type="text" name="footer" id="footer" value="">
                                <label  >Fingerprint Type:</label>
                                <input data-mini="true" type="text" name="type" id="type" value="">
                                <label  >Fingerprint Address:</label>
                                <input data-mini="true" type="text" name="address" id="address" value="">
                                <label  for="sesuai_gudang" >Sesuai Gudang Jual:</label>
                                  <select name="sesuai_gudang" id="sesuai_gudang">
                                    <option isi="sesuai_gudang" value="0">Tidak</option>
                                    <option isi="sesuai_gudang" value="1">Ya</option>
                                  </select>
                                  <label  for="inner_stok" >Inner Stok Barang Gudang:</label>
                                  <select name="inner_stok" id="inner_stok">
                                    <option isi="inner_stok" value="0">Tidak</option>
                                    <option isi="inner_stok" value="1">Ya</option>
                                  </select>
                                  <label  for="toleransi" >Toleransi Absen Masuk:</label>
                                  <select name="toleransi" id="toleransi" >
                                    <option isi="toleransi" value="0">Tidak</option>
                                    <option isi="toleransi" value="1">Ya</option>
                                  </select>
                                <?php echo form_close(); ?>
        </div>

                      <div align="center">
                        <input height="30px;" type="button" data-inline="true" value="SIMPAN CUSTOMER" onclick="tambahdata()" >
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" onclick="back()">CANCEL</a>

                      </div>


    <script type="text/javascript">

      $('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>MasterData/save_gudang',
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
                    window.location = "<?php echo home_url() ?>MasterData/gudang";
                    // location.reload()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                    window.location = "<?php echo home_url() ?>MasterData/add_gudang";
                   
                }
             });
        event.preventDefault();
    });


      function tambahdata(){
      $('#form_gudang').submit();
    }

    function back(){
      window.location = "<?php echo home_url() ?>MasterData/gudang";
    }
    </script>
</body>
</html>