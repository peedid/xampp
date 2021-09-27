<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo asset_url(); ?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url(); ?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <link rel="stylesheet" href="<?php echo asset_url(); ?>css/general.css" />
  <style>
    #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td,
    #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #customers tr:hover {
      background-color: #ddd;
    }

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #4CAF50;
      color: white;
    }

    label {
      margin-bottom: -20px !important;
      text-align: left !important;
    }
  </style>
</head>

<body>

  <div data-role="page" id="page_main" data-theme="a" data-transition="slide" data-ajax="false">
    <?php
    $this->load->view("v_header.php");

    ?>
    <div data-role="content">
      <p align="center" style='font-size:15px;font-weight:bold'> DAFTAR USER</p>
      <div style="clear: both;"></div>
      <?php
      if (empty($this->input->get('cari')))
        echo '<input id="rich-autocomplete-input" data-type="search" placeholder="Cari User ...">';
      ?>
      <ul data-role="listview" data-filter="true" data-inset="true" data-input="#rich-autocomplete-input" id="listGCustomer" data-split-icon="gear">
        <?php
        $gateway = $this->model->load_gateway();
        $this->db = $gateway;
        if (count($this->input->get()) > 0)
          $q_antrian = $this->db->query("select username, pass, id_user, nama from mst_user where parent_user = ? and nama like  ?", array($this->session->userdata('username'), '%' . $this->input->get('cari') . '%'));
        else
          $q_antrian = $this->db->query("select username, pass, id_user, nama from mst_user where parent_user = ?", array($this->session->userdata('username')));
        foreach ($q_antrian->result() as $row) :
          $enc = 'https://vpn.gsidatacenter.online/login/direct/' . $this->model->encrypt($row->USERNAME, $row->PASS);
        ?>
          <li style="margin-bottom: 5px;" onclick="show_qrcode('<?= $row->ID_USER; ?>','<?php echo $enc ?>')" id="<?= $row->ID_USER; ?>">
            <a href="#">
              <h2 style="font-size:15px !important"><?= $row->NAMA; ?></h2>
            </a>
          </li>
        <?php endforeach; ?>

        <?php
        $get_child_user = $this->db->query("select child_user from mst_user where id_user = ?", array($this->session->userdata('user_id')));
        $child_user = $get_child_user->row();
        if ($child_user) {
          if (count($this->input->get()) > 0)
            $q_antrian = $this->db->query("select username, pass, id_user, nama from mst_user where parent_user = ? and upper(nama) like ?", array($child_user->CHILD_USER, '%' . $this->input->get('cari') . '%'));
          else
            $q_antrian = $this->db->query("select username, pass, id_user, nama from mst_user where parent_user = ?", array($child_user->CHILD_USER));
        }
        foreach ($q_antrian->result() as $row) :
          $enc = 'https://vpn.gsidatacenter.online/login/direct/' . $this->model->encrypt($row->USERNAME, $row->PASS);
        ?>
          <li style="margin-bottom: 5px;" onclick="show_qrcode('<?= $row->ID_USER; ?>','<?php echo $enc ?>')" id="<?= $row->ID_USER; ?>">
            <a href="#">
              <h2 style="font-size:15px !important"><?= $row->NAMA; ?></h2>
            </a>
          </li>
        <?php endforeach; ?>

      </ul>
    </div>

    <div data-role="popup" id="tanya_hapus" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="width: 100%;">
      <div data-role="header" data-theme="a">
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">Back</a>
        <h1>QR CODE</h1>
      </div>
      <div role="main" class="ui-content">
        <div align='center'>
          <img id='barcode' src="" alt="" width="200" height="200" />
        </div>
      </div>
    </div>
  </div>

  <script>
    /*
  function swipeleftHandler( event ){
    if ($(this).attr('status_antrian')=='SEDANG DISIAPKAN') {
      alert('PESANAN YANG SEDANG DISIAPKAN TIDAK BOLEH DIBATALKAN !')
      return;
    } 
    $('#btn_delete').attr('hapus_id',$(this).attr('id') );
    document.getElementById('isi_info').innerHTML = 'Nomer Pesanan ' + $(this).attr('nomer_antrian') + ' akan di hapus ?';
    $( "#tanya_hapus" ).popup( "open");
  }

  $(function(){
          // Bind the swipeleftHandler callback function to the swipe event on div.box
          $( "li" ).on( "swipeleft", swipeleftHandler );
        });

  function hapus() {
     hapus_id = $('#btn_delete').attr('hapus_id');
     //console.log(hapus_id);
     window.location  = '<?php echo home_url() ?>Ciptogudangrabat_pesanan/delete/' + hapus_id; 
  }

*/
    function show_qrcode(id, qrcode) {
      $('#barcode').attr('src', "");
      var nric = qrcode;
      var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=200x200';
      $('#barcode').attr('src', url);
      $("#tanya_hapus").popup("open");
    }

    document.getElementById('goback').href = "<?php echo home_url() ?>main";
  </script>
</body>

</html>