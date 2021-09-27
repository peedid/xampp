<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<html>

<head>

  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo asset_url(); ?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url(); ?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url(); ?>jssor/js/jssor.slider-21.1.5.mini.js"></script>
  <link rel="stylesheet" href="<?php echo asset_url(); ?>css/general.css" />
  <script type="text/javascript">
    jQuery(document).ready(function($) {

      $.mobile.loading("hide");

      var jssor_1_SlideshowTransitions = [{
          $Duration: 1200,
          x: 0.3,
          $During: {
            $Left: [0.3, 0.7]
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: -0.3,
          $SlideOut: true,
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: -0.3,
          $During: {
            $Left: [0.3, 0.7]
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: 0.3,
          $SlideOut: true,
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: 0.3,
          $During: {
            $Top: [0.3, 0.7]
          },
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: -0.3,
          $SlideOut: true,
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: -0.3,
          $During: {
            $Top: [0.3, 0.7]
          },
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: 0.3,
          $SlideOut: true,
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: 0.3,
          $Cols: 2,
          $During: {
            $Left: [0.3, 0.7]
          },
          $ChessMode: {
            $Column: 3
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: 0.3,
          $Cols: 2,
          $SlideOut: true,
          $ChessMode: {
            $Column: 3
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: 0.3,
          $Rows: 2,
          $During: {
            $Top: [0.3, 0.7]
          },
          $ChessMode: {
            $Row: 12
          },
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: 0.3,
          $Rows: 2,
          $SlideOut: true,
          $ChessMode: {
            $Row: 12
          },
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: 0.3,
          $Cols: 2,
          $During: {
            $Top: [0.3, 0.7]
          },
          $ChessMode: {
            $Column: 12
          },
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          y: -0.3,
          $Cols: 2,
          $SlideOut: true,
          $ChessMode: {
            $Column: 12
          },
          $Easing: {
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: 0.3,
          $Rows: 2,
          $During: {
            $Left: [0.3, 0.7]
          },
          $ChessMode: {
            $Row: 3
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: -0.3,
          $Rows: 2,
          $SlideOut: true,
          $ChessMode: {
            $Row: 3
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: 0.3,
          y: 0.3,
          $Cols: 2,
          $Rows: 2,
          $During: {
            $Left: [0.3, 0.7],
            $Top: [0.3, 0.7]
          },
          $ChessMode: {
            $Column: 3,
            $Row: 12
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          x: 0.3,
          y: 0.3,
          $Cols: 2,
          $Rows: 2,
          $During: {
            $Left: [0.3, 0.7],
            $Top: [0.3, 0.7]
          },
          $SlideOut: true,
          $ChessMode: {
            $Column: 3,
            $Row: 12
          },
          $Easing: {
            $Left: $Jease$.$InCubic,
            $Top: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          $Delay: 20,
          $Clip: 3,
          $Assembly: 260,
          $Easing: {
            $Clip: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          $Delay: 20,
          $Clip: 3,
          $SlideOut: true,
          $Assembly: 260,
          $Easing: {
            $Clip: $Jease$.$OutCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          $Delay: 20,
          $Clip: 12,
          $Assembly: 260,
          $Easing: {
            $Clip: $Jease$.$InCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        },
        {
          $Duration: 1200,
          $Delay: 20,
          $Clip: 12,
          $SlideOut: true,
          $Assembly: 260,
          $Easing: {
            $Clip: $Jease$.$OutCubic,
            $Opacity: $Jease$.$Linear
          },
          $Opacity: 2
        }
      ];

      var jssor_1_options = {
        $AutoPlay: true,
        $SlideshowOptions: {
          $Class: $JssorSlideshowRunner$,
          $Transitions: jssor_1_SlideshowTransitions,
          $TransitionsOrder: 1
        },
        $ArrowNavigatorOptions: {
          $Class: $JssorArrowNavigator$
        },
        $ThumbnailNavigatorOptions: {
          $Class: $JssorThumbnailNavigator$,
          $Cols: 10,
          $SpacingX: 8,
          $SpacingY: 8,
          $Align: 360
        }
      };

      var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

      //responsive code begin
      //you can remove responsive code if you don't want the slider scales while window resizing
      function ScaleSlider() {
        var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
          refSize = Math.min(refSize, 800);
          jssor_1_slider.$ScaleWidth(refSize);
        } else {
          window.setTimeout(ScaleSlider, 30);
        }

      }
      ScaleSlider();
      $(window).bind("resize", ScaleSlider);

      if ('1' == <?php echo (($this->session->userdata('ganti_password') != null) && ($this->session->userdata('ganti_password') == 1) ? "'1'" : "'0'"); ?>) {
        // cek apakah ada form popup ganti password
        var pop = document.getElementById('pop_gantipassword');
        if (pop) {
          setTimeout(function() {

            $('#pop_gantipassword').popup('open');
          }, 2000);
          //$("#blah").ForceReload();
        }
      }
    });
  </script>

  <style>
    /* jssor slider arrow navigator skin 05 css */
    /*
        .jssora05l                  (normal)
        .jssora05r                  (normal)
        .jssora05l:hover            (normal mouseover)
        .jssora05r:hover            (normal mouseover)
        .jssora05l.jssora05ldn      (mousedown)
        .jssora05r.jssora05rdn      (mousedown)
        */
    .jssora05l,
    .jssora05r {
      display: block;
      position: absolute;
      /* size of arrow element */
      width: 40px;
      height: 40px;
      cursor: pointer;
      background: url('img/a17.png') no-repeat;
      overflow: hidden;
    }

    .jssora05l {
      background-position: -10px -40px;
    }

    .jssora05r {
      background-position: -70px -40px;
    }

    .jssora05l:hover {
      background-position: -130px -40px;
    }

    .jssora05r:hover {
      background-position: -190px -40px;
    }

    .jssora05l.jssora05ldn {
      background-position: -250px -40px;
    }

    .jssora05r.jssora05rdn {
      background-position: -310px -40px;
    }

    /* jssor slider thumbnail navigator skin 01 css */
    /*
        .jssort01 .p            (normal)
        .jssort01 .p:hover      (normal mouseover)
        .jssort01 .p.pav        (active)
        .jssort01 .p.pdn        (mousedown)
        */
    .jssort01 .p {
      position: absolute;
      top: 0;
      left: 0;
      width: 72px;
      height: 72px;
    }

    .jssort01 .t {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    .jssort01 .w {
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
    }

    .jssort01 .c {
      position: absolute;
      top: 0px;
      left: 0px;
      width: 68px;
      height: 68px;
      border: #000 2px solid;
      box-sizing: content-box;
      background: url('img/t01.png') -800px -800px no-repeat;
      _background: none;
    }

    .jssort01 .pav .c {
      top: 2px;
      _top: 0px;
      left: 2px;
      _left: 0px;
      width: 68px;
      height: 68px;
      border: #000 0px solid;
      _border: #fff 2px solid;
      background-position: 50% 50%;
    }

    .jssort01 .p:hover .c {
      top: 0px;
      left: 0px;
      width: 70px;
      height: 70px;
      border: #fff 1px solid;
      background-position: 50% 50%;
    }

    .jssort01 .p.pdn .c {
      background-position: 50% 50%;
      width: 68px;
      height: 68px;
      border: #000 2px solid;
    }

    * html .jssort01 .c,
    * html .jssort01 .pdn .c,
    * html .jssort01 .pav .c {
      /* ie quirks mode adjust */
      width
      /**/
      : 72px;
      height
      /**/
      : 72px;
    }


    * {
      font: 14px Calibri, Arial !important;
    }

    h1 {

      font: 20px Calibri, Arial !important;
      font-weight: bold;

    }

    .borange .ui-collapsible-heading-toggle {
      background: orange !important;
    }

    .ui-page {}

    #popup_news {

      border: 1px solid #000;
      border-right: none;
      background: rgba(0, 0, 0, .5);
      margin: -1px 0;
    }

    .ui-popup-container,
    .ui-popup {
      height: 90%;
      width: 95%;
      position: absolute;
      top: 0;
      left: 0;
    }

    @media only screen and (min-width: 1025px) {
      .ui-page {
        width: 960px !important;
        margin: 0 auto !important;
        position: relative !important;
      }
    }


    @media all and (max-width: 35em) {

      .my-breakpoint .ui-block-a,
      .my-breakpoint .ui-block-b,
      .my-breakpoint .ui-block-c,
      .my-breakpoint .ui-block-d,
      .my-breakpoint .ui-block-e {
        width: 100%;
        float: none;
      }
    }
  </style>

</head>

<body>

  <div data-role="page" id="page_main" data-theme="a" data-transition="flip">
    <?php

    $this->load->view('v_header');

    $this->session->set_userdata('url_back', $_SERVER['REQUEST_URI']);
    if ($this->session->userdata('new_login') != null) {
      if ($this->session->userdata('new_login') == 1) {
        try {
          //$trans = ibase_trans();
          //$query = "INSERT INTO MST_OPERATOR_LOG_MOBILE(KODE_OPERATOR) VALUES('".$_SESSION['userid']."')";
          //$result = ibase_query($trans, $query);
          // commit transaction
          //ibase_commit($trans);
          $this->session->set_userdata('new_login', 0);
        } catch (ErrorException $e) {
          //ibase_rollback($trans);
        }
      }
    }
    ?>
    <div data-role="content" id="id_content" name="id_content" style="padding:0px 0px 0px 0px;">

      <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width:800px; height: 456px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
          <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
          <div style="position:absolute;display:block;background:url('<?php echo asset_url(); ?>img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>

        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 500px; overflow: hidden;">

          <?php
          $this->load->helper('directory');

          $hasil = "";
          $dir = asset_url() . $this->session->userdata('namatoko') . "/";

          $map = directory_map('./assets/' . $this->session->userdata('namatoko') . '/', 1);
          foreach ($map as $value) {
            if ($value != 'index.php') {
              $hasil = $hasil . '<div onclick="" data-p="144.50" style="display: none;">';
              $hasil = $hasil . '   <img data-u="image" src="' . $dir . $value . '" />';
              $hasil = $hasil . '</div>';
            }
          }
          unset($value);
          echo $hasil;
          ?>
        </div>
      </div>

      <br>
      <!-- header toko -->
      <div algin="left" style="height:50px;margin-top:-10px;margin-left:5px">
        <div style="float:left;height:48px;width:48px">
          <?php
          if ($this->session->userdata('logotoko') != null)
            $photo = $this->model->showphoto_user($this->session->userdata('logotoko'));
          else
            $photo = asset_url() . "gambar/store.png";
          ?>
          <img style="width:100%;height:100%" src="<?php echo $photo ?>" />
        </div>

        <div style="float:left">
          <p style=" margin-top:3px;font-weight:bold !important;font-size:20px !important;margin-left:3px;"><?php echo $this->session->userdata('namatoko') ?></p>
          <p style=" margin-top:0px;margin-top:-20px;font-size:10px !important;margin-left:3px;"><?php echo $this->session->userdata('alamattoko') ?></p>

        </div>
      </div>

      <div align="center" id="daftarmenu" class="ui-grid-c" style="margin-top:10px;margin-left:5px !important">
        <?php
        $this->model->GetMenuAkses($this->session->userdata('user_id'));
        ?>
      </div>
    </div>

    <!-- popup virtual account -->
    <div data-role="popup" id="pop_virtualaccount" data-theme="b" data-dismissible="false" data-position-to='window' style="margin-top:200px;max-width:400px;max-height: 200px;">
          <div data-role="header" data-theme="a" style='margin-top:-15px;padding-top:0px;height:40px;'>
             <div style='font-size: 20px !important;text-align: center;margin-top: -10px'>VIRTUAL ACCOUNT</div>
            </div>
          <div role="main" class="ui-content" align="center">
                <div style='font-size: 25px !important'><?php echo $this->session->userdata('virtual_account'); ?></div>
                <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">OK</a>
            </div>
    </div>


    <div data-role="popup" id="pop_cari_user" data-theme="a" data-dismissible="false" data-position-to='window' style="margin-top:200px;max-width:400px;max-height: 200px;">
      <div data-role="header" style="height:45px">
        <div id="info_header" align="center" style="width:100%;padding-top:10px">
          Cari User
        </div>
      </div>
      <div align="center" data-role="content">
            
        <div>
          <input tyle="text" id="txt_cari_user" value="" data-clear-btn="true" placholder="ketik disini">
        </div>
        <a onclick="" id='btn_cancel' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
        <a onclick="CariUser_sekarang()" id='btn_action' proses="" angka="" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
            
      </div>
    </div>

    <div data-role="popup" id="pop_info" data-theme="b" data-dismissible="false" data-position-to='window' style="margin-top:200px;max-width:400px;max-height: 200px;">
      <div data-role="header" style="margin-top:-20px;height:45px">
        <div id="info_header_info" align="center" style="width:100%;padding-top:10px;font-size:20px !important">

        </div>
      </div>
      <div role="main" class="ui-content" align="center">
             <p id="info_content"></p>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">OK</a>
            
      </div>
    </div>

  </div> <!-- akhir div page utama -->

  <script>
    function mysubmit() {
      if ($('#txt_password').val()) {
        GetLoading();
        $('#form_password').submit();
      } else {
        document.getElementById('keterangan').style.color = "red";
      }
    }

    function openDialog() {
      document.getElementById('fileid').click();
    }

    function gambarclick() {
      openDialog();
    }

    function show_va() {
      $("#pop_virtualaccount").popup({
        "data-position-to": "window"
      });
      $("#pop_virtualaccount").popup("open");
    }

    function mysubmit() {
      if ($('#txt_password').val()) {
        GetLoading();
        $('#form_password').submit();
      } else {
        document.getElementById('keterangan').style.color = "red";
      }
    }

    function kirim_websocket() {
      data = '{"method_name":"send_to_user","workspace":"GRIYA SARANA INFORMATIKA", "kode_user":"GSI", "data" : {"method_name":"CETAK_ANTRIANONLINE","kode_antrian":"kode_antrian","path_gambar":"path_gambar"}}';
      send_websocket(data);
    }

    function CheckPrice() {
      //scan_barcode();
      data = '{"method_name":"get_clients","workspace":"<?php echo $this->session->userdata('namatoko'); ?>"}';
      send_websocket(data);
    }

    function CariUser() {
      $("#pop_cari_user").popup({
        "data-position-to": "window"
      });
      $("#pop_cari_user").popup("open");
      $('#txt_cari_user').focus();
    }

    function CariUser_sekarang() {
      window.location = '<?php echo home_url(); ?>DaftarUser?cari=' + ($('#txt_cari_user').val()).toUpperCase();
    }

    function GoBack() {
      //a

    }


    $("#pesanan_baru").click(function(e) {

      var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
      var token_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

      e.stopImmediatePropagation();
      e.preventDefault();

      showModal();
      var kode_buildup = '<?php echo $this->session->userdata('kodebuildup') ?>';
      $.ajax({
        url: '<?php echo home_url() ?>Get_data/cek_adapesanan_aktif',
        method: 'GET',
        data: {
          [token_name]: token_hash
        },
        beforesend: function() {

        },
        success: function(res) {
          hideModal();
          //console.log(res);
          hasil = jQuery.parseJSON(res);
          token_hash = hasil.token_hash;
          if (hasil.result_code == '1') {
            document.getElementById('info_header_info').innerHTML = 'Oops...';
            document.getElementById('info_content').innerHTML = hasil.message;
            $('#pop_info').popup('reposition', 'positionTo: window');
            $("#pop_info").popup("open");
          } else {
            window.location = $(e.target).parent().attr("href");
            showModal();
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          hideModal();
          GetReloadPage();
        }
      });

    });
  </script>

</body>

</html>