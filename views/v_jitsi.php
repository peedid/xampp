<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
   
  <head>
     <script>
        Object.defineProperty(window.navigator, 'userAgent', {
          get: function () { return 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/80.0.3987.163 Chrome/80.0.3987.163 Safari/537.36'; }
        });
     </script>
  
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/first_theme.css" />
  <link rel="stylesheet" href="<?php echo asset_url();?>jquerymobile/first_theme/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /> 
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
  <link rel="stylesheet" href="<?php echo asset_url();?>css/general.css" />

  <style>
       #isi {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 100%;
                height: 100%;
                margin-top:0;
                margin-right:0;
                overflow: hidden;
            }
  </style>
</head>

<body>
   <div data-role='page'>
      <div data-role='content'>
         <div id='isi'>
         </div>
      </div>

  </div>
  <script src="https://meet.jit.si/external_api.js"></script>

  <script>
    
   
    function x_videoConferenceLeft(room_name) {
      window.location = '<?php echo home_url()?>Tele';
    }

    const domain = 'meet.jit.si';
    const options = {
        roomName: 'go-gsi',
        parentNode: document.querySelector('#isi'),
        configOverwrite: { disableDeepLinking: true },
        interfaceConfigOverwrite : { 
          SHOW_PROMOTIONAL_CLOSE_PAGE: false, 
          MOBILE_APP_PROMO: false,
          DISABLE_PRESENCE_STATUS: true,
          TOOLBAR_BUTTONS: [
            'chat', 'microphone', 'camera', 
            'hangup','info' 
          ] 
        }
    };

    const api = new JitsiMeetExternalAPI(domain, options);

    api.executeCommand('displayName', 'OSKAR');
    api.addEventListener('videoConferenceLeft',x_videoConferenceLeft);

  </script>
</body>

</html>