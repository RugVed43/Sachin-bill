<!DOCTYPE html>
<html>
@include('layouts.head')
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
  <div class="wrapper">

    @include('layouts.main_menu')

    <!-- Left side column. contains the logo and sidebar -->

    @include('layouts.lmenu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @hasSection('header-content')
      <section class="content-header">
       @yield('head-content', '&nbsp;')
       <h1>
        @yield('content-header', '&nbsp;')
        <small> @yield('content-header-small', '&nbsp;')</small>
      </h1>
      <ol class="breadcrumb">
       @yield('breadcrumb', '&nbsp;')
     </ol>
   </section>
   @else
   &nbsp;
   @endif
   <!-- Content Header (Page header) -->


   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        @if ( Session::has('auth_error'))
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Error !</strong><br> {{ Session::get('auth_error') }}
        </div>
        @endif
        @yield('content')
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('layouts.footer')

<!-- Control Sidebar -->
{{-- @include('layouts.rmenu') --}}

</div>
<!-- ./wrapper -->

@include('layouts.foot')

</body>
</html>
