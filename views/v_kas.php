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
      flex-wrap: nowrap;
    }
  </style>
</head>
<body>
  <?php
  $trading = $this->model->load_trading();
  $this->db = $trading;
  $ds_hasil = $this->db->query("
              SELECT 
              NO_CASH,
              CAST(TANGGAL_CASH AS DATE)TANGGAL_CASH,
              URAIAN,
              SUMBER_DANA,
              PENGGUNA,
              FOTO_KWITANSI,
              USER_INPUT,
              USER_EDIT,
              WAKTU_INPUT,
              WAKTU_EDIT,
              SALDO_AWAL,
              PEMASUKAN,
              PENGELUARAN,
              SALDO_AKHIR
              FROM 
              DT_CASHFLOW
              WHERE COALESCE(BATAL,0)<>1
              ORDER BY NO_CASH DESC;
              ");
  $ds_pegawai = $this->db->query("
              SELECT
              NAMA_LENGKAP
              FROM
              MST_PEGAWAI
              ")
  ?>
  <div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
    <?php
    $this->load->view('v_header');
    ?>
    <div align="center" style="margin-top: -15px" ><h3><b>CASH FLOW</b></h3></div>
    <div>
      <div>
        <?php
              if (empty($this->input->get('cari'))) 
               echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari ...">';
        ?>
      </div>
      <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listCustomer" >
        <?php
        $nomer = 1;
        foreach ($ds_hasil ->result() as $row):
        ?>
        <li class="li_list" style="margin-bottom: 5px; background-color: #2c3e50; " >
          <div class="flex-container">
            <div style="width: 11%" >
              <p  style=" font-size:10px !important; color: white;">No:</p>
              <h3  style=" margin-top: -7px; font-size:12px !important; color: white;"><?= $row->NO_CASH;?></h3>
            </div>
            <div class="flex-container" style="width: 100%">
              <div style="width: 25%">
                <p  style=" font-size:10px !important; color: white;" >Saldo Awal:</p>
                <p  style=" margin-top: -7px; font-size:12px !important; color: orange;" >
                  <?php
                    $awal = $row->SALDO_AWAL;
                    echo number_format($awal, 0);?></p>
              </div>
              <div style="width: 25%">
                <p  style=" font-size:10px !important; color: white;" >Pemasukan:</p>
                <h3  style=" margin-top: -7px; font-size:12px !important; color: orange;" >
                   <?php
                    $pemasukan = $row->PEMASUKAN;
                    echo number_format($pemasukan, 0);?></p>
                </h3>
              </div>
              <div style="width: 25%">
                <p  style=" font-size:10px !important; color: white;" >Pengeluaran:</p>
                <h3  style=" margin-top: -7px; font-size:12px !important; color: orange;" >
                   <?php
                    $pengeluaran = $row->PENGELUARAN;
                    echo number_format($pengeluaran, 0);?></p>
                </h3>
              </div>
              <div style="width: 25%">
                <p  style=" font-size:10px !important; color: white;" >Saldo Akhir:</p>
                <p  style=" margin-top: -7px; font-size:12px !important; color: orange;" >
                   <?php
                    $akhir = $row->SALDO_AKHIR;
                    echo number_format($akhir, 0);?></p>
                </p>
              </div>
              
            </div>
            
            
          </div>
          <div style="background-color: #2c3e50; clear: both; width: 100%;" class="flex-container">
            <div style="width: 50%;">
              
              <div>
                <p  style=" font-size:12px !important; color: white;">User:</p>
                <h3  style=" font-size:25px !important; font-weight:bold; color: orange; margin-top: -5px;"><?= $row->PENGGUNA;?></h3>
              </div>
            </div>
            <div style="width: 50%;">
              <div class="flex-container">
                
                <div>
                  <p  style=" font-size:12px !important; color: white;">Uraian:</p>
              <?php
              $str = $row->URAIAN;
              $isi_uraian = wordwrap($str,23,"<br>\n",TRUE);
              echo "<p style=' margin-top: -7px; font-size:12px !important; color: white;'>$isi_uraian</p>";
              ?>
                </div>
              </div>
            </div>
          </div>
          <div style="height: 1px; background-color: white;"></div>
          <div class="flex-container" style="width: 100%">
            <div style="width: 25%">
              <p  style=" font-size:10px !important; color: white;">Tanggal Cash:</p>
              <h3 style=" margin-top: -7px; font-size:12px !important; color: white;"><?= $row->TANGGAL_CASH;?></h3>
            </div>
            <div style="width: 75%">
              <p  style=" font-size:10px !important; color: white;">Sumber Dana:</p>
              <h3  style=" font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;"><?= $row->SUMBER_DANA;?></h3>
            </div>
          </div>
          <div class="flex-container" style="width: 100%">
            
            <div style="width: 17%">
              
            </div>
            <div style="width: 66%; " align="center" >
              <div class="flex-container" align="center" style="width: 99%">
                <div style="width: 33%;" >
                  <input align="center" type="button" name="edit_klik" id="edit_klik" value="Detil" data-inline="true" data-theme="b" data-mini="true" onclick="click_detil('<?= $row->NO_CASH;?>','<?= $row->TANGGAL_CASH;?>','<?= $row->URAIAN;?>','<?= $row->SUMBER_DANA;?>','<?= $row->PENGGUNA;?>','<?= $row->SALDO_AWAL;?>','<?= $row->PEMASUKAN;?>','<?= $row->PENGELUARAN;?>','<?= $row->SALDO_AKHIR;?>','<?= $row->FOTO_KWITANSI;?>')"   >
                </div>
                <div style="width: 33%; margin-right: -10px; margin-left: -10px">
                  <input align="center" type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" data-theme="e" data-mini="true" onclick="click_edit('<?= $row->NO_CASH;?>','<?= $row->TANGGAL_CASH;?>','<?= $row->URAIAN;?>','<?= $row->SUMBER_DANA;?>','<?= $row->PENGGUNA;?>','<?= $row->SALDO_AWAL;?>','<?= $row->PEMASUKAN;?>','<?= $row->PENGELUARAN;?>','<?= $row->SALDO_AKHIR;?>','<?= $row->FOTO_KWITANSI;?>')"   >
                </div>
                <div style="width: 33%">
                  <input align="center" type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true"data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->NO_CASH;?>','<?= $row->URAIAN;?>','<?= $row->PENGGUNA;?>')" >
                </div>
              </div>
              <div style="width: 17%">
              
            </div>
            </div>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

<div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
  <div style="box-shadow: 1px 2px 3px grey;margin-bottom:20px;margin-left:-45px;background-color: #16a085;position:fixed;bottom:0 !important;width:62px;border-radius: 50%;display: inline-block;height:62px;" onclick="add_data()">
    <table style="margin-top:5px;">
      <tr>
        <td  align='center' style="">
          <div>
            <img id="tambah_data" src="<?php echo asset_url();?>gambar/plus.png" style="width:30px;height:30px; margin-bottom: -10px;"><br>
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
      <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
    </div>
  </div>
</div>
</div>
</div><!-- ---------page utama -->

<div data-role="page" id="page_data" data-transision="slide">
  <?php 
  $this->load->view('v_header');
  ?>
  <div align="center">
    <h3 id="tajuk"><b>TAMBAH DATA CASH FLOW</b></h3>
  </div>
  <div data-role="content" style="padding:5px">
    <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
    <input data-mini="true" type="hidden" name="key" id="key" value="">
    <table width="100%">
      <tr>
        <td width="30%">
          <label>No.Cash:</label>
        </td>
        <td width="70%">
          <label id="kode_add"></label>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td width="30%">
          <label>Tanggal Cash:</label>
        </td>
        <td width="70%">
          <input type="date" name="tanggal_add" id="tanggal_add">
        </td>
      </tr>
      <tr>
        <td width="30%">
          <label>Pengguna:</label>
        </td>
        <td width="70%">
          <select data-mini="true"name="pengguna_add" id="pengguna_add" data-native-menu="false">
            <?php
            $ada_data = 0;
            $nomer = 1;
            foreach ($ds_pegawai ->result() as $pegawai):
            ?>
            {
              <option value="<?= $pegawai->NAMA_LENGKAP; ?>"><?= $pegawai->NAMA_LENGKAP; ?></option>
            }
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width="30%">
          <label>Sumber Dana:</label>
        </td>
        <td width="70%">
          <input type="text" name="sumber_add" id="sumber_add">
        </td>
      </tr> 
      <tr>
        <td width="30%">
          <label>Uraian:</label>
        </td>
        <td width="70%">
          <textarea name="uraian_add" id="uraian_add"></textarea>
        </td>
      </tr>
      <tr>
        <td width="30%">
          <label id="awal_label" style="display: none;">Saldo Awal:</label>
        </td>
        <td width="70%">
          <input type="number" name="awal_add" id="awal_add" style="display: none;">
        </td>
      </tr>
      <tr>
        <td width="30%">
          <label>Pemasukan:</label>
        </td>
        <td width="70%">
          <input type="number" name="pemasukan_add" id="pemasukan_add" >
        </td>
      </tr> 
      <tr>
        <td width="30%">
          <label>Pengeluaran:</label>
        </td>
        <td width="70%">
          <input type="number" name="pengeluaran_add" id="pengeluaran_add">
        </td>
      </tr>
      <tr>
        <td width="30%">
          <label id="akhir_label" style="display: none;">Saldo Akhir:</label>
        </td>
        <td width="70%">
          <input type="number" name="akhir_add" id="akhir_add" style="display: none;">
        </td>
      </tr>
      <tr>
        <td>
        <label>Foto Kwitansi</label>  
        </td>
        <td><input type="file" name="foto_add" id="foto_add"></td>
      </tr>
    </table>
    <?php echo form_close(); ?>
  </div>
  <div align="center">
    <a href="" id="btn_edit" onclick="edit_data()" id="edit" edit_id="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">SIMPAN</a>
    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">CANCEL</a>
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
 function click_detil(id,tanggal,uraian,sumber,pengguna,awal,masuk,keluar,akhir,foto) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("key").value = id;
      document.getElementById("kode_add").innerHTML = id;
      document.getElementById("tanggal_add").value = tanggal;
      document.getElementById("uraian_add").value = uraian;
      document.getElementById("sumber_add").value = sumber;
      $('#pengguna_add').val(pengguna);
      $("#pengguna_add").selectmenu("refresh");
      document.getElementById("awal_add").value = awal;
      document.getElementById("pemasukan_add").value = masuk;
      document.getElementById("pengeluaran_add").value = keluar;
      document.getElementById("akhir_add").value = akhir;
      document.getElementById("foto_add").value = foto;
      document.getElementById("tajuk").innerHTML = 'DETAIL DATA CASH FLOW';
      document.getElementById("btn_edit").style.display = 'none';
      document.getElementById("key").disabled = true;
      document.getElementById("kode_add").disabled = true;
      document.getElementById("tanggal_add").disabled = true;
      document.getElementById("uraian_add").disabled = true;
      document.getElementById("sumber_add").disabled = true;
      document.getElementById("pengguna_add").disabled = true;
      document.getElementById("awal_add").disabled = true;
      document.getElementById("pemasukan_add").disabled = true;
      document.getElementById("pengeluaran_add").disabled = true;
      document.getElementById("akhir_add").disabled = true;
      document.getElementById("foto_add").disabled = true;
      document.getElementById("awal_add").style.display = "block";
      document.getElementById("akhir_add").style.display = "block";
      document.getElementById("awal_label").style.display = "block";
      document.getElementById("akhir_label").style.display = "block";
     
}

 function click_edit(id,tanggal,uraian,sumber,pengguna,awal,masuk,keluar,akhir,foto) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("key").value = id;
      document.getElementById("kode_add").innerHTML = id;
      document.getElementById("tanggal_add").value = tanggal;
      document.getElementById("uraian_add").value = uraian;
      document.getElementById("sumber_add").value = sumber;
      $('#pengguna_add').val(pengguna);
      $("#pengguna_add").selectmenu("refresh");
      document.getElementById("awal_add").value = awal;
      document.getElementById("pemasukan_add").value = masuk;
      document.getElementById("pengeluaran_add").value = keluar;
      document.getElementById("akhir_add").value = akhir;
      document.getElementById("foto_add").value = foto;
      document.getElementById("btn_edit").style.display = 'inline';
       document.getElementById("key").disabled = false;
      document.getElementById("kode_add").disabled = false;
      document.getElementById("tanggal_add").disabled = false;
      document.getElementById("uraian_add").disabled = false;
      document.getElementById("sumber_add").disabled = false;
      document.getElementById("pengguna_add").disabled = false;
      document.getElementById("awal_label").style.display= 'none';
      document.getElementById("awal_add").style.display= 'none';
      document.getElementById("pemasukan_add").disabled = false;
      document.getElementById("pengeluaran_add").disabled = false;
      document.getElementById("akhir_label").style.display= 'none';
      document.getElementById("akhir_add").style.display= 'none';
      document.getElementById("foto_add").disabled = true;
      document.getElementById("tajuk").innerHTML = 'UBAH DATA CASH FLOW';
      status = 'edit';
      
}

function click_hapus(id, uraian, pengguna){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data Cash Flow ' + pengguna + ' ' + uraian + ' akan di hapus ?';
        $( "#tanya_hapus" ).popup( "open");
        document.getElementById("kode_hapus").value = id;
        document.getElementById("kode_hapus").style.display = "none";
}


    function edit_data(){
      $('#form_gudang').submit();

    }
  



//---------------------  klik HAPUS -------------------- // 

$('#form_delete').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }

        showModal();
        $.ajax({
                url:'<?php echo home_url()?>Cash_Flow/delete_kas',
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
                      window.location  = '<?php echo home_url()?>Cash_Flow'; 
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
  document.getElementById("key").value = null;
      document.getElementById("kode_add").innerHTML = '';
      document.getElementById("tanggal_add").value = null;
      $('#pengguna_add').val(null);
      document.getElementById("uraian_add").value = null;
      document.getElementById("sumber_add").value = null;
      document.getElementById("awal_add").value = null;
      document.getElementById("pemasukan_add").value = null;
      document.getElementById("pengeluaran_add").value = null;
      document.getElementById("akhir_add").value = null;
      document.getElementById("foto_add").value = null;
      document.getElementById("btn_edit").style.display = 'inline';
      document.getElementById("key").disabled = false;
      document.getElementById("kode_add").disabled = false;
      document.getElementById("tanggal_add").disabled = false;
      document.getElementById("uraian_add").disabled = false;
      document.getElementById("sumber_add").disabled = false;
      document.getElementById("pengguna_add").disabled = false;
      document.getElementById("awal_label").style.display= 'none';
      document.getElementById("awal_add").style.display= 'none';
      document.getElementById("awal_add").value= null;
      document.getElementById("pemasukan_add").disabled = false;
      document.getElementById("pengeluaran_add").disabled = false;
      document.getElementById("akhir_label").style.display= 'none';
      document.getElementById("akhir_add").style.display= 'none';

      document.getElementById("akhir_add").value= null;
      document.getElementById("foto_add").disabled = true;
      document.getElementById("tajuk").innerHTML = 'TAMBAH DATA CASH FLOW';
    if ($.mobile.activePage.attr( "id" ) == 'page_data')

       $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });
     
    else {
      $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true});
      status  = 'tambah';
    };


      // location.reload();
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>Cash_Flow/save_kas'
        }
        else
        {
          alamat = '<?php echo home_url()?>Cash_Flow/edit_kas'
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
                      window.location  = '<?php echo home_url()?>Cash_Flow'; 
                    } else {
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
       

    if ($.mobile.activePage.attr( "id" ) == 'page_data')
       $.mobile.changePage( "#page_utama", { transition: "slide", changeHash: true });

    else {
      window.location  = '<?php echo home_url()?>MasterData'
    }
};
</script>   
</body>
</html>