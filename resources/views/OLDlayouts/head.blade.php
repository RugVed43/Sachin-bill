<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('Title', 'App') | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ url('ui/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('ui/plugins/iCheck/flat/blue.css') }}">
  <!-- Morris chart -->
  {{-- <link rel="stylesheet" href="ui/plugins/morris/morris.css"> --}}
  <!-- jvectormap -->
  {{-- <link rel="stylesheet" href="ui/plugins/jvectormap/jquery-jvectormap-1.2.2.css"> --}}
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('ui/plugins/datepicker/datepicker3.css') }}">
  <!-- Daterange picker -->
  {{-- <link rel="stylesheet" href="ui/plugins/daterangepicker/daterangepicker.css"> --}}
  <!-- bootstrap wysihtml5 - text editor -->
  {{-- <link rel="stylesheet" href="ui/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> --}}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/sc-1.4.2/se-1.2.2/datatables.min.css"/>

  <link rel="stylesheet" href="{{ url('ui/plugins/select2/select2.min.css') }}">
    <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('ui/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('ui/dist/css/skins/skin-blue.min.css') }}">
  
  {{-- <link rel="stylesheet" href="{{ url('materialui/dist/css/bootstrap-material-design.min.css') }}">
  <link rel="stylesheet" href="{{ url('materialui/dist/css/ripples.min.css') }}">
  <link rel="stylesheet" href="{{ url('materialui/dist/css/MaterialAdminLTE.min.css') }}">
  <style type="text/css" media="screen">
    .form-group label { color: #000;}
  </style> --}}
</head>