<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
  <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
  

  <style type="text/css">

    * {
  box-sizing: border-box;
}
    .master_cabang {
     width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/mst_gudang.png");
    background-size: 60px 60px;
    border-radius: 50%;
    }

    .operator_cabang {
     width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/mst_operator.png");
    background-size: 60px 60px;
    border-radius: 50%;
    }

    .databarang {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/databarang.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_customer {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/mst_customer.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_supplier {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/supplier.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_satuan {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/satuanbarang.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_group {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/groupbarang.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_harga {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/hargabarang.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_sales {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/sales.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_rak {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/rak.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_tingkatan {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/tingkatan.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_hadiah {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/hadiah.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_group_customer {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/group_customer.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_customer_harga {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/customer_harga.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_kartu_member {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/kartu_member.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_armada {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/armada.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_pegawai {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/pegawai.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_pelayan {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/pelayan.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_tipe_bayar {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/tipe_bayar.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_bank {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/bank.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_jabatan {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/jabatan.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_merk {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/merk.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_type {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/type.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_warna {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/warna.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_supir {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/supir.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_user {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/user-profile.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }
  .master_kas {
    width: 60px;
    height: 60px;
    background-image: url("<?php echo asset_url();?>gambar/cash_flow.png");
    background-size: 60px 60px;
    border-radius: 50%;
  }

  .ui-grid-c img{
    width: 100% ;
    height:auto;
    margin:10px;
  }
  .ui-grid-c div{
    padding: :10px;
  }
  .imgCaption{
    width: 100%;
    text-align:center;
    font-size:12px;
    line-height:100%; 
    margin-top: 5px;
  }
  
    }

  </style>


</head>
<body>

  <div data-role="page" id="page_utama" data-theme="a" data-transition="slide">
    <div data-role="content">
       <?php
       $this->load->view('v_header');
       ?>
      <div>
        <h3 align="center"><b>MASTER DATA MENU</b></h3>
     </div>
        <div class="ui-grid-c" >
          <div class="ui-block-a" >
          <div onclick= "cabang_direct()" align="center">
          <div class="master_cabang"></div>
          <div class="imgCaption">MASTER CABANG</div></div>
          </div>
          <div class="ui-block-b" >
          <div onclick= "databarang_direct()" align="center">
          <div class="databarang"></div>
          <div class="imgCaption">DATA BARANG(X)</div></div>
          </div>
          <div class="ui-block-c" >
          <div onclick= "caricustomer()" align="center">
          <div class="master_customer"></div>
          <div class="imgCaption">CUSTOMER</div></div>
          </div>
          <div class="ui-block-d" >
          <div onclick= "operator_direct()" align="center">
          <div class="operator_cabang"></div>
          <div class="imgCaption">OPERATOR CABANG</div></div>
          </div>
        </div>
        <div class="ui-grid-c" style="margin-top: 8px;" >
          <div class="ui-block-a" align="center">
          <div onclick= "supplier_direct()" align="center">
          <div class="master_supplier"></div>
          <div class="imgCaption">SUPPLIER</div></div>
          </div>
          <div class="ui-block-b" align="center">
          <div onclick= "satuan_direct()" align="center">
          <div class="master_satuan"></div>
          <div class="imgCaption">SATUAN BARANG</div></div>
          </div>
          <div class="ui-block-c" align="center">
          <div onclick= "group_direct()" align="center">
          <div class="master_group"></div>
          <div class="imgCaption">GROUP BARANG</div></div>
          </div>
          <div class="ui-block-d" align="center">
          <div onclick= "harga_direct()" align="center">
          <div class="master_harga"></div>
          <div class="imgCaption">HARGA BARANG(X)</div></div>
          </div> 
        </div>
        <div class="ui-grid-c" style="margin-top: 8px;"  >
          <div class="ui-block-a" align="center">
          <div onclick= "sales_direct()" align="center">
          <div class="master_sales"></div>
          <div class="imgCaption">SALES</div></div>
          </div>
          <div class="ui-block-b" align="center">
          <div onclick= "barang_hadiah_direct()" align="center">
          <div class="master_hadiah"></div>
          <div class="imgCaption">BARANG HADIAH(X)</div></div>
          </div>
          <div class="ui-block-c" align="center">
          <div onclick= "rak_barang_direct()" align="center">
          <div class="master_rak"></div>
          <div class="imgCaption">RAK BARANG</div></div>
          </div>
          <div class="ui-block-d" align="center">
          <div onclick= "tingkatan_harga_direct()" align="center">
          <div class="master_tingkatan"></div>
          <div class="imgCaption">TINGKATAN HARGA</div></div>
          </div>
        </div>
        <div class="ui-grid-c" style="margin-top: 8px;"  >
          <div class="ui-block-a" align="center">
          <div onclick= "group_customer_direct()" align="center">
          <div class="master_group_customer"></div>
          <div class="imgCaption">GROUP CUSTOMER</div></div>
          </div>
          <div class="ui-block-b" align="center">
          <div onclick= "customer_harga_direct()" align="center">
          <div class="master_customer_harga"></div>
          <div class="imgCaption">CUSTOMER HARGA(X)</div></div>
          </div>
          <div class="ui-block-c" align="center">
          <div onclick= "carimember()" align="center">
          <div class="master_kartu_member"></div>
          <div class="imgCaption">KARTU MEMBER</div></div>
          </div>
          <div class="ui-block-d" align="center">
          <div onclick= "armada_direct()" align="center">
          <div class="master_armada"></div>
          <div class="imgCaption">ARMADA(X)</div></div>
          </div>
        </div>
        <div class="ui-grid-c" style="margin-top: 8px;"  >
          <div class="ui-block-a" align="center">
          <div onclick= "pegawai_direct()" align="center">
          <div class="master_pegawai"></div>
          <div class="imgCaption">PEGAWAI</div></div>
          </div>
          <div class="ui-block-b" align="center">
          <div onclick= "pelayan_direct()" align="center">
          <div class="master_pelayan"></div>
          <div class="imgCaption">PELAYAN</div></div>
          </div>
          <div class="ui-block-c" align="center">
          <div onclick= "tipe_bayar_direct()" align="center">
          <div class="master_tipe_bayar"></div>
          <div class="imgCaption">TIPE BAYAR</div></div>
          </div>
          <div class="ui-block-d" align="center">
          <div onclick= "bank_direct()" align="center">
          <div class="master_bank"></div>
          <div class="imgCaption">BANK</div></div>
          </div>        
      </div>
      <div class="ui-grid-c" style="margin-top: 8px;"  >
          <div class="ui-block-a" align="center">
          <div onclick= "jabatan_direct()" align="center">
          <div class="master_jabatan"></div>
          <div class="imgCaption">JABATAN</div></div>
          </div>
          <div class="ui-block-b" align="center">
          <div onclick= "merk_armada_direct()" align="center">
          <div class="master_merk"></div>
          <div class="imgCaption">MERK ARMADA</div></div>
          </div>
          <div class="ui-block-c" align="center">
          <div onclick= "tipe_armada_direct()" align="center">
          <div class="master_type"></div>
          <div class="imgCaption">TIPE ARMADA</div></div>
          </div>
          <div class="ui-block-d" align="center">
          <div onclick= "warna_direct()" align="center">
          <div class="master_warna"></div>
          <div class="imgCaption">WARNA</div></div>
          </div> 
      </div>
      <div class="ui-grid-c" style="margin-top: 8px;"  >
          <div class="ui-block-a" align="center">
          <div onclick= "supir_direct()" align="center">
          <div class="master_supir"></div>
          <div class="imgCaption">SUPIR(X)</div></div>
          </div>
          <div class="ui-block-b" align="center">
          <div onclick= "user_direct()" align="center">
          <div class="master_user"></div>
          <div class="imgCaption">USER</div></div>
          </div>
          <div class="ui-block-c" align="center">
          <div onclick= "kas_direct()" align="center">
          <div class="master_kas"></div>
          <div class="imgCaption">CASH FLOW</div></div>
          </div>
          <div class="ui-block-c" align="center">
          <div onclick= "coa_direct()" align="center">
          <div class="master_coa"></div>
          <div class="imgCaption">Daftar Acount(X)</div></div>
          </div>
      </div>
      <div class="ui-grid-c" style="margin-top: 8px;"  >
          <div class="ui-block-a" align="center">
          <div onclick= "acess_direct()" align="center">
          <div class="master_supir"></div>
          <div class="imgCaption">User Acess(X)</div></div>
          </div>
          
      </div>
</div><!-- content -->


      <div data-role="popup" id="pop_cari_user"  data-theme="a" data-dismissible="false" data-position-to='window'  style="margin-top:200px;max-width:400px;max-height: 200px;">
                  <div data-role="header" style="height:45px">
                      <div id="info_header" align="center" style="width:100%;padding-top:10px">
                        <label id="tajuk"></label>
                     </div>
                  </div>
                  <div align="center" data-role="content">
                      
                      <div>
                          <input tyle="text" id="txt_cari_user" autocomplete="off" value="" data-clear-btn="true" placholder="ketik disini">
                      </div>
                      <a onclick="" id ='btn_cancel' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                      <a onclick="CariUser_sekarang()" id ='btn_action' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
                  </div>
    </div>
    </div><!-- -----------page -->
            

    <script type="text/javascript">
      var status =""

      function caricustomer(){
        document.getElementById("tajuk").innerHTML = 'Cari User';
      $( "#pop_cari_user" ).popup({ "data-position-to" : "window" });
      $( "#pop_cari_user" ).popup( "open" );
      $('#txt_cari_user').focus();
      status="customer"
      }

      function CariUser_sekarang() {
        if (status == "member") {
        window.location = '<?php echo home_url(); ?>MasterData/kartu_member?cari=' + ($('#txt_cari_user').val()).toUpperCase();
        }else{
        
        window.location = '<?php echo home_url(); ?>MasterData/customer?cari=' + ($('#txt_cari_user').val()).toUpperCase();
      }
      }

      function cabang_direct(){
        window.location = "<?php echo home_url() ?>MasterData/gudang"
      }

       function databarang_direct(){
        window.location = "<?php echo home_url() ?>MasterData/databarang"
      }

       function customer_direct(){
        window.location = "<?php echo home_url() ?>MasterData/customer"
      }
      function operator_direct(){
        window.location = "<?php echo home_url() ?>MasterData/operator"
      }
      function supplier_direct(){
        window.location = "<?php echo home_url() ?>MasterData/supplier"
      }
      function satuan_direct(){
        window.location = "<?php echo home_url() ?>MasterData/satuan"
      }
      function group_direct(){
        window.location = "<?php echo home_url() ?>MasterData/group"
      }
      function harga_direct(){
        window.location = "<?php echo home_url() ?>MasterData/harga"
      }
      function sales_direct(){
        window.location = "<?php echo home_url() ?>MasterData/sales"
      }
      function barang_hadiah_direct(){
        window.location = "<?php echo home_url() ?>MasterData/barang_hadiah"
      }
      function tingkatan_harga_direct(){
        window.location = "<?php echo home_url() ?>MasterData/tingkatan_harga"
      }
      function rak_barang_direct(){
        window.location = "<?php echo home_url() ?>MasterData/rak_barang"
      }
      function group_customer_direct(){
        window.location = "<?php echo home_url() ?>MasterData/group_customer"
      }
      function kartu_member_direct(){
        window.location = "<?php echo home_url() ?>MasterData/kartu_member"
      }
      function pelayan_direct(){
        window.location = "<?php echo home_url() ?>MasterData/pelayan"
      }
      function jabatan_direct(){
        window.location = "<?php echo home_url() ?>MasterData/jabatan"
      }
      function pegawai_direct(){
        window.location = "<?php echo home_url() ?>MasterData/pegawai"
      }
      function armada_direct(){
        window.location = "<?php echo home_url() ?>MasterData/armada"
      }
      function tipe_bayar_direct(){
        window.location = "<?php echo home_url() ?>MasterData/tipe_bayar"
      }
      function bank_direct(){
        window.location = "<?php echo home_url() ?>MasterData/bank"
      }
      function customer_harga_direct(){
        window.location = "<?php echo home_url() ?>MasterData/customer_harga"
      }
      function warna_direct(){
        window.location = "<?php echo home_url() ?>MasterData/warna"
      }
      function tipe_armada_direct(){
        window.location = "<?php echo home_url() ?>MasterData/tipe_armada"
      }
      function merk_armada_direct(){
        window.location = "<?php echo home_url() ?>MasterData/merk_armada"
      }
      function supir_direct(){
        window.location = "<?php echo home_url() ?>MasterData/supir"
      }
      function user_direct(){
        window.location = "<?php echo home_url() ?>MasterData/user"
      }
      function kas_direct(){
        window.location = "<?php echo home_url() ?>Cash_Flow"
      }
      function coa_direct(){
        window.location = "<?php echo home_url() ?>MasterData/coa"
      }
      function acess_direct(){
        window.location = "<?php echo home_url() ?>MasterData/access"
      }

      function carimember(){
      document.getElementById("tajuk").innerHTML = 'Cari Member';
       $( "#pop_cari_user" ).popup({ "data-position-to" : "window" });
      $( "#pop_cari_user" ).popup( "open" );
      $('#txt_cari_user').focus();
      status="member"
      }




function GoBack(){
       window.location  = '<?php echo home_url()?>Main'; 
}
    </script>
</body>
</html>


