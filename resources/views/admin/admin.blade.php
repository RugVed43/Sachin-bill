@extends('layouts.master')

@section('content')
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  @component('inc.box')

  @slot('title')
  User Data Form
  @endslot
  @slot('tools')
  {{-- tools --}}
  @endslot
  @if (isset($edit))
  {!! Form::model($admin, ['route' => ['madmin.update', $admin->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
  @else
  {!! Form::open(['method' => 'POST', 'route' => 'madmin.store', 'class' => 'form-horizontal']) !!}
  @endif
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
      <li><a href="#tab_2" data-toggle="tab">Roles</a></li>
      <li><a href="#tab_3" data-toggle="tab">Permissions</a></li>
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
      <div class="tab-pane" id="tab_2">
       @foreach ($roles as $role) 
       <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        <div class="well well-sm">
          <div class="checkbox">
            <label>
              {{ Form::checkbox('roles[]',  $role->id,(isset($edit)) ? null : null ) }}
              &nbsp; <b>{{ $role->name, ucfirst($role->name) }}</b>
            </label>
          </div>
        </div>
      </div>
      @endforeach
      <p>&nbsp;</p>
      <div class="clearfix"></div>
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_3">
      @foreach ($permissions  as $permission)
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        <div class="well well-sm">
          <div class="checkbox">
            <label>
              {{ Form::checkbox('permissions[]',  $permission->id , (isset($edit)) ? $user->permissions()->where('permission_id',$permission->id)->first() : null ) }}
              &nbsp; <b>{{ $permission->name, ucfirst($permission->name) }}</b>
            </label>
          </div>
        </div>
      </div>
      @endforeach
      <p>&nbsp;</p>
      <div class="clearfix"></div>

      {{-- {{ dd($user->roles()->get())  }} --}}
    </div>
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
