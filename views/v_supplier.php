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
</head>
<body>
	 <?php
            $trading = $this->model->load_trading();
            $this->db = $trading;
            $ds_hasil = $this->db->query("
               SELECT
               KODE_SUPP,NAMA_SUPP,
               ALAMAT,
               TELP,
               AKUN_HUTANG
               FROM
               MST_SUPPLIER ;
               ");

            $ds_coa = $this->db->query("
               SELECT
               KODE_COA,
               PARENT_COA,
               KETERANGAN
               FROM
               MST_COA ;
                  "); 
             ?>
<div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
	<?php 
         $this->load->view('v_header');
      ?>
      <div data-role="content">
      	<div align="center" style="margin-top: -30px" ><h3><b>DATA SUPPLIER</b></h3></div>
      	<div>
          <?php
              if (empty($this->input->get('cari'))) 
               echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari Supplier ...">';
        ?>
      		<ul class="list" data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer" >
           <?php 
                 $ada_data = 0;
                 $nomer = 1;
                 foreach ($ds_hasil ->result() as $row):
              ?>  

                 <li class="li_list" style="margin-bottom: 5px; background-color: #2c3e50; padding-bottom: 15px; " gudang = "<?= $row->GUDANG; ?>">
                   <div style="background-color: #2c3e50; clear: both;">
                   	<div style="float:left; width: 40%;">
                   		<p  style=" font-size:12px !important; color: white;" >Kode Supplier:</p>
                         <p  style="font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;" ><?= $row->KODE_SUPP;?></p>
                   		<p style="font-size:12px !important;color: white; ">No. Telpon:</p>
                   		<p style="font-size:12px !important;margin-top:-5px;color: white;"><?= $row->TELP; ?></p>
               		</div>
               		<div class="ui-li-aside " style="margin-right: -55px; margin-top:  -10px;" >
                         <p style=" font-size:12px !important; color: white;" align="center">Nama Supplier :</p>
                   		<h3 style="font-size:14px !important;color: white; margin-top: -7px;" align="center"><?= $row->NAMA_SUPP ?></h3>      
                            <input type="button" name="detil_klik" id="detil_klik" value="detil" data-inline="true" style="float: right;" data-theme="b" data-mini="true"
                            onclick="click_detil('<?= $row->KODE_SUPP;?>','<?= $row->NAMA_SUPP;?>','<?= $row->TELP;?>','<?= $row->ALAMAT;?>','<?= $row->AKUN_HUTANG; ?>')"   >
                            <input type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" style="float: right;" data-theme="e" data-mini="true"
                            onclick="click_edit('<?= $row->KODE_SUPP;?>','<?= $row->NAMA_SUPP;?>','<?= $row->TELP;?>','<?= $row->ALAMAT;?>','<?= $row->AKUN_HUTANG; ?>')"   >
                            <input type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true" style="float: right;" data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->KODE_SUPP; ?>','<?= $row->NAMA_SUPP; ?>')" >
                              </div>
             </div>
                 <!--  </a> -->
                </li>
              <?php endforeach; ?>
          </ul>
      	</div>
      </div><!-- ----------------akhir content -->


    <div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
               <div style="box-shadow: 1px 2px 3px grey; margin-bottom:20px;margin-left:-45px;background-color: #16a085;position:fixed;bottom:0 !important;width:62px;border-radius: 50%;display: inline-block;height:62px;" onclick="add_data()">
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

                                    <input data-mini="true" type="text" name="kode_hapus" id="kode_hapus" value=""> 
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
    <div data-role='content'>     
        <div align="center">
       <h3 id="tajuk"><b>TAMBAH DATA SUPPLIER BARU</b></h3>
        </div>
        <div>
                              <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                                <input data-mini="true" type="hidden" name="key" id="key" value="">
                                <label id="kode_add_label" >Kode Supplier:</label>
                                <input data-mini="true" type="text" name="kode_add" id="kode_add" value="">
                                <label  >Nama Supplier:</label>
                                <input data-mini="true" type="text" name="supplier_add" id="supplier_add" value="">
                                <label  >No. Telpon:</label>
                                <input data-mini="true" type="text" name="telp_add" id="telp_add" value="">
                                <label  >Alamat:</label>
                                <input data-mini="true" type="text" name="alamat_add" id="alamat_add" value="">
                                <label  for="coa_add" >Akun Hutang:</label>
                                  <select name="coa_add" id="coa_add">
                                    <?php 
                                        $ada_data = 0;
                                        $nomer = 1;
                                        foreach ($ds_coa ->result() as $coa):
                                        ?>
                                        while ($coas = $coa->fetch_assocc()){
                                        <option value="<?= $coa->KODE_COA; ?>"><?= $coa->KETERANGAN; ?></option>
                                        }
                                        <?php endforeach; ?>

                                  </select>
                                
                                <?php echo form_close(); ?>
        </div>

                      <div align="center">
                          <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
                          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" onclick="back()">CANCEL</a>
</div>
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
	
 function click_detil(kode,nama,telp,alamat,coa_kode) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("supplier_add").value = nama;
      document.getElementById("kode_add").value = kode;
      
      document.getElementById("alamat_add").value = alamat;
      document.getElementById("telp_add").value = telp;
     console.log(coa_kode)
       $('#coa_add').val(coa_kode);
      $("#coa_add").selectmenu("refresh");
      document.getElementById("kode_add").disabled=true;
      document.getElementById("tajuk").innerHTML = 'DETAIL DATA SUPPLIER';
      document.getElementById("btn_edit").style.display = 'none';

      document.getElementById("alamat_add").disabled = true;
      document.getElementById("telp_add").disabled = true;
      document.getElementById("supplier_add").disabled = true;
      document.getElementById("coa_add").disabled = true;
     
}

 function click_edit(kode,nama,telp,alamat,coa_kode) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("supplier_add").value = nama;
      document.getElementById("key").value = kode;
      document.getElementById("kode_add").value = kode;
      document.getElementById("alamat_add").value = alamat;
      document.getElementById("telp_add").value = telp;
     console.log(coa_kode)
       $('#coa_add').val(coa_kode);
      $("#coa_add").selectmenu("refresh");
      document.getElementById("tajuk").innerHTML = 'UBAH DATA SUPPLIER';
      document.getElementById("kode_add").disabled=false;
      document.getElementById("alamat_add").disabled = false;
      document.getElementById("telp_add").disabled = false;
      document.getElementById("supplier_add").disabled = false;
      document.getElementById("coa_add").disabled = false;
      document.getElementById("btn_edit").style.display = 'inline';
      status = 'edit';
      
}

function click_hapus(id, gudang){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data supplier ' + gudang + ' akan di hapus ?';
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
                url:'<?php echo home_url()?>MasterData/delete_supplier',
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
                      window.location  = '<?php echo home_url()?>MasterData/supplier'; 
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
    $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true});
    document.getElementById("tajuk").innerHTML = 'TAMBAH DATA SUPPLIER';
    document.getElementById("btn_edit").style.display = 'inline';
    document.getElementById("key").value=null;
    $("#coa_add").prop('selectedIndex', 0);
    $("#coa_add").selectmenu("refresh");
     document.getElementById("supplier_add").value = null;
      document.getElementById("kode_add").value = null;
      document.getElementById("alamat_add").value = null;
      document.getElementById("telp_add").value = null;
      document.getElementById("kode_add").disabled=false;
      document.getElementById("alamat_add").disabled = false;
      document.getElementById("telp_add").disabled = false;
      document.getElementById("supplier_add").disabled = false;
      document.getElementById("coa_add").disabled = false;
      
      status = 'tambah';
      // location.reload() 
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_supplier'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_supplier'
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
                      window.location  = '<?php echo home_url()?>MasterData/supplier'; 
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
function GoBack() {
    if ($.mobile.activePage.attr( "id" ) == 'page_data') {
      $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });
        }
    else
    window.location = "<?php echo home_url() ?>main";
    
    
  }
</script>   
</body>
</html>