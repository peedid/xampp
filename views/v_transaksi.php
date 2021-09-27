<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
	<link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
  
	<title></title>
<style type="text/css">
	* {
		box-sizing: border-box;
	}
    .piutang_customer {
    	width: 60px;
    	height: 60px;
    	background-image: url("<?php echo asset_url();?>gambar/mst_customer.png");
    	background-size: 60px 60px;
    	border-radius: 50%;
    }
    .hutang_supplier {
    	width: 60px;
    	height: 60px;
    	background-image: url("<?php echo asset_url();?>gambar/supplier.png");
    	background-size: 60px 60px;
    	border-radius: 50%;
    }

</style>
</head>
<body>
<div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
	<div class="content">
		<?php
			$this->load->view('v_header')
		?>
		<div align="center"><h3><b>MENU TRANSAKSI</b></h3></div>
	</div>
	<div class="ui-grid-c" >
		<div class="ui-block-a" >
			<div onclick= "piutang_direct()" align="center">
				<div class="piutang_customer"></div>
				<div class="imgCaption">PIUTANG CUSTOMER</div></div>
		</div>
		<div class="ui-block-b" >
			<div onclick= "hutang_direct()" align="center">
				<div class="hutang_supplier"></div>
				<div class="imgCaption">HUTANG SUPPLIER</div></div>
          </div>
    </div>

</div> end page


<script type="text/javascript">
	function piutang_direct(){
        window.location = "<?php echo home_url() ?>Transaksi/piutang"
      }
    function hutang_direct(){
        window.location = "<?php echo home_url() ?>Transaksi/hutang"
      }
</script>
</body>
</html>