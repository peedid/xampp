<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
	<link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
  	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
  <link rel="stylesheet" href="<?php echo asset_url();?>css/general.css" />
  <style>
   .upload-btn-wrapper input[type=file] {
      font-size: 10px !important;
      position: absolute !important;
      left: 0 !important;
      top: 0 !important;
      opacity: 0 !important;
      cursor: pointer;
      height:0px !important;
  }
  .class_gambar{

  }
  </style>
</head>
<body>
    <div data-role="page" id="page_bebas" data-theme="a" data-transition="slide">
        
        <?php $this->load->view('v_header'); ?>

       <div id='div_isi_bebas' data-role="content">
           <p align="center" style='font-size:15px;font-weight:bold'>Catatan Pesanan Belanja Anda</p>
           <p align="center" style='font-size:12px;'>Silahkan ketik dengan lengkap item pesanan Anda</p>
           <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_bebas","name"=>"form_bebas","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
              <div>
                  <textarea id="txt_pesanan" name="txt_pesanan" placeholder="Silahkan ketik disini" style="text-align: center;font-size:30px"></textarea>
              </div>
           <?php echo form_close(); ?>
       </div>

    <div id = "footer_bebas" data-role="footer" style="position:fixed;bottom:0 !important;width:100%;height:70px;margin-left:-15px">
         <div align="center" style="margin-top:4px">
             <table style="">
                <tr>
                   <td id='kol_simpan_bebas' align='center' style="">
                      <div style="width:80px;height:60px">
                          <img id="simpan_bebas" src="<?php echo asset_url();?>gambar/save_circle_orange.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:white;">Simpan</span>
                      </div>
                   </td>
              </tr>
              </table>
         </div>
    </div>

         <!-- akhir  -->
          <div data-role="popup" id="info_bebas"  data-theme="a" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div id="info_header_bebas" align="center" style="width:100%;padding-top:10px">
                      
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content_bebas"></p>
                    <a onclick="" id ='btn_cancel_bebas' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                    <a onclick="" id ='btn_action_bebas' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
                </div>
           </div>
          
    </div>


    <div data-role="page" id="page_main" data-theme="a" data-transition="slide">
        
        <?php $this->load->view('v_header'); ?>

       <div id='div_isi' data-role="content">
           <p align="center" style='font-size:15px;font-weight:bold'> Silahkan Foto <br> Catatan Pesanan Belanja Anda</p>
           <p align="center" style='font-size:12px;'>Klik icon Ambil Gambar dibawah</p>
           <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_pesanan","name"=>"form_pesanan","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
              <div class="upload-btn-wrapper" id="daftar_gambar"> 
              </div>
           <?php echo form_close(); ?>
       </div>

    <div id = "footer_row" data-role="footer" style="position:fixed;bottom:0 !important;width:100%;height:70px;margin-left:-15px">
         <div align="center" style="margin-top:4px">
             <table style="">
                <tr>
                   <td align='center'>
                      <div style="width:80px;height:60px">
                          <img id="ambil_gambar" src="<?php echo asset_url();?>gambar/kamera.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:white;">Ambil Gambar</span>
                      </div>
                   </td>
                   <td id='kol_simpan' align='center' style="">
                      <div style="width:80px;height:60px">
                          <img id="simpan" src="<?php echo asset_url();?>gambar/save_circle_orange.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:white;">Simpan</span>
                      </div>
                   </td>
              </tr>
              </table>
         </div>
    </div>
          <!-- akhir  -->
          <div data-role="popup" id="info"  data-theme="a" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div id="info_header" align="center" style="width:100%;padding-top:10px">
                      Hapus Foto
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content"></p>
                    <a onclick="" id ='btn_cancel' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                    <a onclick="" id ='btn_action' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
                </div>
           </div>
    </div>

    


<script>
gambar_ke = 0;
$('#kol_simpan').hide();

$('#simpan').click(function(){
   $('#form_pesanan').submit();
});


function cek_ada_gambar(){
  ada_gambar = 0;
  $("input").each(function(index, element){
      nama = this.id;
      if ( nama.indexOf('gambar_') != -1) {
        if ( $("#"+nama).val() != '') {
          ada_gambar = 1;
        } 
      }
    });

  if (ada_gambar ==0)
     $('#kol_simpan').hide();
  else
       $('#kol_simpan').show();
}
// Callback function references the event target and adds the 'swipeleft' class to it
function swipeleftHandler( event ){

  $('#btn_action').attr('proses','hapus');
  $('#btn_action').attr('angka',$(this).attr('angka'));
  document.getElementById('info_content').innerHTML = 'Yakin ingin dihapus ?';
  $('#btn_cancel').show();
   $('#btn_action').attr('href','#');
  $('#btn_action').attr('data-rel','back');
  $('#btn_action').removeAttr('rel','');
  $( "#info" ).popup( "open");
}

$('#btn_action').click(function(){
   if ( $('#btn_action').attr('proses')=='hapus') {
      $('#picture_'+ $('#btn_action').attr('angka')).remove();
      $('#gambar_'+ $('#btn_action').attr('angka')).remove();
      //$( "#info" ).popup( "close");
      cek_ada_gambar();
   }
});

$( "#ambil_gambar" ).click(function() {
   // cek hapus 
   $("input").each(function(index, element){
      nama = this.id;
      if ( nama.indexOf('gambar_') != -1) {
        if ( $("#"+nama).val() == '') {
          $("#"+nama).remove();
          gambar_ke = gambar_ke - 1;
        } 
      }
    });
  
   gambar_ke = gambar_ke + 1;
   $("#daftar_gambar").append('<input  onchange = "readURL(this)" id="gambar_'+ gambar_ke +'" name="gambar_'+ gambar_ke +'" type="file" />').trigger('create');
   $("#daftar_gambar").append('<img angka= "'+ gambar_ke +'" class="class_gambar" style="max-width:100%;height:auto;" id="picture_'+ gambar_ke +'" name="picture_'+ gambar_ke +'" src=""/>').trigger('create');

       $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( ".class_gambar" ).on( "swipeleft", swipeleftHandler );
        });

   $("#gambar_"+gambar_ke).trigger('click');
   
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            id = input.id;
            var angka = id.substring(7, id.length);
            $('#picture_' + angka ).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        
        cek_ada_gambar();
    } 
}

   showModal();
    
    $(document).ready(function() {
       // Handler for .ready() called.
       hideModal();
    });

    function showModal(){
      $("body").append("<div id='loader' class='ui-loader-background'> </div>");
      GetLoading();
    }

    function hideModal(){
      $(".modalWindow").remove();
      $.mobile.loading('hide');
    }

    function GetLoading() {
       $.mobile.loading('show');
    }    


    $('#form_pesanan').submit(function(event){
        var keluarsekarang = false;

        $('#btn_action').attr('proses','');

        $('input[type=file]').each(function(){
            var fileinput = document.getElementById($(this).attr('id'));
            if (fileinput.files[0]) 
               if (fileinput.files[0].size >  15000000) {
                   keluarsekarang = true;
                    $('#btn_action').attr('rel','');
                    $('#btn_action').attr('href','#');
                       $('#btn_action').attr('onclick','');
                       $('#btn_action').attr('data-rel','back');
                    document.getElementById('info_header').innerHTML = 'Oops..';
                    document.getElementById('info_content').innerHTML = 'Ukuran file tidak boleh melebihi 15 MB !!';
                    $('#btn_cancel').hide();
                    $( "#info" ).popup( "open");
               }
        })

        if (keluarsekarang) {
            event.preventDefault();
            return;
        }
        
        $('#footer_row').hide();

        showModal();

        $.ajax({
                url:'<?php echo home_url()?>Ciptogudangrabat_pesanan/save',
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    $('#footer_row').show();
                    //console.log(res);
                    hasil = jQuery.parseJSON(res);
                    $('#btn_cancel').hide();
                    if (hasil.result == 'ok') {
                        if (hasil.data) {
                          cetak_pesanan_online(JSON.stringify(hasil.data));
                        }

                        $('#btn_action').attr('href','<?php echo home_url()?>Main');
                        $('#btn_action').attr('data-rel','');
                        $('#btn_action').attr('rel','external');
                    } else {
                       $('#btn_action').attr('href','#');
                        $('#btn_action').attr('data-rel','back');
                        $('#btn_action').attr('rel','');
                    }
                      $('input[name ="<?php echo $this->security->get_csrf_token_name();?>"]').attr('value',hasil.token);
                      document.getElementById('info_header').innerHTML = hasil.info_header;
                      document.getElementById('info_content').innerHTML = hasil.info_content;
                      $( "#info" ).popup( "open");

                },
                error: function (jqXHR, textStatus, errorThrown) {
                     hideModal();
                     $('#footer_row').show();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
    });

function cetak_pesanan_online(vdata) {
    send_websocket(vdata);
}

function swipe_page_left( event ){
    if ($.mobile.activePage.attr( "id" ) == 'page_bebas')
       $.mobile.changePage( "#page_main", { transition: "slide", changeHash: false });
    else
      $.mobile.changePage( "#page_bebas", { transition: "slide", changeHash: false});
}

function swipe_page_right( event ){
    if ($.mobile.activePage.attr( "id" ) == 'page_bebas')
       $.mobile.changePage( "#page_main", { transition: "slide", changeHash: false, reverse : true});
    else
      $.mobile.changePage( "#page_bebas", { transition: "slide", changeHash: false, reverse : true  });
}


    $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( "#page_main" ).on( "swipeleft", swipe_page_left );
          $( "#page_bebas" ).on( "swipeleft", swipe_page_left );

          $( "#page_main" ).on( "swiperight", swipe_page_right );
          $( "#page_bebas" ).on( "swiperight", swipe_page_right );

          
        });

$(document).ready(function(){
  var _originalSize = $(window).width() + $(window).height()
  $(window).resize(function(){
    if($(window).width() + $(window).height() != _originalSize){
      console.log("keyboard show up");
      $("#footer_bebas").css("position","relative");  
    }else{
      console.log("keyboard closed");
      $("#footer_bebas").css("position","fixed");  
    }
  });
});




 $('#form_bebas').submit(function(event){
         
        if ($('#txt_pesanan').val()=="") {
          event.preventDefault();
          return;
        }
        $('#footer_bebas').hide();

        showModal();

        $.ajax({
                url:'<?php echo home_url()?>Ciptogudangrabat_pesanan/save_bebas',
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    $('#footer_bebas').show();
                    console.log(res);
                    hasil = jQuery.parseJSON(res);
                    $('#btn_cancel_bebas').hide();
                    if (hasil.result == 'ok') {
                        if (hasil.data) {
                          cetak_pesanan_online((hasil.data));
                        }

                        $('#btn_action_bebas').attr('href','<?php echo home_url()?>Main');
                        $('#btn_action_bebas').attr('data-rel','');
                        $('#btn_action_bebas').attr('rel','external');
                    } else {
                       $('#btn_action_bebas').attr('href','#');
                        $('#btn_action_bebas').attr('data-rel','back');
                        $('#btn_action_bebas').attr('rel','');
                    }
                      $('input[name ="<?php echo $this->security->get_csrf_token_name();?>"]').attr('value',hasil.token);
                      document.getElementById('info_header_bebas').innerHTML = hasil.info_header;
                      document.getElementById('info_content_bebas').innerHTML = hasil.info_content;
                      $( "#info_bebas" ).popup( "open");

                },
                error: function (jqXHR, textStatus, errorThrown) {
                     hideModal();
                     $('#footer_bebas').show();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
    });


 $('#simpan_bebas').click(function(){
   $('#form_bebas').submit();
});

</script>
</body>
</html>