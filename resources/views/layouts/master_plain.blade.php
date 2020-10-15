<!doctype html>
<html lang="en">
@include('layouts.head')

<body>
    @include('layouts.navbar_plain')
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="{{ url('./public/ui/img/login.jpg') }}">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    @yield('content', '&nbsp;')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.foot')
</body>
</html>

