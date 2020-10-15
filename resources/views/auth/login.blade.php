@extends('layouts.master_plain')

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form  method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="card card-login">
                <div class="card-header text-center" data-background-color="rose">
                    <h4 class="card-title">Login</h4>
                    <div class="social-line">
                        <a href="{{ url('auth/facebook') }}" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                        <!-- <a href="#pablo" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-twitter"></i>
                        </a> -->
                        <a href="{{ url('auth/google') }}" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
                <p class="category text-center">
                    <a class="" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                    | 
                    <a class="" href="{{ route('register') }}">
                        Register Now
                    </a>
                </p>
                <div class="card-content">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Let's go</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
