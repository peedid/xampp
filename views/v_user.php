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
              A.KODE_OPERATOR,
              IIF (COALESCE(A.KODE_GUDANG,'')= '', 'ALL',A.KODE_GUDANG)KODE_GUDANG,
              A.NAMA,
              A.USERNAME,
              A.PASS,
              A.CONFIRM,
              A.KODE_CEPAT,
              A.KODE_OPERATOR_LEVEL,
              COALESCE(A.OPERATOR_POS,0)OPERATOR_POS,
              COALESCE(A.PENJUALAN,0)PENJUALAN,
              COALESCE(A.RETUR_PENJUALAN,0)RETUR_PENJUALAN,
              COALESCE(A.BARANG_KELUAR,0)BARANG_KELUAR,
              COALESCE(A.PEMBELIAN,0)PEMBELIAN,
              COALESCE(A.RETUR_PEMBELIAN,0)RETUR_PEMBELIAN,
              COALESCE(A.BARANG_RUSAK,0)BARANG_RUSAK,
              COALESCE(A.KARTUSTOCK,0)KARTUSTOCK,
              COALESCE(A.TRADING_BARANGBARU,0)TRADING_BARANGBARU,
              COALESCE(A.ORDER_CUSTOMER,0)ORDER_CUSTOMER,
              COALESCE(A.SURAT_JALAN_BYFAKTUR,0)SURAT_JALAN_BYFAKTUR,
              COALESCE(A.SURAT_JALAN_BYORDERFAKTUR,0)SURAT_JALAN_BYORDERFAKTUR,
              COALESCE(A.GANTI_TINGKATAN_HARGA,0)GANTI_TINGKATAN_HARGA,
              COALESCE(A.BATAL_DOKUMEN,0)BATAL_DOKUMEN,
              COALESCE(A.RUBAH_TANGGAL,0)RUBAH_TANGGAL,
              COALESCE(A.RUBAH_HARGA_JASA,0)RUBAH_HARGA_JASA,
              COALESCE(A.RUBAH_HARGA_NONJASA,0)RUBAH_HARGA_NONJASA,
              COALESCE(A.TINGKATAN_HARGA_OTOMATIS,0)TINGKATAN_HARGA_OTOMATIS,
              COALESCE(A.HARGA_POKOK,0)HARGA_POKOK,
              IIF (COALESCE(a.resep,0)=0,0,1)RESEP,
              COALESCE(a.aktif,0)AKTIF
              FROM MST_OPERATOR A
              ORDER BY A.NAMA;
               ");

            $ds_level = $this->db->query("
               SELECT
               *
               FROM
               MST_OPERATOR_LEVEL ;
                  "); 
            $ds_gudang = $this->db->query("
               SELECT
               KODE_GUDANG,
               GUDANG
               FROM
               MST_GUDANG ;
                  "); 
  ?>
<div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
	<?php
  $this->load->view('v_header');
  ?>
  <div data-role="content">
    <div align="center" style="margin-top: -30px" ><h3><b>DATA USER</b></h3></div>
    <div>
      <?php
      if (empty($this->input->get('cari')))
        echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari user ...">';
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
              <p style="font-size:12px !important;color: white; ">Username:</p>
              <p style="font-size:12px !important;margin-top:-5px;color: white;"><?= $row->USERNAME; ?></p>
              <p  style=" font-size:12px !important; color: white;" >Level User:</p>
              <p  style="font-size:12px !important; font-weight:bold; color: white; margin-top: -5px;" ><?= $row->KODE_OPERATOR_LEVEL;?></p>
            </div>
            <div class="ui-li-aside " style="margin-right: -55px; margin-top:  -10px;" >
              <p style=" font-size:12px !important; color: white;" align="center">Nama:</p>
              <h3 style="font-size:14px !important;color: white; margin-top: -7px;" align="center"><?= $row->NAMA ?></h3>
              <input type="button" name="detil_klik" id="detil_klik" value="detil" data-inline="true" style="float: right;" data-theme="b" data-mini="true" onclick="click_detil('<?= $row->KODE_OPERATOR;?>','<?= $row->NAMA;?>','<?= $row->KODE_OPERATOR_LEVEL;?>','<?= $row->USERNAME;?>','<?= $row->PASS;?>','<?= $row->CONFIRM;?>','<?= $row->KODE_CEPAT;?>','<?= $row->KODE_GUDANG;?>','<?= $row->OPERATOR_POS;?>','<?= $row->PENJUALAN;?>','<?= $row->RETUR_PENJUALAN;?>','<?= $row->BARANG_KELUAR;?>','<?= $row->PEMBELIAN;?>','<?= $row->RETUR_PEMBELIAN;?>','<?= $row->BARANG_RUSAK;?>','<?= $row->KARTUSTOCK;?>','<?= $row->TRADING_BARANGBARU;?>','<?= $row->ORDER_CUSTOMER;?>','<?= $row->SURAT_JALAN_BYFAKTUR;?>','<?= $row->SURAT_JALAN_BYORDERFAKTUR;?>','<?= $row->GANTI_TINGKATAN_HARGA;?>','<?= $row->BATAL_DOKUMEN;?>','<?= $row->RUBAH_TANGGAL;?>','<?= $row->RUBAH_HARGA_JASA;?>','<?= $row->RUBAH_HARGA_NONJASA;?>','<?= $row->TINGKATAN_HARGA_OTOMATIS;?>','<?= $row->HARGA_POKOK;?>','<?= $row->RESEP;?>','<?= $row->AKTIF;?>')"   >
              <input type="button" name="edit_klik" id="edit_klik" value="Edit" data-inline="true" style="float: right;" data-theme="e" data-mini="true"onclick="click_edit('<?= $row->KODE_OPERATOR;?>','<?= $row->NAMA;?>','<?= $row->KODE_OPERATOR_LEVEL;?>','<?= $row->USERNAME;?>','<?= $row->PASS;?>','<?= $row->CONFIRM;?>','<?= $row->KODE_CEPAT;?>','<?= $row->KODE_GUDANG;?>','<?= $row->OPERATOR_POS;?>','<?= $row->PENJUALAN;?>','<?= $row->RETUR_PENJUALAN;?>','<?= $row->BARANG_KELUAR;?>','<?= $row->PEMBELIAN;?>','<?= $row->RETUR_PEMBELIAN;?>','<?= $row->BARANG_RUSAK;?>','<?= $row->KARTUSTOCK;?>','<?= $row->TRADING_BARANGBARU;?>','<?= $row->ORDER_CUSTOMER;?>','<?= $row->SURAT_JALAN_BYFAKTUR;?>','<?= $row->SURAT_JALAN_BYORDERFAKTUR;?>','<?= $row->GANTI_TINGKATAN_HARGA;?>','<?= $row->BATAL_DOKUMEN;?>','<?= $row->RUBAH_TANGGAL;?>','<?= $row->RUBAH_HARGA_JASA;?>','<?= $row->RUBAH_HARGA_NONJASA;?>','<?= $row->TINGKATAN_HARGA_OTOMATIS;?>','<?= $row->HARGA_POKOK;?>','<?= $row->RESEP;?>','<?= $row->AKTIF;?>')"   >
              <input type="button" name="hapus_klik" id="hapus_klik" value="Hapus" data-inline="true" style="float: right;" data-theme="d" data-mini="true" onclick="click_hapus('<?= $row->KODE_OPERATOR;?>','<?= $row->NAMA;?>')" >
            </div>
          </div>
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
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
      </div>
    </div>
  </div>    
</div><!-- ---------page utama -->

<div data-role="page" id="page_data" data-transision="slide">
  <?php 
  $this->load->view('v_header');
  ?>
  <div align="center">
    <h3 id="tajuk"><b>TAMBAH DATA USER BARU</b></h3>
  </div>
  <div data-role="content" style="padding: 5px;">
    <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_gudang","name"=>"form_gudang","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?>
    <input data-mini="true" type="hidden" name="key" id="key" value="">
    <table>
      <tr>
        <td>
          <label  for="aktif_add" >Aktif:</label>
        </td>
        <td>
          <select data-mini="true" name="aktif_add" id="aktif_add">
              <option value=0>Tidak</option>
              <option value=1>Ya</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="40%">
          <label >Nama Lengkap:</label>
        </td>
        <td width="60%">
          <input data-mini="true" type="text" name="nama_add" id="nama_add" value="">
        </td>
      </tr>
      <tr>
        <td>
          <label  for="level_add" >Level:</label>
        </td>
        <td>
          <select data-mini="true" name="level_add" id="level_add">
            <?php
            $ada_data = 0;
            $nomer = 1;
            foreach ($ds_level ->result() as $level):
            ?>
            {
              <option value="<?= $level->KODE_OPERATOR_LEVEL; ?>"><?= $level->OPERATOR_LEVEL; ?></option>
            }
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width="40%">
          <label >User Name:</label>
        </td>
        <td width="60%">
          <input data-mini="true" type="text" name="username_add" id="username_add" value="">
        </td>
      </tr>
      <tr>
        <td width="40%">
          <label >Password:</label>
        </td>
        <td width="60%">
          <input data-mini="true" type="Password" name="password_add" id="password_add" value="">
        </td>
      </tr>
      <tr>
        <td width="40%">
          <label >Confirm Password:</label>
        </td>
        <td width="60%">
          <input data-mini="true" type="Password" name="password2_add" id="password2_add" value="">
        </td>
      </tr>
      <tr>
        <td>
          <label  for="gudang_add" >Gudang:</label>
        </td>
        <td>
          <select data-mini="true" name="gudang_add" id="gudang_add">
            <option value="ALL">TIDAK ADA</option>
            <?php
            $ada_data = 0;
            $nomer = 1;
            foreach ($ds_gudang ->result() as $gudang):
            ?>
            {
              <option value="<?= $gudang->KODE_GUDANG; ?>"><?= $gudang->GUDANG; ?></option>
            }
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width="40%">
          <label >Quick Kode:</label>
        </td>
        <td width="60%">
          <input data-mini="true" type="Password" name="quick_kode_add" id="quick_kode_add" value="">
        </td>
      </tr>
    </table>
    <p align="center"> ------------------------------------------------------------ </p>
    <h3 align="center">AKSES USER</h3>
    <table width="100%">
      <tr>
        <td style="width: 50%">
          <label for="autokasir_add" >Main Menu -> Kasir:</label>
        </td>
        <td style="width: 50%">
          <label for="penjualan_add">Penjualan:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="autokasir_add" name="autokasir_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="penjualan_add" name="penjualan_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="retur_penjualan_add" >Retur Penjualan:</label>
        </td>
        <td style="width: 50%">
          <label for="mutasi_add">Mutasi Antar Gudang:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="retur_penjualan_add" name="retur_penjualan_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="mutasi_add" name="mutasi_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="pembelian_add" >Pembelian:</label>
        </td>
        <td style="width: 50%">
          <label for="retur_pembelian_add">Retur Pembelian:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="pembelian_add" name="pembelian_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="retur_pembelian_add" name="retur_pembelian_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="barang_rusak_add" >Barang Rusak:</label>
        </td>
        <td style="width: 50%">
          <label for="kartu_stock_add">Kartu Stock:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="barang_rusak_add" name="barang_rusak_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="kartu_stock_add" name="kartu_stock_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="input_add" >Input Data Barang:</label>
        </td>
        <td style="width: 50%">
          <label for="order_customer_add">Order Customer:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="input_add" name="input_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="order_customer_add" name="order_customer_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="sj_faktur_add" >Surat Jalan By Faktur:</label>
        </td>
        <td style="width: 50%">
          <label for="sj_order_add">Surat Jalan By Order Faktur:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="sj_faktur_add" name="sj_faktur_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="sj_order_add" name="sj_order_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="ganti_tingkatan_add" >Ganti Tingkatan Harga:</label>
        </td>
        <td style="width: 50%">
          <label for="batal_dokumen_add">Batal Dokumen:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="ganti_tingkatan_add" name="ganti_tingkatan_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="batal_dokumen_add" name="batal_dokumen_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="rubah_tanggal_add" >Rubah Tanggal Transaki:</label>
        </td>
        <td style="width: 50%">
        <label for="rubah_harga_jasa_add">Rubah Harga Item Jasa:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="rubah_tanggal_add" name="rubah_tanggal_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="rubah_harga_jasa_add" name="rubah_harga_jasa_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="rubah_harga_non_jasa_add">Rubah Harga Item Non Jasa:</label>
        </td>
        <td style="width: 50%">
          <label for="tingkatan_harga_otomastis_add">Tingkatan Harga Otomatis Window:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="rubah_harga_non_jasa_add" name="rubah_harga_non_jasa_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="tingkatan_harga_otomastis_add" name="tingkatan_harga_otomastis_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <label for="tampil_harga_pokok_add">Tampil kolom Harga Pokok:</label>
        </td>
        <td style="width: 50%">
          <label for="resep_dokter_add">Resep Dokter:</label>
        </td>
      </tr>
      <tr>
        <td style="width: 50%">
          <select data-mini="true" id="tampil_harga_pokok_add" name="tampil_harga_pokok_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
        <td style="width: 50%">
          <select data-mini="true" id="resep_dokter_add" name="resep_dokter_add">
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          </select>
        </td>
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
	
 function click_detil(key,nama,level,username,password,password2,quick_kode,gudang,autokasir,penjualan,retur_penjualan,mutasi,pembelian,retur_pembelian,barang_rusak,kartu_stock,input,order_customer,sj_faktur,sj_order,ganti_tingkatan,batal_dokumen,rubah_tanggal,rubah_harga_jasa,rubah_harga_non_jasa,tingkatan_harga_otomastis,tampil_harga_pokok,resep_dokter,aktif) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("key").value= key;
      document.getElementById("nama_add").value= nama;
      $('#aktif_add').val(aktif);
      $("#aktif_add").selectmenu("refresh");
       $('#level_add').val(level);
      $("#level_add").selectmenu("refresh");
      document.getElementById("username_add").value=username;
      document.getElementById("password_add").value= password;
      document.getElementById("password2_add").value= password2;
      document.getElementById("quick_kode_add").value= quick_kode;
      $('#gudang_add').val(gudang);
      $("#gudang_add").selectmenu("refresh");
      $('#autokasir_add').val(autokasir);
      $("#autokasir_add").selectmenu("refresh");
      $('#penjualan_add').val(penjualan);
      $("#penjualan_add").selectmenu("refresh");
      $('#retur_penjualan_add').val(retur_penjualan);
      $("#retur_penjualan_add").selectmenu("refresh");
      $('#mutasi_add').val(mutasi);
      $("#mutasi_add").selectmenu("refresh");
      $('#pembelian_add').val(pembelian);
      $("#pembelian_add").selectmenu("refresh");
      $('#retur_pembelian_add').val(retur_pembelian);
      $("#retur_pembelian_add").selectmenu("refresh");
      $('#barang_rusak_add').val(barang_rusak);
      $("#barang_rusak_add").selectmenu("refresh");
      $('#kartu_stock_add').val(kartu_stock);
      $("#kartu_stock_add").selectmenu("refresh");
      $('#input_add').val(input);
      $("#input_add").selectmenu("refresh");
      $('#order_customer_add').val(order_customer);
      $("#order_customer_add").selectmenu("refresh");
      $('#sj_faktur_add').val(sj_faktur);
      $("#sj_faktur_add").selectmenu("refresh");
      $('#sj_order_add').val(sj_order);
      $("#sj_order_add").selectmenu("refresh");
      $('#ganti_tingkatan_add').val(ganti_tingkatan);
      $("#ganti_tingkatan_add").selectmenu("refresh");
      $('#batal_dokumen_add').val(batal_dokumen);
      $("#batal_dokumen_add").selectmenu("refresh");
      $('#rubah_tanggal_add').val(rubah_tanggal);
      $("#rubah_tanggal_add").selectmenu("refresh");
      $('#rubah_harga_jasa_add').val(rubah_harga_jasa);
      $("#rubah_harga_jasa_add").selectmenu("refresh");
      $('#rubah_harga_non_jasa_add').val(rubah_harga_non_jasa);
      $("#rubah_harga_non_jasa_add").selectmenu("refresh");
      $('#tingkatan_harga_otomastis_add').val(tingkatan_harga_otomastis);
      $("#tingkatan_harga_otomastis_add").selectmenu("refresh");
      $('#tampil_harga_pokok_add').val(tampil_harga_pokok);
      $("#tampil_harga_pokok_add").selectmenu("refresh");
      $('#resep_dokter_add').val(resep_dokter)
      $("#resep_dokter_add").selectmenu("refresh");
      document.getElementById("aktif_add").disabled=true;
      document.getElementById("nama_add").disabled=true;
      document.getElementById("level_add").disabled=true;
      document.getElementById("username_add").disabled=true;
      document.getElementById("password_add").disabled=true;
      document.getElementById("password2_add").disabled=true;
      document.getElementById("quick_kode_add").disabled=true;
      document.getElementById("gudang_add").disabled=true;
      document.getElementById("autokasir_add").disabled=true;
      document.getElementById("penjualan_add").disabled=true;
      document.getElementById("retur_penjualan_add").disabled=true;
      document.getElementById("mutasi_add").disabled=true;
      document.getElementById("pembelian_add").disabled=true;
      document.getElementById("retur_pembelian_add").disabled=true;
      document.getElementById("barang_rusak_add").disabled=true;
      document.getElementById("kartu_stock_add").disabled=true;
      document.getElementById("input_add").disabled=true;
      document.getElementById("order_customer_add").disabled=true;
      document.getElementById("sj_faktur_add").disabled=true;
      document.getElementById("sj_order_add").disabled=true;
      document.getElementById("ganti_tingkatan_add").disabled=true;
      document.getElementById("batal_dokumen_add").disabled=true;
      document.getElementById("rubah_tanggal_add").disabled=true;
      document.getElementById("rubah_harga_jasa_add").disabled=true;
      document.getElementById("rubah_harga_non_jasa_add").disabled=true;
      document.getElementById("tingkatan_harga_otomastis_add").disabled=true;
      document.getElementById("tampil_harga_pokok_add").disabled=true;
      document.getElementById("resep_dokter_add").disabled=true;
      document.getElementById("btn_edit").style.display="none";      
      document.getElementById("tajuk").innerHTML = 'DETAIL DATA USER';
         console.log(resep_dokter,aktif)
}

 function click_edit(key,nama,level,username,password,password2,quick_kode,gudang,autokasir,penjualan,retur_penjualan,mutasi,pembelian,retur_pembelian,barang_rusak,kartu_stock,input,order_customer,sj_faktur,sj_order,ganti_tingkatan,batal_dokumen,rubah_tanggal,rubah_harga_jasa,rubah_harga_non_jasa,tingkatan_harga_otomastis,tampil_harga_pokok,resep_dokter,aktif) {
  $.mobile.changePage( "#page_data", { transition: "slide", changeHash: true });
      document.getElementById("key").value= key;
      document.getElementById("nama_add").value= nama;
      $('#aktif_add').val(aktif);
      $("#aktif_add").selectmenu("refresh");
       $('#level_add').val(level);
      $("#level_add").selectmenu("refresh");
      document.getElementById("username_add").value=username;
      document.getElementById("password_add").value= password;
      document.getElementById("password2_add").value= password2;
      document.getElementById("quick_kode_add").value= quick_kode;
      $('#gudang_add').val(gudang);
      $("#gudang_add").selectmenu("refresh");
      $('#autokasir_add').val(autokasir);
      $("#autokasir_add").selectmenu("refresh");
      $('#penjualan_add').val(penjualan);
      $("#penjualan_add").selectmenu("refresh");
      $('#retur_penjualan_add').val(retur_penjualan);
      $("#retur_penjualan_add").selectmenu("refresh");
      $('#mutasi_add').val(mutasi);
      $("#mutasi_add").selectmenu("refresh");
      $('#pembelian_add').val(pembelian);
      $("#pembelian_add").selectmenu("refresh");
      $('#retur_pembelian_add').val(retur_pembelian);
      $("#retur_pembelian_add").selectmenu("refresh");
      $('#barang_rusak_add').val(barang_rusak);
      $("#barang_rusak_add").selectmenu("refresh");
      $('#kartu_stock_add').val(kartu_stock);
      $("#kartu_stock_add").selectmenu("refresh");
      $('#input_add').val(input);
      $("#input_add").selectmenu("refresh");
      $('#order_customer_add').val(order_customer);
      $("#order_customer_add").selectmenu("refresh");
      $('#sj_faktur_add').val(sj_faktur);
      $("#sj_faktur_add").selectmenu("refresh");
      $('#sj_order_add').val(sj_order);
      $("#sj_order_add").selectmenu("refresh");
      $('#ganti_tingkatan_add').val(ganti_tingkatan);
      $("#ganti_tingkatan_add").selectmenu("refresh");
      $('#batal_dokumen_add').val(batal_dokumen);
      $("#batal_dokumen_add").selectmenu("refresh");
      $('#rubah_tanggal_add').val(rubah_tanggal);
      $("#rubah_tanggal_add").selectmenu("refresh");
      $('#rubah_harga_jasa_add').val(rubah_harga_jasa);
      $("#rubah_harga_jasa_add").selectmenu("refresh");
      $('#rubah_harga_non_jasa_add').val(rubah_harga_non_jasa);
      $("#rubah_harga_non_jasa_add").selectmenu("refresh");
      $('#tingkatan_harga_otomastis_add').val(tingkatan_harga_otomastis);
      $("#tingkatan_harga_otomastis_add").selectmenu("refresh");
      $('#tampil_harga_pokok_add').val(tampil_harga_pokok);
      $("#tampil_harga_pokok_add").selectmenu("refresh");
      $('#resep_dokter_add').val(resep_dokter);
      $("#resep_dokter_add").selectmenu("refresh");
      document.getElementById("aktif_add").disabled=false;
      document.getElementById("nama_add").disabled=false;
      document.getElementById("level_add").disabled=false;
      document.getElementById("username_add").disabled=false;
      document.getElementById("password_add").disabled=false;
      document.getElementById("password2_add").disabled=false;
      document.getElementById("quick_kode_add").disabled=false;
      document.getElementById("gudang_add").disabled=false;
      document.getElementById("autokasir_add").disabled=false;
      document.getElementById("penjualan_add").disabled=false;
      document.getElementById("retur_penjualan_add").disabled=false;
      document.getElementById("mutasi_add").disabled=false;
      document.getElementById("pembelian_add").disabled=false;
      document.getElementById("retur_pembelian_add").disabled=false;
      document.getElementById("barang_rusak_add").disabled=false;
      document.getElementById("kartu_stock_add").disabled=false;
      document.getElementById("input_add").disabled=false;
      document.getElementById("order_customer_add").disabled=false;
      document.getElementById("sj_faktur_add").disabled=false;
      document.getElementById("sj_order_add").disabled=false;
      document.getElementById("ganti_tingkatan_add").disabled=false;
      document.getElementById("batal_dokumen_add").disabled=false;
      document.getElementById("rubah_tanggal_add").disabled=false;
      document.getElementById("rubah_harga_jasa_add").disabled=false;
      document.getElementById("rubah_harga_non_jasa_add").disabled=false;
      document.getElementById("tingkatan_harga_otomastis_add").disabled=false;
      document.getElementById("tampil_harga_pokok_add").disabled=false;
      document.getElementById("resep_dokter_add").disabled=false;
      document.getElementById("btn_edit").style.display="inline";      
      document.getElementById("tajuk").innerHTML = 'UBAH DATA USER';
      status = 'edit';
      console.log(resep_dokter,aktif)
}

function click_hapus(id, gudang){ 
        $('#btn_delete').attr('hapus_id',id );
        document.getElementById('isi_hapus').innerHTML = 'Data User ' + gudang + ' akan di hapus ?';
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
                url:'<?php echo home_url()?>MasterData/delete_user',
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
                      window.location  = '<?php echo home_url()?>MasterData/user'; 
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
    document.getElementById("tajuk").innerHTML='TAMBAH DATA USER BARU';
    document.getElementById("key").value= null;
    document.getElementById("nama_add").value= null;
    $('#level_add').prop('selectedIndex',0);
      document.getElementById("username_add").value=null;
      document.getElementById("password_add").value= null;
      document.getElementById("password2_add").value= null;
      document.getElementById("quick_kode_add").value= null;
      $('#gudang_add').prop('selectedIndex', 0);
      $('#aktif_add').prop('selectedIndex',1);
       $('#autokasir_add').prop('selectedIndex', 0);
      $('#penjualan_add').prop('selectedIndex', 0);
      $('#retur_penjualan_add').prop('selectedIndex', 0);
      $('#mutasi_add').prop('selectedIndex', 0);
      $('#pembelian_add').prop('selectedIndex', 0);
      $('#retur_pembelian_add').prop('selectedIndex', 0);
      $('#barang_rusak_add').prop('selectedIndex', 0);
      $('#kartu_stock_add').prop('selectedIndex', 0);
      $('#input_add').prop('selectedIndex', 0);
      $('#order_customer_add').prop('selectedIndex', 0);
      $('#sj_faktur_add').prop('selectedIndex', 0);
      $('#sj_order_add').prop('selectedIndex', 0);
      $('#ganti_tingkatan_add').prop('selectedIndex', 0);
      $('#batal_dokumen_add').prop('selectedIndex', 0);
      $('#rubah_tanggal_add').prop('selectedIndex', 0);
      $('#rubah_harga_jasa_add').prop('selectedIndex', 0);
      $('#rubah_harga_non_jasa_add').prop('selectedIndex', 0);
      $('#tingkatan_harga_otomastis_add').prop('selectedIndex', 0);
      $('#tampil_harga_pokok_add').prop('selectedIndex', 0);
      $('#resep_dokter_add').prop('selectedIndex', 0);
      document.getElementById("aktif_add").disabled=false;
      document.getElementById("level_add").disabled=false;
      document.getElementById("nama_add").disabled=false;
      document.getElementById("level_add").disabled=false;
      document.getElementById("username_add").disabled=false;
      document.getElementById("password_add").disabled=false;
      document.getElementById("password2_add").disabled=false;
      document.getElementById("quick_kode_add").disabled=false;
      document.getElementById("gudang_add").disabled=false;
      document.getElementById("autokasir_add").disabled=false;
      document.getElementById("penjualan_add").disabled=false;
      document.getElementById("retur_penjualan_add").disabled=false;
      document.getElementById("mutasi_add").disabled=false;
      document.getElementById("pembelian_add").disabled=false;
      document.getElementById("retur_pembelian_add").disabled=false;
      document.getElementById("barang_rusak_add").disabled=false;
      document.getElementById("kartu_stock_add").disabled=false;
      document.getElementById("input_add").disabled=false;
      document.getElementById("order_customer_add").disabled=false;
      document.getElementById("sj_faktur_add").disabled=false;
      document.getElementById("sj_order_add").disabled=false;
      document.getElementById("ganti_tingkatan_add").disabled=false;
      document.getElementById("batal_dokumen_add").disabled=false;
      document.getElementById("rubah_tanggal_add").disabled=false;
      document.getElementById("rubah_harga_jasa_add").disabled=false;
      document.getElementById("rubah_harga_non_jasa_add").disabled=false;
      document.getElementById("tingkatan_harga_otomastis_add").disabled=false;
      document.getElementById("tampil_harga_pokok_add").disabled=false;
      document.getElementById("resep_dokter_add").disabled=false;
      document.getElementById("btn_edit").style.display="inline";
 
      $("#level_add").selectmenu("refresh");
      $("#aktif_add").selectmenu("refresh");
      $("#autokasir_add").selectmenu("refresh");
      $("#penjualan_add").selectmenu("refresh");
      $("#retur_penjualan_add").selectmenu("refresh");
      $("#mutasi_add").selectmenu("refresh");
      $("#pembelian_add").selectmenu("refresh");
      $("#retur_pembelian_add").selectmenu("refresh");
      $("#barang_rusak_add").selectmenu("refresh");
      $("#kartu_stock_add").selectmenu("refresh");
      $("#input_add").selectmenu("refresh");
      $("#order_customer_add").selectmenu("refresh");
      $("#sj_faktur_add").selectmenu("refresh");
      $("#sj_order_add").selectmenu("refresh");
      $("#ganti_tingkatan_add").selectmenu("refresh");
      $("#batal_dokumen_add").selectmenu("refresh");
      $("#rubah_tanggal_add").selectmenu("refresh");
      $("#rubah_harga_jasa_add").selectmenu("refresh");
      $("#rubah_harga_non_jasa_add").selectmenu("refresh");
      $("#tingkatan_harga_otomastis_add").selectmenu("refresh");
      $("#tampil_harga_pokok_add").selectmenu("refresh");
      $("#resep_dokter_add").selectmenu("refresh");
      $("#gudang_add").selectmenu("refresh");

      status  = 'tambah';
    
      // location.reload()
}

$('#form_gudang').submit(function(event){

      if ($('#id').val()=="") {
          event.preventDefault();
          return;
        }
        if (status == "tambah") {
              alamat = '<?php echo home_url()?>MasterData/save_user'
        }
        else
        {
          alamat = '<?php echo home_url()?>MasterData/edit_user'
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
                      window.location  = '<?php echo home_url()?>MasterData/user'; 
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
}
</script>   
</body>
</html>