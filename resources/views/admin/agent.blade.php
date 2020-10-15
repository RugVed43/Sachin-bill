@extends('layouts.master')

@section('content')
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  @component('inc.box')

  @slot('title')
  agent Data Form
  @endslot
  @slot('tools')
  {{-- tools --}}
  @endslot
  @if (isset($edit))
  {!! Form::model($agent, ['route' => ['magent.update', $agent->id], 'method' => 'PUT', 'class' => 'form-horizontal','files' => true ]) !!}
  @else
  {!! Form::open(['method' => 'POST', 'route' => 'magent.store', 'class' => 'form-horizontal','files' => true ]) !!}
  @endif
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
      <li><a href="#tab_2" data-toggle="tab">Tab2</a></li>
      <li><a href="#tab_3" data-toggle="tab">Tab3</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
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
          </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
              {!! Form::label('username', 'Username') !!}
              {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('username') }}</small>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {!! Form::label('password', 'Password') !!}
              {!! Form::password('password', ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>

          </div>
        </div>
        <div class="clearfix"></div>

        <hr>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!! Form::label('email', 'Email Id') !!}
              {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
          </div>
        </div>
        <p>&nbsp;</p>
        <div class="clearfix"></div>

      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2"></div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_3"></div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
  <hr>
  {!! Form::submit("Save !", ['class' => 'btn btn-success btn-lg btn-block']) !!}
  {!! Form::close() !!}
  @endcomponent
</div>

@endsection
