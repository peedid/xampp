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
       <h3>TAMBAH DATA CUSTOMER BARU</h3>
        </div>
        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_member","name"=>"form_member","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                                <label for="nama_pasien" >Nama Customer:</label>
                                <input placeholder="CONTOH: BAMBANG SUBAMBANG" type="text" name="customer" id="customer" value="">
                                <label for="nama_pasien">Kode Member:</label>
                                <input placeholder="CONTOH: 17000000" type="text" name="kode" id="kode" value=""> 
                                 <label for="nama_pasien" >Alamat:</label>
                                <input placeholder="CONTOH: JALAN MERDEKA NO.4 CIREBON" type="text" name="alamat" id="alamat" value="">
                                <?php echo form_close(); ?>
        </div>

                      <div>
                        <input height="30px;" type="button" data-inline="true" value="SIMPAN CUSTOMER" onclick="tambahdata()" >
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" onclick="back()">CANCEL</a>

                      </div>


    <script type="text/javascript">

      $('#form_member').submit(function(event){

      if ($('#customer').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>Ciptogudangrabat_pesanan/save_member',
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
                    window.location = "<?php echo home_url() ?>Ciptogudangrabat_pesanan/input_member";
                    // location.reload()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
    });


      function tambahdata(){
      $('#form_member').submit();
    }

    function back(){
      window.location = "<?php echo home_url() ?>Ciptogudangrabat_pesanan/input_member";
    }
    </script>
</body>
</html>