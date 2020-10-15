@extends('layouts.master_plain')

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        {!! Form::open(['method' => 'POST', 'route' => 'resetpass.store', 'class' => 'form-horizontal','files' => true ]) !!}
            <div class="card card-login">
                <div class="card-header text-center" data-background-color="rose">
                    <h4 class="card-title">Reset Your Password </h4>
                </div>
                <input type="hidden" name="respasstoken" value="{{ $respass->token }}" >
                <div class="card-content">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">New Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Confirm Password</label>
                            <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                            @if ($errors->has('confirm_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Let's go</button>
                </div>
            </div>
             {!! Form::close() !!}
    </div>
</div>
@endsection
