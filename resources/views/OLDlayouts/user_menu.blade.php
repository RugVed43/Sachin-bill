<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="{{ url('ui/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
    <span class="hidden-xs">
      {{ $user->fname }}
    </span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="{{ url('ui/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

      <p>
       {{ $user->fname . " " . $user->lname }}
     </p>
   </li>
   <!-- Menu Body -->
    {{-- <li class="user-body">
      <div class="row">
        <div class="col-xs-4 text-center">
          <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Friends</a>
        </div>
      </div>
      <!-- /.row -->
    </li> --}}
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="#" class="btn btn-default btn-flat">Profile</a>
      </div>
      <div class="pull-right">
        @if (Auth::guard('admin')->check())
        {!! Form::open(['method' => 'POST', 'route' => 'admin_logout', 'class' => 'form-horizontal']) !!}        
        @else
        {!! Form::open(['method' => 'POST', 'route' => 'logout', 'class' => 'form-horizontal']) !!}        @endif
        
        {!! Form::submit("Sign Out", ['class' => 'btn btn-default btn-flat']) !!}

        {!! Form::close() !!}
        {{-- <a href="#" class="btn btn-default btn-flat">Sign out</a> --}}
      </div>
    </li>
  </ul>
</li>