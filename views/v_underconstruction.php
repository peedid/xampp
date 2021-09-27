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
</head>
<body>
    <div data-role="page" id="page_under" data-theme="a">
       <div  data-role="content" align="center" >
          <div class="center" >
            <img src="<?php echo asset_url()?>gambar/underconstruction.png" alt="" style="width:100%;height:100%">
            <div align="center">
                  <a href="<?php echo home_url();?>main" rel="external"><input id="btn_ulangi" data-inline="true" type="button" value="Back"></a>
            </div>
          </div>
      </div>
   </div>

<script>

$(document).on('pageshow', '[data-role="page"]', function(){  
    setTimeout(function(){
        $.mobile.loading('hide');
    },300);      
});

function GoBack() {
    window.history.back();
}


 showModal();
    
    $(document).ready(function() {
       // Handler for .ready() called.
       hideModal();
       console.log('keluar');
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
    
</script>
</body>
</html>