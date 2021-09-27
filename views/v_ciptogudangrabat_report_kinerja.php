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


<style type="text/css">
table {
  border-collapse: collapse;
 
}

table, th, td {
  border: 1px solid black;
}



.button_bulat_on {
  width: 100px;
  height: 100px;
  background-image: url("<?php echo asset_url();?>gambar/trans_on.png");
  background-size: 100px 100px;
  background-repeat: no-repeat;
  border:2px solid black;
  border-radius: 50%;
  margin: 10% auto;
  position: relative;
  }

  .button_bulat_off {
  width: 100px;
  height: 100px;
  background-image: url("<?php echo asset_url();?>gambar/trans_off.png");
  background-size: 100px 100px;
  background-repeat: no-repeat;
  border:2px solid black;
  border-radius: 50%;
  margin: 10% auto;
  position: relative;
  }

  .button_bulat1 {
    position: absolute;
    width: inherit;
    height: auto;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    font-family: Arial;
    color: black;
    font-style: italic;
    
  }

  .trans_off {
    max-height: 110px;
    max-width: 110px;
    position: relative;
  }

  .nec


</style>
</head>
<body>
     <div data-role="page" data-theme="a">
      <?php 
         $this->load->view('v_header');
      ?>

      <div data-role="content">
        <div align="center" style="color: orange;font-size: 17px;font-weight: bold">
           LAPORAN        
        </div>
        <br>
        &nbsp&nbsp&nbspPeriode :<br>
        <div>
          <table style="border:none !important">
              <tr>
                <td style="border:none !important" >
                   <input data-mini = "true" style="width: 122px;" type="date" id="tgl1" name="tgl1" value="<?php echo $tgl1 ?>" >
                </td>
                <td style="border:none !important;width:10px !important">
                  s/d
                </td>
                <td style="border:none !important;margin-left:-10px">
                    <input data-mini = "true" style="width: 122px;" type="date" id="tgl2" name="tgl2" value="<?php echo $tgl2?>" >
                </td>
            </tr>
          </table>
        </div>

        <p id = "test_1" style="text-align:center">Berdasarkan Banyaknya Pekerjaan sbb : </p>
        <div style="clear:both"></div>
        <table id="test_2" style=" border-collapse: collapse;border: 1px solid black;">
           <tr style="text-align:center;background-color:#2C3E50;color:white">
             <td>
              Nama
             </td>
             <td>
              Banyak Pekerjaan
             </td>
             <td>
               Waktu Pengerjaan
             </td>
           </tr>
           <?php
               $ada_baris = 0;
               if ($baris_data) {
                 foreach ($baris_data->result() as $result) {
                  $ada_baris = $ada_baris + 1;
                 echo "
                       <tr>
                         <td style='width:150px'>
                          &nbsp$result->PEGAWAI
                         </td>
                         <td style='text-align:center'>
                          $result->BANYAK_NOTA
                         </td>
                         <td style='text-align:center'>
                           $result->JUMLAH_MENIT
                         </td>
                       </tr>";
                }
               }
           ?>
        </table>
        <div>
            <?php
               if ($baris_rekap) {
                  $hasil = $baris_rekap->row();
               }
            ?>
            <h2 style="text-align:center;">Perbandingan Penjualan</h2>
              <div style="text-align: center; margin-top:-40px">
                 <div class="button_bulat_on" style="display: inline-block;margin-right: 20px;" onclick="myRedirect()" >
                    <div class="button_bulat1" style="color:white !important">
                      <div style="margin-top: -7px">
                        <p style="font-size: 40px"><?php echo $hasil->ONLINE?></p>
                      </div>
                   </div>
                  </div>
                  <div class="button_bulat_off" style="display: inline-block;margin-right: 20px;" onclick="myRedirect1()" data-transition="pop">
                    <div class="button_bulat1" style="color:white !important">
                        <div style="margin-top: -10px" style="position: relative; font-size: 20px">
                          <p style="font-size: 40px"><?php echo $hasil->OFFLINE?></p>
                        </div>
                        </div>
                   </div>
                  </div>  
              </div>
              <div style="text-align: center;">
                <button onclick="testing1()"> testing </button>
              </div>
               <div>
                 <button onclick="input_member()"> MANAGE CUSTOMER </button>
               </div>
               <!-- <div>
                 <button onclick="detil_customer()"> DETIL </button>
               </div> 
<div style="clear:both"></div>
        <table style=" border-collapse: collapse;border: 1px solid black;">
           <tr style="text-align:center;background-color:#2C3E50;color:white;">
            <td style="width: 10%">No.</td>
            <td style="width: 45%">Customer</td>
            <td style="width: 45%">Kode Customer</td>
           </tr>
           <?php
               $ada_baris = 0;
               $nomor = 0;
               if ($baris_yussi) {
                 foreach ($baris_yussi->result() as $yussi) {
                  $ada_baris = $ada_baris + 1;
                  $nomor++;
                 echo "
                       <tr>
                         <td style='text-align:center'>
                          $nomor
                         </td>
                         <td style='text-align:center'>
                          NAMA_CUSTOMER
                         </td>
                         <td style='text-align:center'>
                           $yussi->NAMA_CUSTOMER
                         </td>
                       </tr>";
                
                }
               }
           ?>
        </table>
        </div>       -->
 
        
      </div> <!-- akhir content -->
     </div>


<script type="text/javascript">

  function testing1(){
  window.location = "<?php echo home_url()?>Ciptogudangrabat_pesanan/kesehatan"
 }

  <?php
     if ($ada_baris == 0) {
      echo "
         $('#test_1').hide();
         $('#test_2').hide();
      ";
     }
  ?>
 function input_member(){
  window.location = "<?php echo home_url() ?>Ciptogudangrabat_pesanan/input_member" 
   }

function detil_customer() {
    window.location = "<?php echo home_url()?>Ciptogudangrabat_pesanan/detil_customer";
  }

  function myRedirect() {
    window.location = "<?php echo home_url()?>Ciptogudangrabat_pesanan/detail_online"  +"?tgl1=" + $('#tgl1').val() + "&tgl2=" + $('#tgl2').val();
  }

  function myRedirect1() {
    window.location = "<?php echo home_url()?>Ciptogudangrabat_pesanan/detail_offline"  +"?tgl1=" + $('#tgl1').val() + "&tgl2=" + $('#tgl2').val();
  }





  document.getElementById('goback').href = "<?php echo home_url(); ?>main";
     
   $( "#tgl1" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>Ciptogudangrabat_pesanan/report_kinerja" +"?tgl1=" + $('#tgl1').val() + "&tgl2=" + $('#tgl2').val();
  });


   $( "#tgl2" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>Ciptogudangrabat_pesanan/report_kinerja" +"?tgl1=" + $('#tgl1').val() + "&tgl2=" + $('#tgl2').val();

  });

  
  


</script>

</body>
</html>