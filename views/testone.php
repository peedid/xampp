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
	 <div data-role="page" data-theme="a" style="margin-bottom: 50px;">
      <?php 
         $this->load->view('v_header');
      ?>
   <div data-role="content">
   	<div>
   		 <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_pasien","name"=>"form_pasien","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
   		<label for="nama_pasien">Nama Pasien:</label>
   		<input type="text" name="nama_pasien" id="nama_pasien" value="">
   		<label>Ruangan</label>
   		<select name="ruangan" id="ruangan">
   			<option isi="Ruangan" value="Poli"> Ruangan Poli</option>
   			<option isi="Ruangan" value="praktek"> Ruangan praktek</option>
   			<option isi="Ruangan" value="bedah"> Ruangan bedah</option>
   			<option isi="Ruangan" value="gigi"> Ruangan gigi</option>
   		</select>
   		<label for="dokter">Dokter :</label>
   		<input type="text" name="dokter" id="dokter" value="">
   		<label for="tanggal" style="margin-bottom: -15px">Tanggal </label>
        <input type="date" name="tanggal" data-clear-btn="false" id="tanggal" value="" style="">
		<label for="shift">Shift</label>
   		<select name="shift" id="shift">
   			<option isi="shift" value="Pagi"> Pagi</option>
   			<option isi="shift" value="Siang"> Siang</option>
   			<option isi="shift" value="Sore"> Sore</option>
   			<option isi="shift" value="Malam"> Malam</option>
   		</select>

   		<!-- <button onclick="tambahdata()">save</button> -->
   		<input type="button" data-inline="true" value="save" onclick="tambahdata()">
   		<input type="button" data-inline="true" value="cancel" onclick="bataldata()">
   		<?php echo form_close(); ?>
   	</div>
   	
   </div>





    </div>
<script type="text/javascript">

	function bataldata(){
		window.location = "<?php echo home_url()?>Ciptogudangrabat_pesanan/kesehatan"
	}

   
   $('#form_pasien').submit(function(event){

   		if ($('#nama_pasien').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>Ciptogudangrabat_pesanan/save_testone',
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
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
    });





	function tambahdata(){
		/*var nama_pasien=$("[name='nama_pasien']").val();
		var ruangan=$("[name='ruangan']").val();
		var tanggal=$("[name='tanggal']").val();
		var shift=$("[name='shift']").val();*/
        
        $('#form_pasien').submit();

		/*$.ajax({
			type:'POST',
			data: 'nama_pasien='+nama_pasien+'&ruangan='+ruangan+'&tanggal='+tanggal+'&shift='+shift,
			url:'<?php echo home_url().'Ciptogudangrabat_pesanan/tambahdata' ?>',
			datatype : 'json',
			success : function(output){
				console.log(output);

			}
		}); */

	}


</script>
</body>
</html>