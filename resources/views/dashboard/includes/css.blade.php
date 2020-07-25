<meta name="description" content="E-commerce Dashboard Version One">
<meta name="author" content="Ali Labib">
<meta name="robots" content="noindex, nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Open Graph Meta -->
<meta property="og:title" content="E-commerce Dashboard Version One">
<meta property="og:site_name" content="E-commerce">
<meta property="og:description" content="E-commerce Dashboard Version One">
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:image" content="">

<!-- Icons -->
<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
<link rel="shortcut icon" href="{{asset('/')}}media/favicons/favicon.png">
<link rel="icon" type="image/png" sizes="192x192" href="{{asset('/')}}media/favicons/favicon-192x192.png">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}media/favicons/apple-touch-icon-180x180.png">
<!-- END Icons -->
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{asset('/')}}js/plugins/select2/css/select2.min.css">


<!-- Stylesheets -->
<!-- Fonts and OneUI framework -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
<link rel="stylesheet" id="css-main" href="{{asset('/')}}css/oneui.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@yield('css')
