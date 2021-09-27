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
    <div data-role="page" id="page_pilih_toko" name = "page_pilih_toko">
      <?php
          $data = null;
          if (!empty($without_profile)) {
             $data['without_profile'] = $without_profile;  
          }
          
          $this->load->view('v_header',$data);
      ?>
  		<div data-role="content">
           <div style="margin-top:50px;margin-left:30px;margin-right:30px">
            <div style="text-align:center;">
                <img  style="width:48px;height:48px" src="<?php echo asset_url()?>gambar/store.png"/>
            </div>
            <p style="font-size:20px;font-weight:bold;margin-bottom:30px;text-align:center;margin-top:5px;"> DAFTAR TOKO</p>
            <ul data-role="listview" data-theme="b">
                <?php
                   

                   if (!empty($daftar_toko)) {
                     foreach ($daftar_toko->result() as $result) {
                       if($result->LOGO != null)
                          $photo = $this->model->showphoto_user($result->LOGO);
                       else
                          $photo = asset_url()."gambar/store.png";
                        echo "
                          <li style='height:70px;margin-bottom:5px;'><a rel='external' onclick='showModal();' href='".home_url()."login/goto_toko/".$result->TOKO."' >".
                          "<div style='float:left;width:32px;height:32px'>
                             <img style='width:100%;height:100%' src='$photo' />
                           </div>
                          ".
                          "<div style='float:left;margin-left:5px;margin-top:-5px;'>".
                          "<p style='font-size:12px;font-weight:bold'>".$result->TOKO."</p>".
                          "<p style='font-size:10px;margin-top:-5px;width:180px;margin-right:10px;'>".$result->ALAMAT."</p>".
                          "</div>".
                          "</a></li>
                       ";
                     }
                   } else {
                      echo "
                          <li><a rel='external'  href='".home_url()."'>TIDAK ADA TOKO</a></li>
                       ";
                   }
                ?>
            </ul>
          </div>
      </div>
    </div>

<script>
      $(document).on('pagebeforecreate', '[data-role="page"]', function(){     
          showModal();    
      });

      $(document).on('pageshow', '[data-role="page"]', function(){  
          setTimeout(function(){
              $.mobile.loading('hide');
          },300);      
      });
    
</script>

</body>
</html>