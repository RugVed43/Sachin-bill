<!doctype html>
<html lang="en">


<!-- dashboard.html29:18 GMT -->
@include('layouts.head')

<body>
    <div class="wrapper">
        @include('layouts.lmenu')
        <div class="main-panel">
            @include('layouts.navbar')
            @if (Session::has('auth_error'))
            
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error !</strong> <br>
                {{ Session::get('auth_error') }} ...
            </div>
            
            @endif
            <div class="content">
                <div class="container-fluid">
                    @yield('content', '&nbsp;')
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>
    {{-- @include('layouts.rsidebar') --}}
</body>
@include('layouts.foot')
</html>