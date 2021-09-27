<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo asset_url()?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url()?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
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

      
    </style>
</head>
<body>
    <div data-role="page" id="page_main" data-theme="a" data-transition="slide">
        <?php
           $this->load->view('v_header');
           
        ?>
        <div data-role="content">
          <div id="header_nota" style='margin-top:-10px;margin-right:-10px'>
            <a href="#" id="tambah" class="ui-btn ui-btn-inline ui-icon-plus ui-btn-icon-right" style="float: right;border-radius: 5px;border: 2px solid orange;">Tambah</a>
            <div style="clear: both;"></div>
			<label for="cmb_gudang">Gudang :</label>
			<select name="cmb_gudang" id="cmb_gudang" data-native-menu="false">
				<option value="default" selected>SEMUA GUDANG</option>
				<?php
					$q_gudang = $this->model->_query('trading',"SELECT * FROM MST_GUDANG");
          foreach ($q_gudang->result() as $r_gudang) {
	                echo"
	                <option value='".$r_gudang->KODE_GUDANG."'>".$r_gudang->GUDANG."</option>
	                ";
	                }
				?>
			</select>
			<form class="ui-filterable">
				<input id="rich-autocomplete-input" data-type="search" placeholder="Cari Customer ...">
			</form>
				<?php
				$q_pelanggan = $this->model->_query('trading',"SELECT * FROM MST_CUSTOMER WHERE STRLEN(COALESCE(NAMA_CUSTOMER,'')) > 0 ORDER BY NAMA_CUSTOMER  ");
				?>
				<ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listCustomer" data-split-icon="gear">
					<?php 
             foreach ($q_pelanggan->result() as $r_pelanggan):
          ?>	
						<li onclick="item_click(this, '<?= $r_pelanggan->KODE_CUSTOMER; ?>')" style="margin-bottom: 5px;" id="<?= $r_pelanggan->KODE_CUSTOMER; ?>">
							<a href="#">
								<h2><?= $r_pelanggan->NAMA_CUSTOMER; ?></h2>
								<p><?= $r_pelanggan->TELP; ?></p>
							</a>
              <a href="#purchase" id="<?= $r_pelanggan->KODE_CUSTOMER ?>" class="tomboledit" style="border-left: 1px solid orange;" data-rel="popup" data-position-to="window" data-transition="pop">Edit</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
      <div data-role="popup" id="tanya_hapus" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                <div data-role="header" data-theme="a">
                    <h1>Hapus Customer?</h1>
                </div>
                <div role="main" class="ui-content">
                    <h3 class="ui-title">anda yakin ingin menghapus Customer ini ?</h3>
                    <p id='info_delete'></p>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Batal</a>
                    <a href="#" id="del" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">Hapus</a>
                </div>
            </div> 
		</div>
    </div>
    
<script>
  $('.tomboledit').click(function(){
    let kodeunik = $(this).attr('id');
    window.location.href = '<?php echo home_url()?>customer/' +kodeunik;
  })

  klik2x = 0;
	klikfrom = ''
	selectted_id = '';
	JOB_ID = 0;

	jQuery("#listCustomer" ).on( "taphold",{duration: 5000}, function( event ) {  
	    klik2x = 1;
	    klikfrom = 'taphold';
	    $('#listCustomer').click();
	    //console.log('diteken');
	} );

	$('#listCustomer').dblclick(function() {
	    klik2x = 1;
	    klikfrom = 'dblclick';
	    $('#listCustomer').click();
	});

	function item_click(sender,id) {
		KODE_CUSTOMER = id;
    if (klik2x == 1) {
        if (klikfrom == 'taphold') {
            klik2x = 0;
            klikfrom = '';
            $('ul:visible').listview('refresh');
            document.getElementById('info_delete').innerHTML = document.getElementById($(sender).attr('id')).innerHTML;
            selected_id = $(sender).attr('id');
            console.log(sender);
            $( "#tanya_hapus" ).popup( "open", {transition:'slidedown'} );
            $('#del').click(function(){
              setTimeout(function(event,ui){
                  $.mobile.loading('show',{
                  text: 'Sedang Menghapus...',
                  textVisible: true,
                  theme: 'b',
                  html: ""
                  });
              },1);
            	$.ajax({  
                     url:"<?php echo home_url()?>customer/delete/" + KODE_CUSTOMER,  
                     method:"GET",  
                     data: null,
                     success:function(data){
                     	//console.log('sukses hapus');
                     	window.location.href = '<?php echo home_url() ?>customer';
                     }
                });
            });
        }

        if (klikfrom == 'doubletap' || klikfrom == 'dblclick') {
        	console.log('dobelklik');
            klik2x = 0;
            klikfrom = '';
            // setTimeout(function(event,ui){
            //     $.mobile.loading('show',{
            //     text: 'Tunggu ya...',
            //     textVisible: true,
            //     theme: 'b',
            //     html: ""
            //     });
            // },1);
            // window.location.href = 'customer_edit.php?KODE_CUSTOMER='+KODE_CUSTOMER;

            $('ul:visible').listview('refresh');
            document.getElementById('info_delete').innerHTML = document.getElementById($(sender).attr('id')).innerHTML;
            selected_id = $(sender).attr('id');
            console.log(sender);
            $( "#tanya_hapus" ).popup( "open", {transition:'slidedown'} );
            $('#del').click(function(){
              setTimeout(function(event,ui){
                  $.mobile.loading('show',{
                  text: 'Sedang Menghapus...',
                  textVisible: true,
                  theme: 'b',
                  html: ""
                  });
              },1);
              $.ajax({  
                     url:"<?php echo home_url()?>customer/delete/" + KODE_CUSTOMER,  
                     method:"GET",  
                     data: null,
                     success:function(data){
                      //console.log('sukses hapus');
                      window.location.href = '<?php echo home_url() ?>customer';
                     }
                });
            });
		        }        
		    }       
		}


  // $('#cmb_gudang').change(function(){
  // 	$('#listCustomer').hide();
  // });

  $('#cmb_gudang').change(function(){
  		let kg = $('#cmb_gudang').val();
  		if(kg != '')  
        {  
             showModal();
             $.ajax({  
                url:"<?php echo home_url()?>customer/filter/" + kg,  
                method:"GET",  
                data: null,  
                success:function(data)  
                {  
                	//console.log('oke');
                    $('#listCustomer').html(data);  
                    $('#listCustomer').show();
                    $('ul:visible').listview('refresh');
                    hideModal();
                }  
           });  
        }  
        else  
        {  
             // alert("Pilih gudang dulu");
        }  
  });

  $('#tambah').click(function(){
  	let kg = $('#cmb_gudang').val();
  	if (kg == 'default') {
  		setTimeout(function(event,ui){
          $.mobile.loading('show',{
          text: 'PILIH GUDANG DULU',
          textVisible: true,
          theme: 'b',
          textonly:true,
          html: ""
          });
      },1);   

      setTimeout(function(){
          $.mobile.loading('hide');
      },1000); 
  		return false;
  	}
  	window.location.href = '<?php echo home_url() ?>customer/tambah/'+kg;
  })

    
  document.getElementById('goback').href = "<?php home_url()?>main";
    

</script>
</body>
</html>