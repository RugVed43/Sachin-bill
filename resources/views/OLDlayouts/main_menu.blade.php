  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>pp</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>A</b>pp</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- Messages: style can be found in dropdown.less-->
            {{-- @include('layouts.notify_messages') --}}
            <!-- Notifications: style can be found in dropdown.less -->
            {{-- @include('layouts.notify_notifications') --}}
            <!-- Tasks: style can be found in dropdown.less -->
            {{-- @include('layouts.notify_tasks') --}}
            <!-- User Account: style can be found in dropdown.less -->
            @include('layouts.user_menu')
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>