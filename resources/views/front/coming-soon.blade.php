<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coming soon - Wowness Club Holistic Health and Wellness</title>
  
  <link href="{{ asset('assets/front/forms_steps/css/bootstrap.min.css')}}" rel="stylesheet">
  
          <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Facebook Pixel Code -->
<script>

  !function(f,b,e,v,n,t,s)
  
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  
  n.queue=[];t=b.createElement(e);t.async=!0;
  
  t.src=v;s=b.getElementsByTagName(e)[0];
  
  s.parentNode.insertBefore(t,s)}(window,document,'script',
  
  'https://connect.facebook.net/en_US/fbevents.js');
  
  fbq('init', '737191754714760');
  
  fbq('track', 'PageView');
  
  </script>
  
  <noscript>
  
  <img height="1" width="1"
  
  src="https://www.facebook.com/tr?id=737191754714760&ev=PageView
  
  &noscript=1"/>
  
  </noscript>
  <!-- End Facebook Pixel Code -->

  <!-- Disable Analytic Cookies -->
  <script>window['ga-disable-G-XFH5YHST2Q'] = true; </script>
</head>

<body class='container-fluid'>

  <h1 class='fw-bold text-center titulo-princial'>
    COMING SOON...
  </h1>

  <div class='row justify-content-center p-5'>
    <img class='col-10 col-xl-3 col-md-5' src="{{asset('assets/images/wownesslogobranca.png')}}" alt="">
  </div>

  <h2 class='subtitulo text-center fw-lighter'>A marketplace for holistic health and wellness services, events and experiences.</h2>

  <div class='row justify-content-center d-flex align-items-center gap-5'>
    <div class='col-lg-5 text-center'>
      <h3 class='text-botao text-center fw-bold subtitulo-botao'>Practitioner and service<br> registration open!</br></h3>
      <a class='botao-registrar btn fw-bold my-2' href="{{ route('facilitators.create') }}">
        START REGISTRATION NOW
      </a>
    </div>
    <img class='col-lg-3' src="{{asset('assets/images/mockups.png')}}" alt="">
  </div>

  <style>

    html, body {
    overflow: hidden auto;
    }

    body {
      background: url({{asset('assets/images/bgfundocomingsoon.png')}}) center center; background-repeat: no-repeat;
      min-height: 100vh;
      background-size: cover;
      font-family: lexend;
      color: white;
    }

    .titulo-princial {
      font-size: 45px; margin-top: 60px;
    }

    .subtitulo {
      font-size: 34px;
      margin-bottom: 40px;
    }

    .subtitulo-botao {
      font-size: 41px;
    }

    .botao-registrar {
      font-size: 26px;
      color: white;
      background-color: #7D9A6F;
      padding: 16px 60px;
    }

    @media (max-width: 1303px) {
    .text-botao {font-size: 30px;}
    .botao-registrar {font-size: 15px;}
    .subtitulo {font-size: 28px;}
    .titulo-princial {font-size: 40px;}
    }

    @media (max-width: 500px) {
    .text-botao {font-size: 28px;}
    .botao-registrar {font-size: 14px;}
    .subtitulo {font-size: 24px;}
    .titulo-princial {font-size: 36px;}
    .botao-registrar {padding: 16px 40px;}
    }
  </style>

</body>
</html>