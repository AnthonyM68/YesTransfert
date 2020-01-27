<?php

function mailCreate($upload, $mail_exp, $subject, $message) {
    $mailbody = '<html>
    <head>
    <title>$messageGen</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">
</head>

<body>
    <div class="area">
    <ul class="circles" >
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
<style>
.alignement{
   position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
}
.header-mail{
      padding:20px; 
      background-color: rgba(74, 88, 128, 0.774);
      color: #fff;
      font-size:30px;
}
.area {
    background: #f5f6fa;
    background: -webkit-linear-gradient(to left, #8f94fb, #273c75);
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
}
.circles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
    
.circles li {
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(39, 60, 117, 0.5);
    animation: animate 25s linear infinite;
    bottom: -150px;
}
    
.circles li:nth-child(1) {
   left: 25%;
   width: 80px;
   height: 80px;
   animation-delay: 0s;
}

.circles li:nth-child(2) {
   left: 10%;
   width: 20px;
   height: 20px;
   animation-delay: 2s;
   animation-duration: 12s;
}

.circles li:nth-child(3) {
   left: 70%;
   width: 20px;
   height: 20px;
   animation-delay: 4s;
}

.circles li:nth-child(4) {
   left: 40%;
   width: 60px;
   height: 60px;
   animation-delay: 0s;
   animation-duration: 18s;
}

.circles li:nth-child(5) {
   left: 65%;
   width: 20px;
   height: 20px;
   animation-delay: 0s;
}

.circles li:nth-child(6) {
   left: 75%;
   width: 110px;
   height: 110px;
   animation-delay: 3s;
}

.circles li:nth-child(7) {
   left: 35%;
   width: 150px;
   height: 150px;
   animation-delay: 7s;
}

.circles li:nth-child(8) {
   left: 50%;
   width: 25px;
   height: 25px;
   animation-delay: 15s;
   animation-duration: 45s;
}

.circles li:nth-child(9) {
   left: 20%;
   width: 15px;
   height: 15px;
   animation-delay: 2s;
   animation-duration: 35s;
}

.circles li:nth-child(10) {
   left: 85%;
   width: 150px;
   height: 150px;
   animation-delay: 0s;
   animation-duration: 11s;
}
.footer-mail{
   padding:20px; 
   background-color: rgba(74, 88, 128, 0.774);
   color: #fff;
}

@keyframes animate {
   0% {
      transform: translateY(0) rotate(0deg);
      opacity: 1;
      border-radius: 0;
   }
   100% {
      transform: translateY(-1000px) rotate(720deg);
      opacity: 0;
      border-radius: 50%;
   }
}
@keyframes animate {
   0% {
      transform: translateY(0) rotate(0deg);
      opacity: 1;
      border-radius: 0;
   }
   100% {
      transform: translateY(-1000px) rotate(720deg);
      opacity: 0;
      border-radius: 50%;
   }
}
.btnLink {
   border:1px solid  rgba(0, 0, 255, .2); 
   box-shadow: 6px 6px 2px 1px rgba(0, 0, 255, .2);
   background-color: rgba(74, 88, 128, 0.774);
   color: #fff;
   padding:10px;
   margin:25px;
   border-radius:10px;
   -webkit-border-radius:10px;
   -moz-border-radius:10px;
   -ms-border-radius:10px;
   -o-border-radius:10px;
   width:100px;
}
     </style>
    <div class="es-wrapper-color alignement">
        <table cellpadding="0" cellspacing="0" class="es-footer esd-footer-popover" align="center">
        <tbody>
        <tr>
        <td class="esd-stripe" esd-custom-block-id="7394" align="center">
        <table class="es-footer-body" width="800" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
        <tbody>
        <tr>
        <td class="esd-block-text header-mail" align="center" ;>
        <p>Yes Transfert Utilitaire de Transfert</p>
        </td>
        </tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
        <td class="esd-email-paddings" valign="top">
        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td class="esd-stripe" esd-custom-block-id="7388" align="center">
        <table class="es-content-body" style="background-color: rgb(51, 51, 51);" width="800" cellspacing="0" cellpadding="0" bgcolor="#333333" align="center">
        <tbody>
        <tr>
        <td class="esd-structure esd-checked es-p40t es-p40b es-p40r es-p40l" style="background-image:url(https://euzuag.stripocdn.email/content/guids/CABINET_85e4431b39e3c4492fca561009cef9b5/images/93491522393929597.png);background-repeat: no-repeat; background-position: left top;" align="left" background="https://euzuag.stripocdn.email/content/guids/CABINET_85e4431b39e3c4492fca561009cef9b5/images/93491522393929597.png">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
        <td align="center" class="esd-block-text es-p40t es-p10b">
        <h1 style="color: #ffffff;">Bonjour vous avez un fichier à télécharger de l\'Expéditeur:<br>' . $mail_exp . '</h1> 
        </td>
        </tr>
        <tr>
        <td esdev-links-color="#757575" class="esd-block-text es-p10t es-p20b es-p30r es-p30l" align="center">
        <p style="color: #fff;">' . $subject . '<br>' . $message . '</p>
        <p style="color: #fff;">Yes Transfert vous invite à procéder a votre téléchargement gratuit du fichier que l\'on vous à envoyer par Email</p>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" class="es-footer esd-footer-popover" align="center">
        <tbody>
        <tr>
        <td class="esd-stripe" esd-custom-block-id="7394" align="center">
        <table class="es-footer-body" width="800" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
        <tbody>
        <tr>true
        <td class="esd-structure es-p40t es-p40b es-p40r es-p40l" align="left">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
        <td class="esd-container-frame" width="520" valign="top" align="center">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
        <td class="esd-block-text footer-mail" align="center">
        <p>Yes Transfert © 2020<b></p>
        <a href="' . $upload . '" class="btnLink">Cliquez ici</a>
        </p><p>Isabelle, Johanna, Thomas, Anthony @ ACS Mulhouse 2020</p>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
    </div>
</body>';

return $mailbody;
}

