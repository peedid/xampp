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
      #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #customers tr:nth-child(even){background-color: #f2f2f2;}

      #customers tr:hover {background-color: #ddd;}

      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }
      
      label   {margin-bottom:-20px !important;text-align:left !important;}
      
    </style>
</head>
<body>
    <div data-role="page" id="page_main" data-theme="a" data-transition="slide" data-ajax="false">
        <?php
           $this->load->view("v_header.php");
           
        ?>
        <div data-role="content">
            <div id="header_nota" style='margin-top:0px;margin-right:-10px'>
              <a href="#" onclick="tambah()" id="tambah" class="ui-btn ui-btn-inline ui-icon-plus ui-btn-icon-right" style="float: right;border-radius: 20px;border: 2px solid orange;">Tambah</a>
          </div>
  			  <div style="clear: both;"></div>   				
        <?php
  				$q_gcustomer = $this->model->_query('trading',"SELECT A.*,B.* FROM MST_G_CUSTOMER A LEFT JOIN MST_TINGKATAN_HARGA B ON A.TINGKATAN_HARGA = B.TINGKATAN_HARGA ORDER BY GROUP_CUSTOMER");
  				?>
  				<ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer" data-split-icon="gear">
    					<?php 
                 foreach ($q_gcustomer->result() as $row):
              ?>	
    						<li style="margin-bottom: 5px;" id="<?= $row->GROUP_CUSTOMER; ?>">
    							<a href="#">
    								<h2><?= $row->GROUP_CUSTOMER; ?></h2>
    								<p>Level : <?= $row->TINGKATAN_HARGA; ?> <span style="color: yellow;">( <?= number_format($row->PERSEN_HARGAJUAL,0,",","."); ?>% )</span></p>

    							</a>
                  <a href="#" id="<?= $row->GROUP_CUSTOMER ?>"  class="tomboledit" style="border-left: 1px solid orange;" data-rel="popup" data-position-to="window" data-transition="pop">Edit</a>
    						</li>
    					<?php endforeach; ?>
  				</ul>
			</div>

        <div data-role="popup" id="tanya_hapus" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                  <div data-role="header" data-theme="a">
                      <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Back</a>
                      <h1>Rubah</h1>
                  </div>
                  <div role="main" class="ui-content">
                      <div>
                           <label for="txt_groupcustomer">Group Customer</label>
                           <input type="text" data-clear-btn="true" data-mini="true" name="txt_groupcustomer" id="txt_groupcustomer" value="">
                      </div>
                      <div>
                          <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
                          <a href="" id="btn_update" onclick= "update()" update_id = ""  class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">UPDATE</a>
                          <a href="" id="btn_save" onclick= "simpan()"  class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">SAVE</a>
                      </div>
                  </div>
        </div> 
		</div>
    
<script>

  $('#btn_save').hide();

  function hapus() {
     hapus_id = $('#btn_delete').attr('hapus_id');
     //console.log(hapus_id);
     window.location  = '<?php echo home_url()?>customer_group/delete/' + hapus_id; 
  }


  function simpan() {
    if ( $('#txt_groupcustomer').val() )
       window.location  = '<?php echo home_url()?>customer_group/insert/' +  $('#txt_groupcustomer').val(); 
    else
        alert('TIDAK BOLEH KOSONG !');
  }

  function tambah() {
     $('#btn_delete').hide();
     $('#btn_update').hide();
     $('#btn_save').show();
     $('#txt_groupcustomer').val('');

     $( "#tanya_hapus" ).popup( "open" );
  }

  function update() {
     update_id = $('#btn_update').attr('update_id');
     window.location  = '<?php echo home_url()?>customer_group/update/' + update_id + '/' + $('#txt_groupcustomer').val() ; 
  }

  $('.tomboledit').click(function(){
    let kodeunik = $(this).attr('id');
    $('#btn_delete').show();
    $('#btn_update').show();
    $('#btn_save').hide();
    $('#txt_groupcustomer').val($(this).attr('id'));
    $('#btn_delete').attr('hapus_id',$(this).attr('id'));
    $('#btn_update').attr('update_id',$(this).attr('id'));
    $( "#tanya_hapus" ).popup( "open" );
  })

  $('#customer_harga').click(function(){
    window.location = 'customer_harga.php';
  })

  $('#customer_master').click(function(){
    window.location.href = '<?php echo home_url(); ?>customer';
  })

	$('#listGCustomer').dblclick(function() {
	   console.log('masuk');
	});

	function item_click(sender,id) {
		GROUP_CUSTOMER = id;
    console.log('masuk');
	}

  document.getElementById('goback').href = "<?php echo home_url() ?>main";

</script>
</body>
</html>