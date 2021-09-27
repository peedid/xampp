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

table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}



.tabel {
  border-collapse: collapse;
  border: 1px solid black; 
  width: 100%;
  margin-right: -10px;
  margin-left:  -10px;
}
</style>
</head>
<body>
<div data-role="page" data-theme="a" style="margin-bottom: 50px;">
      <?php 
         $this->load->view('v_header');
      ?>
  <div data-role='content'>
    <div align="center">
      <h1>Detail Transaksi Offline</h1>
      <div align="left">
        <p style="font-weight: bold;">Transaksi Selesai</p>
      </div>
      <div style="clear:both"></div>
        <table style=" border-collapse: collapse;border: 1px solid black;">
           <tr style="text-align:center;background-color:#2C3E50;color:white;">
            <td style="width: 10%">No.</td>
            <td style="width: 45%">Customer</td>
            <td style="width: 45%">Pelayan</td>
           </tr>
           <?php
               $ada_baris = 0;
               $nomor = 0;
               if ($baris_data) {
                 foreach ($baris_data->result() as $result) {
                  $ada_baris = $ada_baris + 1;
                  $nomor++;
                 echo "
                       <tr>
                         <td style='text-align:center'>
                          $nomor
                         </td>
                         <td style='text-align:center'>
                          $result->ATAS_NAMA
                         </td>
                         <td style='text-align:center'>
                           $result->NAMA_PEGAWAI
                         </td>
                       </tr>";
                
                }
               }
           ?>
        </table>
      <div align="left">
        <p style="font-weight: bold;">Transaksi Tidak Selesai</p>
      </div>
      <div style="clear:both"></div>
        <table style=" border-collapse: collapse;border: 1px solid black;">
           <tr style="text-align:center;background-color:#2C3E50;color:white;">
            <td style="width: 10%">No.</td>
            <td style="width: 45%">Customer</td>
            <td style="width: 45%">Pelayan</td>
           </tr>
           <?php
               $ada_baris = 0;
               $nomor = 0;
               if ($baris_detail) {
                 foreach ($baris_detail->result() as $result) {
                  $ada_baris = $ada_baris + 1;
                  $nomor++;
                 echo "
                       <tr>
                         <td style='text-align:center'>
                          $nomor
                         </td>
                         <td style='text-align:center'>
                          $result->ATAS_NAMA
                         </td>
                         <td style='text-align:center'>
                           $result->PEGAWAI
                         </td>
                       </tr>";
                
                }
               }
           ?>
        </table>   
    </div>
  </div>
</div>
</body>
</html>