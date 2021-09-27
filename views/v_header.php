<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>


<script type="text/javascript">
    
    var barcode_item = null;
    var replay_websocket = null;

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

    function GetReloadPage() {
        GetLoading();
        location.reload();
    }


    function GoBack() {
        <?php 
        $url = strtoupper(base_url(uri_string()));
        echo "console.log('".$url."');";
        if (strpos($url, "MAIN"))
            echo "window.location = '".home_url()."';";
        else 
           echo "window.history.back();";
       ?>
    }

    (function($){
    $.fn.ForceReload = function(UserSettings){

        // Settings
        var Settings = $.extend({
            Hash: new Date().getTime()
        }, UserSettings);

        // Image iteration
        this.each(function(){
            var _this = $(this);
            var img = _this.clone();
            var src = img.attr("src");
            img.attr("src", src + (src.indexOf("?") > -1 ? "&" : "?") + "hash=" + Settings.Hash).one("load", function(){    
                _this.after(img);
                _this.remove();
            });
        });
    }
    }(jQuery));


  function identify_websocket() {
     try {
        if (typeof Android === 'object') 
              data = '{"method_name":"update_client","client_kode_user":"<?php echo $this->session->userdata('username');?>","client_nama_user" : "<?php echo $this->session->userdata('nama');?>","client_group_name":"<?php echo $this->session->userdata('namatoko');?>","workspace":"<?php echo $this->session->userdata('namatoko');?>"}';
              Android.jav_set_websocket('{"method_name":"identify_websocket","data":'+ data+ '}');
      } catch(err) {
      }  
  }

  function send_websocket(v_data){
      if (typeof Android === 'object') {
          Android.jav_send_websocket(v_data);
      }
  }

  function set_barcode_item(vbarcode_item){
      barcode_item = vbarcode_item;
  }

  function set_replay_websocket(vdata){
      replay_websocket = vdata;
  }

  function scan_barcode() {
    try {
          if (typeof Android === 'object') {
              barcode_item = null;
              Android.jav_takebarcode();
          } 
          else 
               alert('Device Not Supported !');
    } catch(err) {
    }
  }

  identify_websocket();

</script>

    <?php
    $hasil = $this->model->_CekUsername($this->session->userdata('username'), $this->session->userdata('password')); 
    if ($hasil >= 1) {

    } else {
           redirect(home_url());
           die();
        }

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if (empty($without_profile)) {
        if($this->session->userdata('userphoto') != null)
          $photo = $this->model->showphoto_user($this->session->userdata('userphoto'));
        else
            $photo = asset_url()."gambar/person_noimage.png";
    } else {

    }

  $unik_id = rand(1,1000);
  
?>
 
<div data-role="header" data-position="fixed" data-tap-toggle='false' id="header_<?php $unik_id ?>">
            <h1 style="padding:5px;margin:auto;">
                <div style="float:left;">
                    <a id='goback' href='' rel='external' onclick='GoBack()'>
                            <img  id='goimg' src='<?php echo asset_url(); ?>gambar/icon-back.png' style='margin: 6px 0px 0px 0px;float:left;height:28px;width:28px;'>
                    </a>   
                <?php
                    if (empty($without_profile)) {
                        echo "
                            <div onclick='' style='margin-left: 3px; float:left;'>
                                <img id='userphoto' style='cursor:pointer;border-radius: 50%;border: 2px solid white; width:36px; height: 36px;' src='$photo'> 
                            </div>";
                    } else {

                    }
                ?>

                </div> <!-- akhir icon di kiri -->

              
                <div id="right_buttons" style="float:right;height:100%;">
                    
                        <img id="refresh" onclick="GetReloadPage()" src="<?php echo asset_url(); ?>gambar/refresh.png" style="cursor:pointer;margin:5px 10px 2px 2px;float:left;height:28px;width:28px;">
                       <!-- 
                        <a href="<?php echo home_url();?>login" rel="external"><img onclick="GetLoading()" src="<?php echo asset_url(); ?>gambar/logout.png" style="cursor:pointer;margin:5px 2px 2px 0px;float:left;height:28px;width:28px;"></a>
                        -->
                </div>
                <div id="userinfo" style="margin-top:3px; margin-left:5px;float:left;">
                    <div align="left" style="line-height:130%;margin-bottom:0px;padding:0px 0px 0px 0px;color:orange;font-size:14px;"><?php echo substr($this->session->userdata('nama'),0,22);?></div>
                    <div  align="left" style="line-height:100%;margin-top: 0px; padding:0px 0px 0px 0px;color:white;font-size:8px;"><?php echo (empty($without_profile)?' '.$this->session->userdata('namatoko'):"") ?> </div>
                    
                </div>
            </h1>

</div>

<script>
    $("#userphoto").ForceReload();
</script>