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
      .center { 
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                margin: 0 auto;
                right: 0;
                left: 0;
                height:50%;
                width:100%;
              }
  </style>

  <script type="text/javascript">
      function getIMEI() {
          if (typeof Android === 'object') {
          return Android.getIMEI();

          } else 
             return 'kosong';
      }   

      var imei = 'kosong';

      $( document ).ready(function() {                		    	
          	imei = getIMEI();
            if (imei !="kosong") {
              var newdiv = document.createElement('div');
              newdiv.innerHTML = "<input type='hidden' name='imei' id='imei' value='"+ imei+"'>";
              document.getElementById('form_login').appendChild(newdiv);
            }
      });
  </script>
</head>
<body>
    
    <div data-role="page" id="page_scan" data-theme="a" data-transition="slide">
       <div  data-role="content" align="center" >
          <div class="center" >
            <img id="gambar_hp" src="<?php echo asset_url()?>gambar/qrcode_action.png" alt="" style="width:90%;height:95%">
            <div align="center">
                  <input style ='width:200px !important;font-size:14px !important' id = "scan" name = 'scan' data-inline="true" type="button" value="Scan">
            </div>
          </div>
      </div>
   </div>

    <div data-role="page" id="page_login" data-theme="b" data-transition="slide">
    		<div data-role="content" align="center">
              <div style='margin-top:50px !important'>
                  <p style="font-weight:bold;font-size:20px">LOGIN TO YOUR ACCOUNT</p>
              </div>

                <div style="width:100%;margin:auto;">
                    <?php echo form_open (home_url()."login/auth/",array("method"=>"post","id"=>"form_login","name"=>"form_login","data-ajax"=>"false")); ?>    
                        
                        <div align="center" style="margin-top:50px;width: 200px;">
                            
                            <div style="float:right;">
                              <a href="#" data-transition="flip">
                                <img src="<?php echo asset_url();?>gambar/whatsnew.png" style="width:70px;height:70px">
                              </a>
                            </div>

                            <div align="center" style="margin-left: 10px">
                               <img style="height:128px" src="<?php echo asset_url();?>gambar/Login.png" >
                            </div> 
                        </div>

                        <br>

                        <label style="text-align:left" for="username">Username</label>
                        <input type="text" name="username" id="username" value="" data-mini="true" required />
                        <label style="text-align:left" for="password">Password</label>
                        <input type="password" name="password" id="password" value="" data-mini="true" required />
      
                        <div align="center">
                            <input data-theme='a' id = "login" name = 'login' data-inline="true" type="submit" value="  Login   ">
            				    </div>
                   <?php echo form_close(); ?> 
                </div>
                
                <div>

                    <p style="font-size:12px;text-align:center;padding:10px; 10px 10px 10px;font-weight:bold;">
                       Libatkan TUHAN dalam setiap aktivitasmu<br>
                    </p>
                </div>

                <div align="center" style="font-size:10px;color:orange">&reg; CV. GRIYA SARANA INFORMATIKA 2020</div>
        </div>
    </div>

  

<script type="text/javascript">
var barcode_item = null;

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#fileid").change(function(){
       readURL(this);
   });

function set_barcode_item(vbarcode_item){
      barcode_item = vbarcode_item;
}

$( "#scan" ).click(function() {
  try {
    if (typeof Android === 'object') {
        Android.jav_scantoken();
    } 
    else 
         alert('Device Not Supported !');
  } catch(err) {

  }
});

$( "#get_picture" ).click(function() {
  
      if (typeof Android === 'object') {
            Android.getGPS();
        } else 
           alert('Device Not Supported !');
 
});

$( "#get_tele" ).click(function() {
    
    try {
    if (typeof Android === 'object') 
          Android.show_tele_konference();
    else 
         window.location = '<?php echo home_url() ?>Tele';
  } catch(err) {
      
  }
 
});

$( "#get_useraktif" ).click(function() {
    try {
    if (typeof Android === 'object') 
          Android.jav_useraktif();
    else 
         console.log("Not Supported");
  } catch(err) {
      
  }
 
});

function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}

$( "#update_client" ).click(function() {
    
    try {
    if (typeof Android === 'object') 
          Android.jav_update_client_name(getRandomInt(5000).toString(),"ENTERPRENEUR");
    else 
         console.log("Not Supported");
  } catch(err) {
      
  }
 
});


 $( "#login" ).click(function() {
     GetLoading();
     $('#form_login').submit();
  });

  showModal();
    
  $(document).ready(function() {
     // Handler for .ready() called.
     hideModal();
     //console.log('keluar');
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




$(document).ready(function() {
       function swipe_page_left( event ){
    if ($.mobile.activePage.attr( "id" ) == 'page_scan')
       $.mobile.changePage( "#page_login", { transition: "slide", changeHash: false });
    else
      $.mobile.changePage( "#page_scan", { transition: "slide", changeHash: false});
      }

      function swipe_page_right( event ){
          if ($.mobile.activePage.attr( "id" ) == 'page_scan')
             $.mobile.changePage( "#page_login", { transition: "slide", changeHash: false, reverse : true});
          else
            $.mobile.changePage( "#page_scan", { transition: "slide", changeHash: false, reverse : true  });
      }

      $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( "#page_login" ).on( "swipeleft", swipe_page_left );
          $( "#page_scan" ).on( "swipeleft", swipe_page_left );
          

          $( "#page_login" ).on( "swiperight", swipe_page_right );
          $( "#page_scan" ).on( "swiperight", swipe_page_right );


          
        });

    });

    

  

</script>
</bodyx>
</html>
