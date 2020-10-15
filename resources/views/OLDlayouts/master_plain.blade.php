<!DOCTYPE html>
<html>
@include('layouts.head')
<body class="hold-transition skin-blue  sidebar-collapse">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>pp</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>App</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
      </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('content-header', '&nbsp;')
          <small> @yield('content-header-small', '&nbsp;')</small>
        </h1>
        <ol class="breadcrumb">
         @yield('breadcrumb', '&nbsp;')
       </ol>
     </section>

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          @yield('content')
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.footer')

  <!-- Control Sidebar -->

</div>
<!-- ./wrapper -->

@include('layouts.foot')

</body>
</html>
