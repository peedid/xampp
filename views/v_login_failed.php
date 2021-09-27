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
</head>
<body>
    <div data-role="dialog" id="page_login" data-close-btn="none" data-theme="b">
		<div data-role="header">
            <h1>Upss..</h1>
        </div>
       <div data-role="content">
          <p align="center"> Username atau password yang anda masukan salah</p>
          <div align="center">
                <a href="<?php echo ( empty($current_url) ? home_url() : $current_url ) ;?>" rel="external"><input id="btn_ulangi" data-inline="true" type="button" value=" Ulangi Lagi "></a>
                <a href="<?php echo  home_url(); ?>" rel="external"><input id="btn_home" data-inline="true" type="button" value=" LOGIN "></a>
            </div>
       </div>
    </div>

<script>
     
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