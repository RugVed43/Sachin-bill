@extends('layouts.master_plain')

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form  method="POST" action="{{ route('resetpass.store') }}">
            {{ csrf_field() }}
            <div class="card card-login">
                <div class="card-header text-center" data-background-color="rose">
                    <h4 class="card-title">Reset Your Password </h4>

                </div>
                @if (isset($id))
                <input type="hidden" name="type" value="{{ $id }}" >
                @else
                <input type="hidden" name="type" value="USER" >
                @endif
                <div class="card-content">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Username OR Email ID</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
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
