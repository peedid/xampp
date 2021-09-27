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
   .upload-btn-wrapper input[type=file] {
      font-size: 10px !important;
      position: absolute !important;
      left: 0 !important;
      top: 0 !important;
      opacity: 0 !important;
      cursor: pointer;
      height:0px !important;
  }
  .class_gambar{

  }
  </style>
</head>
<body>
    <div data-role="page" id="page_daftar" data-theme="a" data-transition="slide">
        
        <?php $this->load->view('v_header'); ?>

       <div data-role="content">
          <p align="center" style='font-size:20px;font-weight:bold'> CATATAN KELUHAN MOBIL <BR> YANG BELUM SELESAI </p>
          <div style="clear: both;"></div> 
          <ul data-role="listview" data-filter="true" data-inset="true" data-filter-placeholder="Search Here" id="listGCustomer">
              <?php 
                 $ada_data = 0;
                 if ($baris_data):
                 foreach ($baris_data->result() as $row):
              ?>  
                <li class="swipe" style="margin-bottom: 5px;background-color:#2C3E50 !important;color:white"  jenis = "<?= $row->JENIS_CATATAN; ?>" status = "<?= $row->STATUS_CATATAN; ?>" nomer_catatan = "<?= $row->NO_CATATAN; ?>" nopol ="<?= $row->NOPOL; ?>" id="<?= $row->NO_CATATAN; ?>">
                   <!-- <a href="#"> -->
                    <div id="header_data_<?= $row->NO_CATATAN; ?>">
                        <div  id='caption_keluhan_<?= $row->NO_CATATAN; ?>' >
                            <div>
                                <div style="float:left;">
                                   <p style="font-size:12px !important"><?= $row->TANGGAL; ?></p>
                                   <p style="font-size:12px !important"><?= $row->MEREK.' '.$row->JENIS; ?></p>
                                   <h2 style="font-size:20px !important;margin-top:-10px"><?= $row->NOPOL; ?></h2> 
                                </div>
                                <div style="float:right;text-align:right">
                                   <p style="font-size:12px !important"><?= $row->TIPE.' '.$row->WARNA; ?></p>
                                   <p style="font-size:12px !important"><?= $row->NAMA_PENCATAT; ?></p>
                                   <?php
                                     if ($row->PERLU_KAS==1) {
                                        echo '<p style="font-size:16px !important;color:orange;margin-top:-5px"> Sisa Rp. &nbsp&nbsp'.number_format($row->TOTAL_ANGGARAN - $row->TOTAL_REALISASI).'</p>';
                                     }
                                   ?>
                                </div>
                            </div>
                        </div> 
                        <div style="clear:both"></div> 
                          <div>
                                <?php
                                    $ada_data = $ada_data + 1;
                                    if ($row->PERLU_TINDAKLANJUT==1) {
                                      echo "<img style='float:left;width:48px;height:48px;margin-right:10px;' src='".asset_url()."gambar/workin.png'>";
                                    }
                                ?>
                                <p id="data_<?= $row->NO_CATATAN; ?>" style="text-align:left;margin-top:0px;line-height: 1.5;
                                white-space: normal;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;text-align:justify;">
                                <?= $row->CATATAN; ?>
                                </p>
                          </div>
                      </div>
                      <div style="clear:both"></div> 
                      <div style="width:200px;float:right">
                               <a onclick="li_set_click(<?= $row->NO_CATATAN;?>)" id="li_set_<?= $row->NO_CATATAN;?>" no_catatan ="<?= $row->NO_CATATAN; ?>" href="#" class="ui-btn ui-btn-b" style="float:right;width:50px;margin-left:10px;background-color:orange;font-size:12px">SET</a>
                              <?php
                               if ($row->PERLU_TINDAKLANJUT==1) {
                               echo '<a onclick="li_action_click('.$row->NO_CATATAN.')" id="li_action_'.$row->NO_CATATAN.'" no_catatan ="'.$row->NO_CATATAN.'" href="#" class="ui-btn ui-btn-b" style="float:right;width:60px;background-color:orange;font-size:12px">Pekerjaan</a>';
                             }
                              ?>
                      </div>
                  <!-- </a> -->
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
      </div>

      <div align="center" id = "footer_daftar" data-positon="fixed" data-role="footer" style="border:none" >
         <div style="box-shadow: 1px 2px 3px grey;margin-bottom:20px;margin-left:-45px;background-color:orange;position:fixed;bottom:0 !important;width:80px;border-radius: 50%;display: inline-block;opacity: 1;height:80px;">
             <table style="margin-top:5px;">
                <tr>
                   <td  align='center' style="">
                      <div>
                          <img id="tambah_keluhan" src="<?php echo asset_url();?>gambar/plus.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:black">Tambah</span>
                      </div>
                   </td>
              </tr>
              </table>
         </div>
    </div>

     <div data-role="popup" id="tanya"  data-theme="b" data-dismissible="false" style="width:300px;min-width:250px" data-position-to="window">
            <div data-role="header" style="margin-top:-20px;height:45px">
                <div id="info_header" align="center" style="width:100%;padding-top:10px">
                    Tanya
               </div>
            </div>
            <div align="center" data-theme='d' data-role="content">
               <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_action","name"=>"form_action","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
                <p id="info_tanya"></p>
                <div style="margin-top:-10px">
                  <input type="hidden" name="txt_nomer_catatan" id="txt_nomer_catatan" value="">
                  <div style="clear:both"></div>
                  <p style="margin-bottom:-10px">Pilih Status dirubah menjadi ?</p>
                  <select  name="action_pilihan" id="action_pilihan" data-native-menu="false" data-mini="true">
                      <option value="SELESAI">SELESAI</option>
                      <option value="PERLU TINDAKLANJUT">PERLU TINDAKLANJUT</option>
                      <option value="PERLU TINDAKLANJUT DAN BUTUH ANGGARAN">PERLU TINDAKLANJUT DAN BUTUH ANGGARAN</option>
                  </select>
                <a id="simpan_action" href="" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" rel="external">OK</a>
                <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">CANCEL</a>
              </div>
                <?php echo form_close(); ?>
            </div>
      </div>

      <div data-role="popup" id="info_action"  data-theme="b" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div id="info_header_action" align="center" style="width:100%;padding-top:10px">
                      
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content_action"></p>
                    <a onclick="" id ='btn_cancel_action' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back'>OK</a>
                </div>
      </div>


    </div>

    <div data-role="page" id="page_keluhan" data-theme="a" data-transition="slide">
        
        <?php $this->load->view('v_header'); ?>

       <div id='div_isi_keluhan' data-role="content">
           <p align="center" style='font-size:15px;font-weight:bold'>KELUHAN MOBIL</p>
           <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_keluhan","name"=>"form_keluhan","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
              <div>
                  <div id="caption_keluhan">
                     
                  </div>
                  <input type="hidden" id="nopol_mobil" name="nopol_mobil" value="">
                  <p> Isi keluhan disini :</p>
                  <textarea  id="txt_keluhan" name="txt_keluhan" placeholder="Silahkan ketik disini" style="font-size:12px"></textarea>
              </div>
              <p>Gambar yang mengilustrasikan keluhan :</p>
              <div class="upload-btn-wrapper" id="daftar_gambar"> 
              </div>
           <?php echo form_close(); ?>
       </div>

    <div id = "footer_keluhan" data-role="footer" style="position:fixed;bottom:0 !important;width:100%;height:70px;margin-left:-15px">
         <div align="center" style="margin-top:4px">
             <table style="">
                <tr>
                   <td align='center'>
                      <div style="width:80px;height:60px">
                          <img id="ambil_gambar" src="<?php echo asset_url();?>gambar/kamera.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:white;">Ambil Gambar</span>
                      </div>
                   </td>

                   <td id='kol_simpan_keluhan' align='center' style="">
                      <div style="width:80px;height:60px">
                          <img id="simpan_keluhan" src="<?php echo asset_url();?>gambar/save_circle_orange.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:white;">Simpan</span>
                      </div>
                   </td>
              </tr>
              </table>
         </div>
    </div>

         <!-- akhir  -->
          <div data-role="popup" id="info_keluhan"  data-theme="a" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div id="info_header_keluhan" align="center" style="width:100%;padding-top:10px">
                      
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content_keluhan"></p>
                    <a onclick="" id ='btn_cancel_keluhan' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                    <a onclick="" id ='btn_action_keluhan' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
                </div>
           </div>

           <div data-role="popup" id="info"  data-theme="a" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div id="info_header" align="center" style="width:100%;padding-top:10px">
                      Hapus Foto
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content"></p>
                    <a onclick="" id ='btn_cancel' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                    <a onclick="" id ='btn_action' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
                </div>
           </div>

    </div>

<div data-role="page" id="page_keluhan_kosong"  data-theme="a">
    <div data-role="header" style="height:45px">
        <div align="center" style="width:100%;padding-top:10px">
             Oops...
       </div>
    </div>
    <div align="center" data-role="content">
          <p id="info_content_keluhan"> Kolom isi keluhan tidak boleh dikosongkan !!!</p>
        <button onclick='$.mobile.changePage( "#page_keluhan", { transition: "flip", changeHash: true, reverse : true});' class="ui-button ui-widget ui-corner-all" style="width:100px">OK</button>
    </div>

</div>


  

 


   <div data-role="page" id="page_mobil" data-theme="a" data-transition="slide">
        
        <?php $this->load->view('v_header'); ?>

       <div data-role="content">
          <p align="center" style='font-size:15px;font-weight:bold'> PILIH MOBIL </p>
          <div style="clear: both;"></div> 
          <ul data-role="listview" data-filter="true" data-inset="true" data-filter-placeholder="Search Here" id="list_mobil">
              <?php 
                 if ($baris_mobil):
                 foreach ($baris_mobil ->result() as $row):
              ?>  
                <li class="mobil" style="margin-bottom: 5px;" id="mobil_<?= $row->NOPOL; ?>" nopol="<?= $row->NOPOL; ?>" tipe="<?= $row->TIPE; ?>"
                    merek="<?= $row->MEREK; ?>" jenis="<?= $row->JENIS; ?>" warna="<?= $row->WARNA; ?>"
                  >
                   <a href="#">
                    <div>
                        <div style="float:left;">
                               <p style="font-size:12px !important"><?= $row->MEREK.' '.$row->JENIS; ?></p>
                               <h2 style="font-size:20px !important;margin-top:-10px"><?= $row->NOPOL; ?></h2> 
                            </div>
                            <div style="float:right;text-align:right;width:200px">
                               <p style="font-size:12px !important"><?= $row->TIPE.' '.$row->WARNA; ?></p>
                            </div>
                    </div> 
                  </a>
                </li>
              <?php endforeach; ?>
            <?php endif; ?> 
          </ul>
      </div>
    </div>


  <div data-role="page" id="page_tracker" data-theme="a">
      
      <?php $this->load->view('v_header'); ?>

     <div data-role="content">
        <p align="center" style='font-size:18px;font-weight:bold'> DETAIL PEKERJAAN </p>
        <div style="clear: both;"></div> 
        <input type="hidden" id="tmp_pekerjaan_no_catatan" name="tmp_pekerjaan_no_catatan" value="">
        <div id="header_tracker">
             <!-- <table>
                <tr>
                    <td>
                        Project
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        00025
                    </td>
                </tr>
                <tr>
                    <td>
                        Anggaran
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        5.000.000
                    </td>
                    <td></td>
                    <td>
                        Realisasi
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                       200.000
                    </td>
                </tr>
                <tr>
                    <td>
                        Sisa
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        4.800.000
                    </td>
                    <td></td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                       
                    </td>
                </tr>
                <tr>
                    <tr>
                    <td style='vertical-align:top'>
                        Keluhan
                    </td>
                    <td style='vertical-align:top'>
                        :
                    </td>
                    <td colspan='5' style="text-align:justify;vertical-align:top">
                        <p>
                          dengan hormat dengan datangnya surat ini sya selaku orang tua dari wali murid budi menginformasikan bahawa hari ini budi tidak dapat mengikuti pelajaran
                          sebagaimana biasanya dikarenakan sedang
                        </p>
                    </td>
                    
                </tr>
                </tr>
             </table> -->
        </div>
        <div id="tempat_ul">
            <ul style='background-color:#2C3E50' data-role='listview' data-filter='true' data-inset='true' data-filter-placeholder='Search Here' id='li_tracker'>
                <!-- <li id='li_tracker_1' no_tracker = '1' style='margin-bottom:5px !important;background-color:#2C3E50 !important;color:white'> <div style='margin-left:5px;margin-right:5px;'> <div style='margin-left:-5px;margin-right:-5px;height:5px;background-color:white'></div> <p style='float:left;font-size:12px'> Tgl.2020-08-19</p> <p style='float:right;font-size:18px;font-weight:bold;color:orange'>5,000</p> <div style='clear:both'></div> <div style='margin-top:-10px'> <p>Keterangan :</p> <p id='' style='text-align:left;margin-top:0px;line-height: 1.5; white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;text-align:justify;'> - digunakan buat test mebeli kampas resm dengan keterangan yang panjang - kedua - ketiga</p> </div> <div style='clear:both'></div> <div style='background-color:#2C3E50'> <div style='float:left;width:100%'> <img style='width:100%' src='https://vpn.gsidatacenter.online/assets/images/TRADINGMANAGER/tracker_1.jpg'> </div> <div style='width:200px;float:right'> <a onclick='' id='' href='#' class='ui-btn ui-btn-b' style='float:right;width:50px;margin-left:10px;background-color:orange;font-size:12px'>Delete</a> <a onclick='' id='' href='#' class='ui-btn ui-btn-b' style='float:right;width:50px;margin-left:10px;background-color:orange;font-size:12px'>Gambar</a> </div> </div> </div>  </li>
                <li id='li_tracker_2' no_tracker = '2' style='margin-bottom:5px !important;background-color:#2C3E50 !important;color:white'> <div style='margin-left:5px;margin-right:5px;'> <div style='margin-left:-5px;margin-right:-5px;height:5px;background-color:white'></div> <p style='float:left;font-size:12px'> Tgl.2020-08-19</p> <p style='float:right;font-size:18px;font-weight:bold;color:orange'>45,000</p> <div style='clear:both'></div> <div style='margin-top:-10px'> <p>Keterangan :</p> <p id='' style='text-align:left;margin-top:0px;line-height: 1.5; white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;text-align:justify;'>beli test</p> </div> <div style='clear:both'></div> <div style='background-color:#2C3E50'> <div style='width:200px;float:right'> <a onclick='' id='' href='#' class='ui-btn ui-btn-b' style='float:right;width:50px;margin-left:10px;background-color:orange;font-size:12px'>Delete</a> <a onclick='' id='' href='#' class='ui-btn ui-btn-b' style='float:right;width:50px;margin-left:10px;background-color:orange;font-size:12px'>Gambar</a> </div> </div> </div>  </li>  -->
            </ul>
        </div>
    </div>

    <div align="center" id = "footer_tracker" data-role="footer" style="border:none" >
           <div style="box-shadow: 1px 2px 3px grey;margin-bottom:20px;margin-left:-45px;background-color:orange;position:fixed;bottom:0 !important;width:80px;border-radius: 50%;display: inline-block;height:80px;">
               <table style="margin-top:5px;">
                  <tr>
                     <td  align='center' style="">
                        <div>
                            <img id="tambah_pekerjaan" src="<?php echo asset_url();?>gambar/plus.png" style="width:48px;height:48px"><br>
                            <span style="font-size:10px;color:black">Tambah</span>
                        </div>
                     </td>
                </tr>
                </table>
           </div>
      </div>

       <div data-role="popup" id="info_tracker"  data-theme="a" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div id="info_header_tracker" align="center" style="width:100%;padding-top:10px">
                      Oops...
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content_tracker"></p>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back'>OK</a>
                </div>
           </div>

</div>


 <div data-role="page" id="page_pekerjaan" data-theme="a" data-transition="slide">
        
        <?php $this->load->view('v_header'); ?>

       <div id='div_isi_pekerjaan' data-role="content">
           <p align="center" style='font-size:15px;font-weight:bold'>FORM ISIAN PEKERJAAN </p>
           <?php echo form_open_multipart ("",array("method"=>"post","id"=>"form_pekerjaan","name"=>"form_pekerjaan","data-ajax"=>"false", "enctype"=>"multipart/form-data")) ?> 
              <div>
                  <div id="caption_pekerjaan">
                     
                  </div>
                  <input type="hidden" id="pekerjaan_no_catatan" name="pekerjaan_no_catatan" value="">
                  <p> Keterangan Pekerjaaan :</p>
                  <textarea  id="txt_pekerjaan" name="txt_pekerjaan" placeholder="Silahkan ketik disini" style="font-size:12px"></textarea>
                  <p> Nilai Pekerjaan :</p>
                  <input  type="number" id="txt_pekerjaan_nilai" name="txt_pekerjaan_nilai" placeholder="Silahkan isi disini" style="font-size:12px" val=0>
              </div>
              <p>Gambar ilustrasi pekerjaan :</p>
              <div class="upload-btn-wrapper" id="daftar_gambar_pekerjaan"> 
              </div>
           <?php echo form_close(); ?>
       </div>

    <div id = "footer_pekerjaan" data-role="footer" style="position:fixed;bottom:0 !important;width:100%;height:70px;margin-left:-15px">
         <div align="center" style="margin-top:4px">
             <table style="">
                <tr>
                   <td align='center'>
                      <div style="width:80px;height:60px">
                          <img id="ambil_gambar_pekerjaan" src="<?php echo asset_url();?>gambar/kamera.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:white;">Ambil Gambar</span>
                      </div>
                   </td>

                   <td id='kol_simpan_pekerjaan' align='center' style="">
                      <div style="width:80px;height:60px">
                          <img id="simpan_pekerjaan" src="<?php echo asset_url();?>gambar/save_circle_orange.png" style="width:48px;height:48px"><br>
                          <span style="font-size:10px;color:white;">Simpan</span>
                      </div>
                   </td>
              </tr>
              </table>
         </div>
    </div>

         <!-- akhir  -->
          <div data-role="popup" id="info_pekerjaan"  data-theme="a" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div id="info_header_pekerjaan" align="center" style="width:100%;padding-top:10px">
                      
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content_pekerjaan"></p>
                    <a onclick="" id ='btn_cancel_pekerjaan' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                    <a onclick="" id ='btn_action_pekerjaan' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
                </div>
           </div>

           <div data-role="popup" id="hapus_foto_pekerjaan"  data-theme="a" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" style="height:45px">
                    <div align="center" style="width:100%;padding-top:10px">
                      Hapus Foto
                   </div>
                </div>
                <div align="center" data-role="content">
                    <p id="info_content"></p>
                    <a onclick="" id ='btn_cancel_pekerjaan' href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='back' rel=''>CANCEL</a>
                    <a onclick="" id ='btn_action_pekerjaan' proses = "" angka = "" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel='' rel=''>OK</a>
                </div>
           </div>

    </div>


    <div data-role="page" id="page_pekerjaan_kosong"  data-theme="a">
    <div data-role="header" style="height:45px">
        <div align="center" style="width:100%;padding-top:10px">
             Oops...
       </div>
    </div>
    <div align="center" data-role="content">
          <p id="info_content_keluhan"> Silahkan Lengkapi dulu Form isian Pekerjaaan !!!</p>
        <button onclick='$.mobile.changePage( "#page_pekerjaan", { transition: "flip", changeHash: true, reverse : true});' class="ui-button ui-widget ui-corner-all" style="width:100px">OK</button>
    </div>

</div>


    
<script>
var flag_data = '';
var token_name = "<?php echo $this->security->get_csrf_token_name()?>";
var gambar_ke = 0;


<?php
   if ($ada_data == 0 ) {
    echo "$('#listGCustomer').hide();";
   }
?>
$('#kol_simpan').hide();

   showModal();
    
    $(document).ready(function() {
       // Handler for .ready() called.
       hideModal();
    });

    function showModal(){
      $("body").append("<div id='loader' class='ui-loader-background'> </div>");
      GetLoading();
    }

    function hideModal(){
      $(".modalWindow").remove();
      $.mobile.loading('hide');
    }

    function GetLoading() {
       $.mobile.loading('show');
    }    

function cetak_pesanan_online(vdata) {
    send_websocket(vdata);
}

function swipe_page_left( event ){
    if ($.mobile.activePage.attr( "id" ) == 'page_keluhan') {
      if (flag_data  != 'insert') {
        $.mobile.changePage( "#page_daftar", { transition: "slide", changeHash: true });
        if (document.getElementById('img_mobil')) $('#img_mobil').hide();
      }

    }
    else {
      $.mobile.changePage( "#page_keluhan", { transition: "slide", changeHash: true});
      $('#txt_keluhan').val($.trim(document.getElementById('data_'+event.delegateTarget.id).innerHTML));
      $('#txt_keluhan').prop( "disabled", true );
      document.getElementById('caption_keluhan').innerHTML = document.getElementById('caption_keluhan_'+event.delegateTarget.id).innerHTML + 
         '<br><div style="clear:both"></div>';
         if (document.getElementById('img_mobil')) {

         } else {
            var $newdiv1 = $( "<div align='center'><img id='img_mobil' style='text-align:center;widht:200px;height:200px' src='' alt='picture'></div>" )
            $('#caption_keluhan').before($newdiv1);
            $('#img_mobil').hide();
         }
         get_photo_mobil($(document.getElementById(event.delegateTarget.id)).attr('nopol'));
         ambil_daftar_photo($(document.getElementById(event.delegateTarget.id)).attr('nomer_catatan'));
    }
}

function swipe_page_right( event ){
    document.getElementById('info_header_action').innerHTML = "Oops...";
    document.getElementById('info_content_action').innerHTML = 'UNDERCONSTRUCTION';
    $( "#info_action" ).popup( "open");
}

 function on_tap(event) {
    /*data = '{"method_name":"send_to_user","workspace":"<?php echo $this->session->userdata('namatoko');?>", "kode_user":"AGENT", "data" : {"method_name":"CETAK_ANTRIANONLINE","kode_antrian":"'+ $(this).attr('id') +'"}}';
    document.getElementById('info_tanya').innerHTML = document.getElementById($(this).attr('id')).innerHTML + '';
    $('#txt_nomer_catatan').val($(this).attr('id'));
    $('#tanya').popup('open');*/
    //
  }


$('.mobil').on('click',function(event){
    clear_gambar();
    document.getElementById('caption_keluhan').innerHTML = "<br><table>\
                       <tr>\
                        <td>\
                            NOPOL\
                        </td>\
                        <td>\
                            :\
                        </td>\
                        <td>\
                            "+ $(document.getElementById (event.delegateTarget.id)).attr('nopol')   + "\
                        </td>\
                       </tr>\
                       <tr>\
                        <td>\
                            Merek\
                        </td>\
                        <td>\
                            :\
                        </td>\
                        <td>\
                            "+ $(document.getElementById (event.delegateTarget.id)).attr('merek') + ' ' + $(document.getElementById (event.delegateTarget.id)).attr('jenis')+"\
                        </td>\
                       </tr>\
                       <tr>\
                        <td>\
                            Tipe\
                        </td>\
                        <td>\
                            :\
                        </td>\
                        <td>\
                            "+   $(document.getElementById (event.delegateTarget.id)).attr('tipe')  + ' ' + $(document.getElementById (event.delegateTarget.id)).attr('warna') +"\
                        </td>\
                       </tr>\
                     </table>" + '<br><div style="clear:both"></div>';

     if (document.getElementById('img_mobil')) {
        $('#img_mobil').hide();
     } else {
        var $newdiv1 = $( "<div align='center'><img id='img_mobil' style='text-align:center;widht:200px;height:200px' src='' alt='picture'></div>" )
        $('#caption_keluhan').before($newdiv1);
        $('#img_mobil').hide();
     }
    get_photo_mobil($(document.getElementById (event.delegateTarget.id)).attr('nopol'));
    $('#nopol_mobil').val($(document.getElementById (event.delegateTarget.id)).attr('nopol'));
    $.mobile.changePage( "#page_keluhan", { transition: "slide", changeHash: true, reverse : true  });
    flag_data = 'insert';
    $('#footer_keluhan').show();
    $('#txt_keluhan').prop( "disabled", false );
    $('#txt_keluhan').focus();

});

    $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( ".swipe" ).on( "swipeleft", swipe_page_left );
          //$( ".swipe" ).on( "swiperight", swipe_page_right );
          //$( ".swipe" ).on( "taphold", on_tap );

          $( "#page_keluhan" ).on( "swipeleft", swipe_page_left );
          $( "#page_keluhan" ).on( "swiperight", swipe_page_right );


        });

$(document).ready(function(){
  var _originalSize = $(window).width() + $(window).height()
  $(window).resize(function(){
    if($(window).width() + $(window).height() != _originalSize){
      console.log("keyboard show up");
      $("#footer_keluhan").css("position","relative"); 
      //$("#footer_daftar").css("position","relative");  
    }else{
      console.log("keyboard closed");
      $("#footer_keluhan").css("position","fixed");  
      //$("#footer_daftar").css("position","fixed");  
    }
  });
});


 $('#form_keluhan').submit(function(event){
         
        if ($('#txt_keluhan').val()=="") {
          $.mobile.changePage( "#page_keluhan_kosong", { transition: "flip", changeHash: true, reverse : true});
          event.preventDefault();
          return;
        }
        $('#footer_keluhan').hide();

        showModal();

        $.ajax({
                url:'<?php echo home_url()?>Naba/save_catatan/keluhan',
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    $('#footer_keluhan').show();
                    //console.log(res);
                    hasil = jQuery.parseJSON(res);
                    $('#btn_cancel_keluhan').hide();
                    if (hasil.result == 'ok') {
                        $('#btn_action_keluhan').attr('href',window.location.href.substr(0, window.location.href.indexOf('#')));
                        $('#btn_action_keluhan').attr('data-rel','');
                        $('#btn_action_keluhan').attr('rel','external');
                    } else {
                       $('#btn_action_keluhan').attr('href','#');
                        $('#btn_action_keluhan').attr('data-rel','back');
                        $('#btn_action_keluhan').attr('rel','');
                    }
                      $('input[name ="<?php echo $this->security->get_csrf_token_name();?>"]').attr('value',hasil.token);
                      document.getElementById('info_header_keluhan').innerHTML = hasil.info_header;
                      document.getElementById('info_content_keluhan').innerHTML = hasil.info_content;
                      $( "#info_keluhan" ).popup( "open");

                },
                error: function (jqXHR, textStatus, errorThrown) {
                     hideModal();
                     $('#footer_keluhan').show();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
    });

$('#form_pekerjaan').submit(function(event){
         
        if ($('#txt_pekerjaan').val()=="" || $('#txt_pekerjaan_nilai').val()==0 ) {
          $.mobile.changePage( "#page_pekerjaan_kosong", { transition: "flip", changeHash: true, reverse : true});
          event.preventDefault();
          return;
        }

        $('#footer_pekerjaan').hide();

        showModal();

        $.ajax({
                url:'<?php echo home_url()?>Naba/save_pekerjaan',
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    $('#footer_pekerjaan').show();
                    //console.log(res);
                    hasil = jQuery.parseJSON(res);
                    $('#btn_cancel_pekerjaan').hide();
                    if (hasil.result == 'ok') {
                        $('#btn_action_pekerjaan').attr('href',window.location.href.substr(0, window.location.href.indexOf('#')));
                        $('#btn_action_pekerjaan').attr('data-rel','');
                        $('#btn_action_pekerjaan').attr('rel','external');
                    } else {
                       $('#btn_action_pekerjaan').attr('href','#');
                        $('#btn_action_pekerjaan').attr('data-rel','back');
                        $('#btn_action_pekerjaan').attr('rel','');
                    }
                      $('input[name ="<?php echo $this->security->get_csrf_token_name();?>"]').attr('value',hasil.token);
                      document.getElementById('info_header_pekerjaan').innerHTML = hasil.info_header;
                      document.getElementById('info_content_pekerjaan').innerHTML = hasil.info_content;
                      $( "#info_pekerjaan" ).popup( "open");

                },
                error: function (jqXHR, textStatus, errorThrown) {
                     hideModal();
                     $('#footer_pekerjaan').show();
                    alert(errorThrown);
                   
                }
             });
        event.preventDefault();
    });

 $('#form_action').submit(function(event){
         
        /*if ($('#actiion_pilihan').val() =="") {
          $.mobile.changePage( "#page_keluhan_kosong", { transition: "flip", changeHash: true, reverse : true});
          event.preventDefault();
          return;
        }*/
        $('#tanya').popup('close');

        showModal();

        $.ajax({
                url:'<?php echo home_url()?>Naba/save_action_keluhan',
                method: 'POST',
                data: new FormData(this),
                processData:false,
                contentType:false,
                beforesend: function() {

                },
                success: function (res)
                {
                    hideModal();
                    //console.log(res);
                    hasil = jQuery.parseJSON(res);
                    $('input[name ="<?php echo $this->security->get_csrf_token_name();?>"]').attr('value',hasil.token);
                    if (hasil.result == 'ok') {
                        if ( hasil.no_catatan)
                           $(document.getElementById (hasil.no_catatan)).remove();
                        else
                            window.location = window.location.href.substr(0, window.location.href.indexOf('#'));
                    } else {
                      
                      document.getElementById('info_header_action').innerHTML = hasil.info_header;
                      document.getElementById('info_content_action').innerHTML = hasil.info_content;
                      $( "#info_action" ).popup( "open");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                     hideModal();
                }
             });
        event.preventDefault();
    });

 function get_photo_mobil(nopol) {
     $.ajax({
          url:'<?php echo home_url()?>Naba/get_photo_mobil?nopol=' + nopol,
          method: 'GET',
          processData:false,
          contentType:false,
          beforesend: function() {
              $('#img_mobil').hide();
          },
          success: function (res)
          {
              hideModal();
              //console.log(res);
                if ($.trim(res) != 'data:image/png;base64,') {
                    $('#img_mobil').attr('src',res);
                    $('#img_mobil').show();
                } else {
                  $('#img_mobil').hide();
                }
          },
          error: function (jqXHR, textStatus, errorThrown) {
               hideModal();
               alert(errorThrown);
          }
       });
  }

  function ambil_daftar_photo(no_catatan) {
     clear_gambar();
     $.ajax({
          url:'<?php echo home_url()?>Naba/ambil_daftar_gambar_keluhan?no_catatan=' + no_catatan,
          method: 'GET',
          processData:false,
          contentType:false,
          beforesend: function() {
              
          },
          success: function (res)
          {
                if ($.trim(res) != '{}') {
                   hasil = jQuery.parseJSON(res);
                   hitunganke = 0;
                   $.each(hasil, function(key,val){
                      hitunganke = hitunganke + 1;
                      //console.log("key : "+key+" ; value : "+val);
                      $("#daftar_gambar").append('<input  onchange = "readURL(this)" id="gambar_'+ hitunganke +'" name="gambar_'+ hitunganke +'" type="file" />').trigger('create');
                      $("#daftar_gambar").append('<img angka= "'+ gambar_ke +'" class="class_gambar" style="max-width:100%;height:auto;" id="picture_'+ hitunganke +'" name="picture_'+ hitunganke +'" src="'+ val +'"/>').trigger('create');
                   });
                } else {
                }
          },
          error: function (jqXHR, textStatus, errorThrown) {
               alert(errorThrown);
          }
       });
  }


 $('#simpan_keluhan').click(function(){
   $('#form_keluhan').submit();
});

$('#simpan_pekerjaan').click(function(){
   $('#form_pekerjaan').submit();
});

 $('#simpan_action').click(function(){
   $('#form_action').submit();
});

 $('#tambah_keluhan').click(function(){
   $('#txt_keluhan').val('');
   document.getElementById('caption_keluhan').innerHTML = '';
   $.mobile.changePage( "#page_mobil", { transition: "slide", changeHash: true, reverse : true  });
   //$('#txt_keluhan').focus();
});

 $('#tambah_pekerjaan').click(function(){
   $('#pekerjaan_no_catatan').val($('#tmp_pekerjaan_no_catatan').val());
   $('#txt_pekerjaan').val('');
   document.getElementById('caption_pekerjaan').innerHTML = document.getElementById('header_tracker').innerHTML;
   $.mobile.changePage( "#page_pekerjaan", { transition: "slide", changeHash: true, reverse : true  });
   //$('#txt_keluhan').focus();
});

 $( "#tgl1" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>Naba/catatan_keluhan" +"?tgl1=" + $('#tgl1').val() + "&tgl2=" + $('#tgl2').val();
  });


   $( "#tgl2" ).bind( "change", function(event, ui) {
      GetLoading();
      window.location = "<?php echo home_url()?>Naba/catatan_keluhan" +"?tgl1=" + $('#tgl1').val() + "&tgl2=" + $('#tgl2').val();

  });


  document.getElementById('goback').href = "<?php echo home_url() ?>main";

  function GoBack() {
    if ($.mobile.activePage.attr( "id" ) == 'page_keluhan')
    {
       flag_data = '';
       $.mobile.changePage( "#page_daftar", { transition: "slide", changeHash: true });
    }
    else {
       if ($.mobile.activePage.attr( "id" ) == 'page_mobil')
          {
            if (flag_data=='insert')
               $.mobile.changePage( "#page_keluhan", { transition: "slide", changeHash: true });
            else
               $.mobile.changePage( "#page_daftar", { transition: "slide", changeHash: true });
          }
       else
         if ($.mobile.activePage.attr( "id" ) == 'page_keluhan_kosong')
            $.mobile.changePage( "#page_keluhan", { transition: "flip", changeHash: true });
         else
             if ($.mobile.activePage.attr( "id" ) == 'page_daftar') {
                 if ($(".ui-page-active .ui-popup-active").length > 0)
                   $('#tanya').popup('close');
                 else 
                   window.location = "<?php echo home_url() ?>main";
              } else
                 if ($.mobile.activePage.attr( "id" ) == 'page_tracker') {
                    $.mobile.changePage( "#page_daftar", { transition: "flip", changeHash: true });
                } else
                  if ($.mobile.activePage.attr( "id" ) == 'page_pekerjaan') {
                     $.mobile.changePage( "#page_tracker", { transition: "slide", changeHash: true });
                  }
                else
                  window.location = "<?php echo home_url() ?>main";
    }
    
  }

  $( "#ambil_gambar" ).click(function() {
   // cek hapus 
   $("input").each(function(index, element){
      nama = this.id;
      if ( nama.indexOf('gambar_') != -1) {
        if ( $("#"+nama).val() == '') {
          $("#"+nama).remove();
          $("#"+nama).remove();
          gambar_ke = gambar_ke - 1;
        } 
      }
    });
  
   gambar_ke = gambar_ke + 1;
   $("#daftar_gambar").append('<input  onchange = "readURL(this)" id="gambar_'+ gambar_ke +'" name="gambar_'+ gambar_ke +'" type="file" />').trigger('create');
   $("#daftar_gambar").append('<img angka= "'+ gambar_ke +'" class="class_gambar" style="max-width:100%;height:auto;" id="picture_'+ gambar_ke +'" name="picture_'+ gambar_ke +'" src=""/>').trigger('create');

       $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( ".class_gambar" ).on( "swipeleft", swipeleftHandler );
        });

   $("#gambar_"+gambar_ke).trigger('click');
   
});

$( "#ambil_gambar_pekerjaan" ).click(function() {
   // cek hapus 
   $("input").each(function(index, element){
      nama = this.id;
      if ( nama.indexOf('gambar_pekerjaan_') != -1) {
        if ( $("#"+nama).val() == '') {
          $("#"+nama).remove();
          $("#"+nama).remove();
          gambar_ke = gambar_ke - 1;
        } 
      }
    });
  
   gambar_ke = gambar_ke + 1;
   $("#daftar_gambar_pekerjaan").append('<input  onchange = "readURL(this)" id="gambar_pekerjaan_'+ gambar_ke +'" name="gambar_pekerjaan_'+ gambar_ke +'" type="file" />').trigger('create');
   $("#daftar_gambar_pekerjaan").append('<img angka= "'+ gambar_ke +'" class="class_gambar" style="max-width:100%;height:auto;" id="picture_pekerjaan_'+ gambar_ke +'" name="picture_pekerjaan_'+ gambar_ke +'" src=""/>').trigger('create');

       $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( ".class_gambar" ).on( "swipeleft", swipeleftHandler );
        });

   $("#gambar_pekerjaan_"+gambar_ke).trigger('click');
   
});

function cek_ada_gambar(){
  ada_gambar = 0;
  $("input").each(function(index, element){
      nama = this.id;
      if ( nama.indexOf('gambar_') != -1) {
        if ( $("#"+nama).val() != '') {
          ada_gambar = 1;
        } 
      }
    });

  if (ada_gambar ==0)
     $('#kol_simpan').hide();
  else
       $('#kol_simpan').show();
}

function clear_gambar(){
  ada_gambar = 0;
  $("input").each(function(index, element){
      nama = this.id;
      if ( nama.indexOf('gambar_') != -1) {
          $("#"+nama).remove();
      }
    });
  $("img").each(function(index, element){
      nama = this.id;
      if ( nama.indexOf('picture_') != -1) {
          $("#"+nama).remove();
      }
    });
}


function swipeleftHandler( event ){

  $('#btn_action').attr('proses','hapus');
  $('#btn_action').attr('angka',$(this).attr('angka'));
  document.getElementById('info_content').innerHTML = 'Yakin ingin dihapus ?';
  $('#btn_cancel').show();
   $('#btn_action').attr('href','#');
  $('#btn_action').attr('data-rel','back');
  $('#btn_action').removeAttr('rel','');
  $( "#info" ).popup( "open");
}

$('#btn_action').click(function(){
   if ( $('#btn_action').attr('proses')=='hapus') {
      $('#picture_'+ $('#btn_action').attr('angka')).remove();
      $('#gambar_'+ $('#btn_action').attr('angka')).remove();
      //$( "#info" ).popup( "close");
      cek_ada_gambar();
   }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            id = input.id;
            var angka = id.substring(7, id.length);
            $('#picture_' + angka ).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        
        cek_ada_gambar();
    } 
}

$(".refresh").click(function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    //Do important stuff....
    window.location = window.location.href.substr(0, window.location.href.indexOf('#'));
});


$(document).on("pagechange", function(toPage) {
    if ((toPage.currentTarget.URL).indexOf('page_keluhan') != -1) {
       if ( flag_data == 'insert') {
            $('#footer_keluhan').show();
       } else {
            $('#footer_keluhan').hide();
       }
    }
});


 $('#kerjakan_sekarang').on('click',function() {
    $('#tanya').popup('close');
    
  });

 (function($) {
     $.fn.doubleTap = function(doubleTapCallback) {
         return this.each(function(){
      var elm = this;
      var lastTap = 0;
      $(elm).bind('vmousedown', function (e) {
                                var now = (new Date()).valueOf();
        var diff = (now - lastTap);
                                lastTap = now ;
                                if (diff < 250) {
                        if($.isFunction( doubleTapCallback ))
                        {
                           doubleTapCallback.call(elm);
                        }
                                }      
      });
         });
    }
})(jQuery);

$( ".swipe" ).doubleTap(function(target){
    /*document.getElementById('info_tanya').innerHTML = document.getElementById('header_data_' + $(this).attr('id')).innerHTML;
    $('#txt_nomer_catatan').val($(this).attr('id'));
    $('#tanya').popup('open');*/
  });

function li_set_click(nocatatan){
  document.getElementById('info_tanya').innerHTML = document.getElementById('header_data_' + nocatatan).innerHTML;
    $('#txt_nomer_catatan').val(nocatatan);
    $('#tanya').popup('open');
}

function li_action_click(nocatatan){
   $('#li_tracker').empty();
   $('#header_tracker').empty();

   showModal();
   $.ajax({
          url:'<?php echo home_url()?>Naba/get_tracker?no_catatan=' + nocatatan,
          method: 'GET',
          processData:false,
          contentType:false,
          beforesend: function() {
              
          },
          success: function (res)
          {
               hideModal();
               //console.log(res);
               hasil = jQuery.parseJSON(res);
               if (hasil.result =="1") {
                   document.getElementById('header_tracker').innerHTML = hasil.header;
                   if (hasil.li) {
                     //console.log(hasil.li);
                     ada_li = 0;
                     $.each(hasil.li, function(key,val){
                         //console.log(val);
                          ada_li = ada_li + 1;
                          $('#li_tracker').append(val).trigger('create');     
                       });
                     if (ada_li > 0) {
                          $('#li_tracker').listview().listview('refresh');
                     }
                   }
                   $.mobile.changePage( "#page_tracker", { transition: "flip", changeHash: true }); 
                 } else {
                    $.mobile.changePage( "#page_tracker", { transition: "flip", changeHash: true }); 
                 }
              $('#tmp_pekerjaan_no_catatan').val(nocatatan);
          },
          error: function (jqXHR, textStatus, errorThrown) {
               hideModal();
               alert(errorThrown);
          }
       });
   
}



$( "#action_pilihan" ).change(function() {
   //console.log('masuk');
   $("#tanya").popup("reposition", {positionTo: 'window'});
   //$('#tanya').resize();
});

function tracker_upload(notracker) {
   
}

function tracker_delete(notracker) {
   showModal();
   $.ajax({
          url:'<?php echo home_url()?>Naba/delete_tracker?no_tracker=' + notracker,
          method: 'GET',
          processData:false,
          contentType:false,
          beforesend: function() {
              
          },
          success: function (res)
          {
               hideModal();
               //console.log(res);
               hasil = jQuery.parseJSON(res);
               if (hasil.result == 'ok') {
                 $('#li_tracker_'+ notracker).remove();
               } else {
                $('#info_header_tracker').innerHTML = hasil.info_header;
                $('#info_content_tracker').innerHTML = hasil.info_content;
                $('#info_tracker').popup('open');
               }
          },
          error: function (jqXHR, textStatus, errorThrown) {
               hideModal();
               alert(errorThrown);
          }
       });
}



</script>
</body>
</html>