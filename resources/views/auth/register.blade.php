@extends('layouts.master_plain')

@section('content')
@component('inc.box')

@slot('title')
Register With Us !
@endslot
@slot('tools')
<a href="{{ route('login') }}" class="btn btn-success btn-flat">Login</a>
@endslot

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    {!! Form::open(['method' => 'POST', 'route' => 'register', 'class' => 'form-horizontal']) !!}
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                {!! Form::label('username', 'Username') !!}
                {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('username') }}</small>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                {!! Form::label('password_confirmation', 'Confirm Password') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'Email address') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
            <div class="form-group{{ $errors->has('phone1') ? ' has-error' : '' }}">
                {!! Form::label('phone1', 'Mobile No') !!}
                {!! Form::text('phone1', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('phone1') }}</small>
            </div>
            <div class="form-group{{ $errors->has('phone2') ? ' has-error' : '' }}">
                {!! Form::label('phone2', 'Alt No') !!}
                {!! Form::text('phone2', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('phone2') }}</small>
            </div>
            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                {!! Form::label('state', 'State') !!}
                {!! Form::text('state','Maharashtra', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('state') }}</small>
            </div>
            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                {!! Form::label('country', 'Country') !!}
                {!! Form::text('country', 'India', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('country') }}</small>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
            {!! Form::label('fname', 'First Name') !!}
            {!! Form::text('fname', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('fname') }}</small>
        </div>
        <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
            {!! Form::label('lname', 'Last Name') !!}
            {!! Form::text('lname', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('lname') }}</small>
        </div>
        <div class="form-group{{ $errors->has('addr1') ? ' has-error' : '' }}">
            {!! Form::label('addr1', 'Address #1') !!}
            {!! Form::text('addr1', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('addr1') }}</small>
        </div>
        <div class="form-group{{ $errors->has('addr2') ? ' has-error' : '' }}">
            {!! Form::label('addr2', 'Address #2') !!}
            {!! Form::text('addr2', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('addr2') }}</small>
        </div>
        <div class="form-group{{ $errors->has('addr3') ? ' has-error' : '' }}">
            {!! Form::label('addr3', 'Address #3') !!}
            {!! Form::text('addr3', null, ['class' => 'form-control']) !!}
            <small class="text-danger">{{ $errors->first('addr3') }}</small>
        </div>
        <div class="form-group{{ $errors->has('addr4') ? ' has-error' : '' }}">
            {!! Form::label('addr4', 'Address #4') !!}
            {!! Form::text('addr4', null, ['class' => 'form-control']) !!}
            <small class="text-danger">{{ $errors->first('addr4') }}</small>
        </div>
        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            {!! Form::label('city', 'City') !!}
            {!! Form::text('city', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('city') }}</small>
        </div>
        <div class="form-group{{ $errors->has('pincode') ? ' has-error' : '' }}">
            {!! Form::label('pincode', 'Pincode') !!}
            {!! Form::text('pincode', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('pincode') }}</small>
        </div>


    </div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
            {!! Form::label('notes', 'Notes') !!}
            {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
            <small class="text-danger">{{ $errors->first('notes') }}</small>
        </div>
    </div>
</div>
{!! Form::submit("Register", ['class' => 'btn btn-success btn-block']) !!}

{!! Form::close() !!}
</div>

@endcomponent
@endsection
