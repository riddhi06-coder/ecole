<head>
    
    @if (request()->is('thank-you') || request()->is('ecole-thank-you'))
        <meta name="robots" content="noindex, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    @else
        <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    @endif
    
    
    @if(!request()->is('ecole-thank-you'))

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-2XZBVR294D"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
    
          gtag('config', 'G-2XZBVR294D');
        </script>
    
        <!-- Google Tag Manager -->
        <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-T6GJPHTX');
        </script>
        <!-- End Google Tag Manager -->
    
    @endif
    
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Best International School in Juhu - Mumbai - Ecole Mondiale World School</title>
  <meta name="description" content="Ecole Mondiale World School in Juhu, Mumbai, is a premier international school offering holistic education, modern facilities, and global learning opportunities for students.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="dns-prefetch" href="https://www.googletagmanager.com">

  <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/owlcarousel/owl.carousel.min.css') }}" media="print" onload="this.media='all'">

  <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
  
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">

  <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/img/emws-logo.png') }}">


</head>