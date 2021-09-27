<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
  <title></title>
  <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 

</head>
<body>
   <?php 
         $this->load->view('v_header');
      ?>

      <div align="center"> <h3>Riwayat Delete Customer</h3></div>
   <div>

            <?php
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
               SELECT 
                A.NAMA_CUSTOMER,
                A.KODE_CUSTOMER,
                A.ALAMAT,
                A.TELP,
                A.NOMER_KTP
              FROM 
                MST_CUSTOMER A
              WHERE
                COALESCE(A.BATAL,0)=1
              ORDER BY A.WAKTU_INPUT DESC
                "); 
             ?>
             
          
        <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer" >
           <?php 
                 $ada_data = 0;
                 $nomer = 1;
                 foreach ($ds_hasil ->result() as $row):
              ?>  

                 <li style="margin-bottom: 5px;" nama = "<?= $row->NAMA_CUSTOMER; ?>" alamat = "<?= $row->ALAMAT; ?>" telp = "<?= $row->TELP; ?>" id="<?= $row->KODE_CUSTOMER; ?>" ktp = "<?= $row->NOMER_KTP; ?>" id = "<?= $row->KODE_CUSTOMER; ?>" >
                             <a href="#">
                              <div style="">
                        
                        <div style="float:left;">
                            <p style="font-size:12px !important">NAMA CUSTOMER</p>
                            <h3 style="font-size:20px !important;margin-top:-10px"><?= $row->NAMA_CUSTOMER; ?></h3>
                            <p style="font-size:12px !important">KODE CUSTOMER</p>
                          <p style="font-size:14px !important; font-weight:bold;"><?= $row->KODE_CUSTOMER;?></p>
                            
                        </div>
                       
                    </div>   
                  </a>
                </li>
              <?php endforeach; ?>
          </ul>
    </div>

 <div data-role="popup" id="tanya_hapus" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                  <div data-role="header" data-theme="a">
                      <h1>Tanya</h1>
                  </div>
                  <div role="main" class="ui-content">
                      <div>
                           <p id="isi_info"></p>
                           
                      </div>
                      <div>
                          <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Cancel</a>

                      </div>
                  </div>
        </div>

    <div data-role="popup" id="tanya_restore" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                  <div data-role="header" data-theme="a">
                      <h1>Tanya</h1>
                  </div>
                  <div role="main" class="ui-content">
                      <div>
                           <p id="id_restore"></p>
                           
                      </div>
                      <div>
                          <a href="" id="btn_restore" onclick="restore()" id="restore" restore_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">Restore</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Cancel</a>

                      </div>
                  </div>
        </div>

   <div data-role="popup" id="tanya_edit" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
                  <div data-role="header" data-theme="a">
                      <h1>TAMBAH</h1>
                  </div>
                  <div role="main" class="ui-content">
                      <div>
                           <p id="isi_info">
                             
                            <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_edit","name"=>"form_edit","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?>  
                                <label  >Nama Customer:</label>
                                <input  type="text" name="customer_edit" id="customer_edit" required="true" value="">
                                <label  >No.KTP:</label>
                                <input  type="text" name="ktp_edit" id="ktp_edit" required="true" value="">
                                <label >No.Telp:</label>
                                <input  type="text" name="telp_edit" id="telp_edit" required="true" value="">
                                <label >Alamat:</label>
                                <input  type="text" name="alamat_edit" id="alamat_edit" required="true" value="">
                                <input  type="hidden" name="kode_edit" id="kode_edit" value="<?= $row->KODE_CUSTOMER; ?>">
                                <?php echo form_close(); ?>
                            </div>
                           </p>
                           
                      </div>
                      <div>
                        <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">SIMPAN PERUBAHAN</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">CANCEL</a>

                      </div>
                  </div>
        </div>


    <div>
      <button onclick="input()">KEMBALI KE DAFTAR</button>
    </div>


    <script type="text/javascript">
       $('#form_edit').submit(function(event){

      if ($('#customer').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>Ciptogudangrabat_pesanan/edit_member_',
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    console.log(res);
                    location.reload()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
    });



    function edit_data(){
      $('#form_edit').submit();
    }



    function input(){
      window.location = "<?php echo home_url() ?>Ciptogudangrabat_pesanan/input_member"
    }


     function swiperightHandler( event ){ 
        $('#btn_delete').attr('hapus_id',$(this).attr('id') );
        document.getElementById('isi_info').innerHTML = 'Data Customer ' + $(this).attr('nama') + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
      }

    function swipeleftHandler( event ){ 
        $('#btn_restore').attr('restore_id',$(this).attr('id') );
        document.getElementById('id_restore').innerHTML = 'Data Customer ' + $(this).attr('nama') + ' akan di Restore?';
        $( "#tanya_restore" ).popup( "open");
     }

     function on_tap(event) {
      $('#tanya_edit').attr('edit_id',$(this).attr('id') );
        
         document.getElementById("customer_edit").value = $(this).attr('nama');
        document.getElementById("telp_edit").value = $(this).attr('telp');
        document.getElementById("ktp_edit").value = $(this).attr('ktp');
        document.getElementById("alamat_edit").value = $(this).attr('alamat');
        document.getElementById("kode_edit").value = $(this).attr('id');
      $( "#tanya_edit" ).popup( "open");
       
  }
  


 
  
      $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( "li" ).on( "swiperight", swiperightHandler );
          $( "li" ).on( "swipeleft", swipeleftHandler );
          $( "li" ).on( "taphold", on_tap ); 
        });

  //     //--------------------- HAPUS -------------------- // 
     
 function hapus() {
      $('#btn_delete').attr('hapus_id',$(this).attr('id') );
     hapus_id = $('#btn_delete').attr('hapus_id');
     //console.log(hapus_id);
     window.location  = '<?php echo home_url()?>Ciptogudangrabat_pesanan/delete_permanen/' + hapus_id; 
  }
   

      function restore() {
      $('#btn_restore').attr('restore_id',$(this).attr('id') );
     restore_id = $('#btn_restore').attr('restore_id');
     //console.log(restore_id);
     window.location  = '<?php echo home_url()?>Ciptogudangrabat_pesanan/restore/' + restore_id; 
  }


    </script>
</body>
<FOOTER>
  <P style="font-size:10px;">
  *Swipe Kanan Untuk Hapus Permanen dan Swipe Kiri Untuk Restore
  <br> *Tekan dan Tahan ntuk Edit
</P>
</FOOTER>
</html>