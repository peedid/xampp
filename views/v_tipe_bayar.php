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
  .flex-container {
  display: flex;
  width: 100%; 
}

.flex-container > div {
  margin: 10px;
  width: 100%;  
}
</style>
</head>
<body>
	 <?php
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
                      SELECT
                      IIF(COALESCE(A.VISIBLE,0)=0,0,1)VISIBLE,
                      A.KODE_TIPEBAYAR,
                      IIF(COALESCE(A.TUNAI,0)=0,0,1)TUNAI,
                      IIF(COALESCE(A.VIA_BANK,0)=0,0,1)VIA_BANK,
                      IIF(COALESCE(A.CLEARING,0)=0,0,1)CLEARING,
                      IIF(COALESCE(A.USED_TRADING,0)=0,0,1)USED_TRADING,
                      IIF(COALESCE(A.AKUNTANSI_SUMBERDANA,0)=0,0,1)AKUNTANSI_SUMBERDANA,
                      IIF(COALESCE(A.AKUNTANSI_SUMBERDANA_IN,0)=0,0,1)AKUNTANSI_SUMBERDANA_IN,
                      IIF(COALESCE(A.AKUNTANSI_SUMBERDANA_OUT,0)=0,0,1)AKUNTANSI_SUMBERDANA_OUT,
                      A.KODE_COA,
                      B.KETERANGAN
                      FROM MST_TIPE_BAYAR A
                      LEFT JOIN MST_COA B ON B.KODE_COA = A.KODE_COA
               ");
             $ds_coa = $this->db->query("
              SELECT * FROM MST_COA
               ");
             ?>
<div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
	<?php 
         $this->load->view('v_header');
      ?>
      <div data-role="content">
      	<div align="center" style="margin-top: -30px" ><h3><b>DATA TIPE BAYAR</b></h3></div>
      <div>
       <form style=" margin-bottom:-5px">
        <?php
              if (empty($this->input->get('cari'))) 
               echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari Tipe Bayar ...">';
        ?>
       </form>
       <table width="100%" style="height: 50px; " >
         <tr>
             <td>
               <table width="100%" style="height: 50px; " >
                 <tr style="text-align:center;background-color:#2C3E50;color:white;  " >
                  <td align="center" width="25%"  style=" border: 1px solid;border-top-left-radius: 5px; border-bottom-left-radius: 5px; "> 
                    Tipe Bayar
                  </td>
                   <td align="center" width="35%"  style=" border: 1px solid;">
                   Akun
                 </td>
                 <td width="40%" style=" border: 1px solid;border-bottom-right-radius:5px ; border-top-right-radius:5px ">
                   Opsi
                 </td>
                 </tr>
               </table>
             </td>
           </tr>
        <?php 
          $nomer = 1;
          foreach ($ds_hasil ->result() as $row):
        ?>
           <tr data-filter="true" data-inset="true" data-input="#rich-autocomplete-input">
            <td>
             <div class="flex-container" style="width: 100%">
              <div style="width: 25%">
                <?= $row->KODE_TIPEBAYAR; ?>
              </div>
              <div style="width: 35%">
                <?= $row->KETERANGAN; ?>
              </div>
              <div style="width: 40%">
              <table style="width: 100%">
                <tr align="center">
                  
                  <td>
                    <div align="center" style=" background-color: #16a085; width:30px;border-radius: 50%;height:30px;" onclick="click_detil('<?= $row->VISIBLE; ?>','<?= $row->KODE_TIPEBAYAR; ?>','<?= $row->TUNAI; ?>','<?= $row->VIA_BANK; ?>','<?= $row->CLEARING; ?>','<?= $row->USED_TRADING; ?>','<?= $row->AKUNTANSI_SUMBERDANA; ?>','<?= $row->AKUNTANSI_SUMBERDANA_IN; ?>','<?= $row->AKUNTANSI_SUMBERDANA_OUT; ?>','<?= $row->KODE_COA; ?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/cari.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  <td>
                    <div align="center" style=" background-color: orange; width:30px;border-radius: 50%;height:30px;" onclick="click_edit('<?= $row->VISIBLE; ?>','<?= $row->KODE_TIPEBAYAR; ?>','<?= $row->TUNAI; ?>','<?= $row->VIA_BANK; ?>','<?= $row->CLEARING; ?>','<?= $row->USED_TRADING; ?>','<?= $row->AKUNTANSI_SUMBERDANA; ?>','<?= $row->AKUNTANSI_SUMBERDANA_IN; ?>','<?= $row->AKUNTANSI_SUMBERDANA_OUT; ?>','<?= $row->KODE_COA; ?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/ubah.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  <td>
                    <div align="center" style=" background-color: red; width:30px;border-radius: 50%;height:30px;" onclick="click_hapus('<?= $row->KODE_TIPEBAYAR;?>')">
                      <img   id="tambah_data" src="<?php echo asset_url();?>gambar/delete.png" style="width:20px;height:20px; margin-top: 5px;">
                    </div>
                  </td>
                  
                </tr>
              </table>
                
              </div>
             </div><!--  ------------flex -->
             </td>
           </tr>
           <?php endforeach; ?>
       </table>
      </div>
      </div><!-- ----------------akhir content -->


    <div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
               <div style="/*box-shadow: 1px 2px 3px grey;*/margin-bottom:20px;margin-left:-45px;background-color: #16a085;position:fixed;bottom:0 !important;width:62px;border-radius: 50%;display: inline-block;height:62px;" onclick="add_data()">
                   <table style="margin-top:5px;">
                      <tr>
                         <td  align='center' style="">
                            <div>
                                <img id="tambah_data" src="<?php echo asset_url();?>gambar/plus.png" style="width:30px;height:30px"><br>
                                <span style="font-size:10px;color:white;"><b>Tambah</b></span>
                            </div>
                         </td>
                    </tr>
                    </table>
               </div>
    </div>


    <div data-role="popup" id="tanya_hapus" data-theme="a" data-transition="slide" align="center">
                      <div data-role="header" data-theme="b">
                          <h1 id="isi_hapus_label">Tanya Hapus</h1>
                      </div>
                      <div role="main" class="ui-content">
                          <div>
                               <p id="isi_hapus">
                                <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_delete","name"=>"form_delete","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 

                                    <input data-mini="true" type="hidden" name="kode_hapus" id="kode_hapus" value=""> 
                                <?php echo form_close(); ?>

                               </p>
                               <p id="gagal_hapus"></p>
                               
                          </div>
                          <div align="center">
                              <a href="" id="btn_delete" onclick="hapus()" id="delete" hapus_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">DELETE</a>
                              <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" onclick="back()">Cancel</a>

                          </div>
                      </div>
    </div>
     
</div><!-- ---------page utama -->
<div data-role="page" id="page_data" data-transision="slide">
  <?php 
         $this->load->view('v_header');
      ?>
         
        <div align="center">
       <h3 id="tajuk"><b>TAMBAH DATA TIPE BAYAR BARU</b></h3>
        </div>
        <div  style="padding: 10px">
          <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?>
          <input data-mini="true" type="hidden" name="key" id="key" value="">
            <table style="width: 100%">
              <tr>
                <td style="width: 40%">
                  <label  for="visible_add" >Visible:</label>
                  
                </td>
                <td style="width: 60%">
                  <select data-mini="true;" name="visible_add" id="visible_add">
                    <option value="0">TIDAK</option>
                    <option value="1">YA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Kode Tipe Bayar:</label>
                </td>
                <td>
                  <input data-mini="true" type="text" name="kode_add" id="kode_add" value="">
                </td>
              </tr>
              <tr>
                  <td>
                    <label  for="bank_add" >Bukan Bank:</label>
                  </td>
                  <td>
                    <select data-mini="true;" name="tunai_add" id="tunai_add">
                    <option value="0">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                  </td>
                </tr>
              <tr>
                  <td>
                    <label  for="clearing_add" >Clearing:</label>
                  </td>
                  <td>
                    <select data-mini="true;" name="clearing_add" id="clearing_add">
                    <option value="0">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                  </td>
                </tr>
              <tr>
                  <td>
                    <label for="trading_add" >Use Trading:</label>
                  </td>
                  <td>
                    <select data-mini="true;" name="trading_add" id="trading_add">
                      <option value="0">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                  </td>
                </tr>
              <tr>
                  <td>
                    <label  for="sumber_add" >Akutansi Sumber Dana:</label>
                  </td>
                  <td>
                    <select data-mini="true;" name="sumber_add" id="sumber_add">
                    <option value="0">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label  for="s_in_add" >Sumber Dana IN:</label>
                  </td>
                  <td>
                    <select data-mini="true;" name="s_in_add" id="s_in_add">
                    <option value="0">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="s_out_add" >Sumber Dana OUT:</label>
                  </td>
                  <td>
                    <select data-mini="true;" name="s_out_add" id="s_out_add">
                    <option value="0">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                  </td>
                </tr>
              </table>
              <table width="100%">
                <tr>
                  <td style="width: 40%">
                    <label  for="coa_add" >Akun:</label>
                  </td>
                  <td style="width: 100%">
                    <div style="max-width: 200px">
                      <select data-mini="true;" name="coa_add" id="coa_add">
                        <?php 
                        $ada_data = 0;
                        $nomer = 1;
                        foreach ($ds_coa ->result() as $coa):
                          ?>
                          {
                            <option value="<?= $coa->KODE_COA; ?>"><?= $coa->KETERANGAN; ?></option>
                          }
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
              <!-- <div class="flex-container" style="width: 100%">
                  <div style="width: 40%">
                    <div style="width: 100%">
                      
                    </div>
                  </div>
                  <div style="width: 60%">
                    <table style="width: 100%">
                      <tr>
                        <td>
                          
                        </td>
                      </tr>
                    </table>
                  </div>
                 </div> -->
                  
                  
              
              

          <?php echo form_close(); ?>
        </div>

                      <div align="center">
                          <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" onclick="back()">CANCEL</a>
</div>

 <div data-role="popup" id="error_message" data-theme="a" data-transition="slide">
                  <div data-role="header" data-theme="a">
                      <h1>Maaf Proses Gagal</h1>
                  </div>
                  <div role="main" class="ui-content">
                    <div>
                       <p id="isi_errror"></p>
                             
                    </div>
                  <div align="center">
                     <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Cancel</a>

                  </div>
                  </div>
      </div>
  
</div> 
<script type="text/javascript">

 function click_detil(visible,kode,tunai,bank,clearing,trading,sumberdana,s_in,s_out,coa) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
     $('#visible_add').val(visible);
      $("#visible_add").selectmenu("refresh");
      $('#tunai_add').val(tunai);
      $("#tunai_add").selectmenu("refresh");
      $('#clearing_add').val(clearing);
      $("#clearing_add").selectmenu("refresh");
      $('#trading_add').val(trading);
      $("#trading_add").selectmenu("refresh");
      $('#sumber_add').val(sumberdana);
      $("#sumber_add").selectmenu("refresh");
      $('#s_in_add').val(s_in);
      $("#s_in_add").selectmenu("refresh");
      $('#s_out_add').val(s_out);
      $("#s_out_add").selectmenu("refresh");
      document.getElementById("kode_add").value=kode;
      $('#coa_add').val(coa);
      $("#coa_add").selectmenu("refresh");
      document.getElementById("visible_add").disabled = "true";
      document.getElementById("kode_add").disabled = "true";
      document.getElementById("tunai_add").disabled = "true";
      document.getElementById("clearing_add").disabled = "true";
      document.getElementById("trading_add").disabled = "true";
      document.getElementById("sumber_add").disabled = "true";
      document.getElementById("s_in_add").disabled = "true";
      document.getElementById("s_out_add").disabled = "true";
      document.getElementById("coa_add").disabled = "true";
      document.getElementById("tajuk").innerHTML = 'DETIL TIPE BAYAR';


      document.getElementById("btn_edit").style.display= "none";

      
}

 function click_edit(visible,kode,tunai,bank,clearing,trading,sumberdana,s_in,s_out,coa) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("key").value = kode;
      $('#visible_add').val(visible);
      $("#visible_add").selectmenu("refresh");
      $('#tunai_add').val(tunai);
      $("#tunai_add").selectmenu("refresh");
      $('#clearing_add').val(clearing);
      $("#clearing_add").selectmenu("refresh");
      $('#trading_add').val(trading);
      $("#trading_add").selectmenu("refresh");
      $('#sumber_add').val(sumberdana);
      $("#sumber_add").selectmenu("refresh");
      $('#s_in_add').val(s_in);
      $("#s_in_add").selectmenu("refresh");
      $('#s_out_add').val(s_out);
      $("#s_out_add").selectmenu("refresh");
      document.getElementById("kode_add").value=kode;
      $('#coa_add').val(coa);
      $("#coa_add").selectmenu("refresh");
      document.getElementById("tajuk").innerHTML = 'EDIT TIPE BAYAR';
      document.getElementById("visible_add").disabled = false;
      document.getElementById("kode_add").disabled = false;
      document.getElementById("tunai_add").disabled = false;
      document.getElementById("clearing_add").disabled = false;
      document.getElementById("trading_add").disabled = false;
      document.getElementById("sumber_add").disabled = false;
      document.getElementById("s_in_add").disabled = false;
      document.getElementById("s_out_add").disabled = false;
      document.getElementById("coa_add").disabled = false;
      document.getElementById("btn_edit").style.display= "inline";

      status = 'edit';
}

function click_hapus(id){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data Tipe Bayar ' + id + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value = id;
        document.getElementById("kode_hapus").style.display = "none";
}


    function edit_data(){
      $('#form_gudang').submit();

    }
  



  // //     //---------------------  klik HAPUS -------------------- // 

$('#form_delete').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>MasterData/delete_tipe_bayar',
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
                    hasil = JSON.parse(res);
                    if ( hasil.result=='1') {
                      window.location  = '<?php echo home_url()?>MasterData/tipe_bayar'; 
                    } else {
                      console.log(res);
                      document.getElementById('isi_hapus_label').innerHTML = 'GAGAL HAPUS';
                      document.getElementById('isi_hapus').innerHTML = hasil.message;
                      document.getElementById('btn_delete').style.display = "none";
                      document.getElementById('tanya_hapus').style.align = "center";


                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
});


      function hapus(){
      $('#form_delete').submit();
    }

  // ------------------------------------pageadd
function add_data(){
   $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      $('#tunai_add').prop('selectedIndex', 0);
      $("#tunai_add").selectmenu("refresh");
      $('#visible_add').prop('selectedIndex', 0);
      $("#visible_add").selectmenu("refresh");
      $('#bank_add').prop('selectedIndex', 0);
      $("#bank_add").selectmenu("refresh");
      $('#clearing_add').prop('selectedIndex', 0);
      $("#clearing_add").selectmenu("refresh");
      $('#trading_add').prop('selectedIndex', 0);
      $("#trading_add").selectmenu("refresh");
      $('#sumber_add').prop('selectedIndex', 0);
      $("#sumber_add").selectmenu("refresh");
      $('#s_in_add').prop('selectedIndex', 0);
      $("#s_in_add").selectmenu("refresh");
      $('#s_out_add').prop('selectedIndex', 0);
      $("#s_out_add").selectmenu("refresh");
      document.getElementById("kode_add").value=null;
      $('#coa_add').prop('selectedIndex', 0);
      $("#coa_add").selectmenu("refresh");
      document.getElementById("tajuk").innerHTML = 'TAMBAH TIPE BAYAR';
      document.getElementById("visible_add").disabled = false;
      document.getElementById("kode_add").disabled = false;
      document.getElementById("tunai_add").disabled = false;
      document.getElementById("clearing_add").disabled = false;
      document.getElementById("trading_add").disabled = false;
      document.getElementById("sumber_add").disabled = false;
      document.getElementById("s_in_add").disabled = false;
      document.getElementById("s_out_add").disabled = false;
      document.getElementById("coa_add").disabled = false;
      document.getElementById("btn_edit").style.display= "inline";

      status  = 'tambah';
    
      // location.reload()
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_tipe_bayar'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_tipe_bayar'
        }

        showModal();
        $.ajax({
                url:alamat,
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
                    hasil = JSON.parse(res);
                    if ( hasil.result=='1') {
                      window.location  = '<?php echo home_url()?>MasterData/tipe_bayar'; 
                    } else {
                      // console.log(res);
                      document.getElementById('isi_errror').innerHTML = hasil.message;
                      $( "#error_message" ).popup( "open");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideModal();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
});


function tambahdata(){
         $('#form_gudang').submit();                      
      status="tambah";
}

// -------------------------back
function back(){
        $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });
      location.reload()
}
function GoBack(){
        if ($.mobile.activePage.attr( "id" ) == 'page_data') {
      $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });
        }
    else
    window.location = "<?php echo home_url() ?>main";
};
</script>   
</body>
</html>