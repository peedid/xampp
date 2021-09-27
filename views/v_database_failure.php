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
          <p align="center"> TIDAK DAPAT MENGHUBUNGI DATABASE !!! <BR> Silahakn hubungi Admin Anda...</p>
          <div align="center">
                <a href="<?php echo ( empty($current_url) ? home_url() : $current_url ) ;?>" rel="external"><input id="btn_ulangi" data-inline="true" type="button" value=" Ulangi Lagi "></a>
                <a href="<?php echo  home_url(); ?>" rel="external"><input id="btn_home" data-inline="true" type="button" value=" LOGIN "></a>
            </div>
       </div>
    </div>
<script>
      $(document).on('pagebeforecreate', '[data-role="page"]', function(){     
    setTimeout(function(){
        $.mobile.loading('show',{
	text: 'Tunggu Ya...',
	textVisible: true,
	theme: 'b',
	html: ""
});
    },1);    
});

$(document).on('pageshow', '[data-role="page"]', function(){  
    setTimeout(function(){
        $.mobile.loading('hide');
    },300);      
});
    
    </script>
</body>
</html>