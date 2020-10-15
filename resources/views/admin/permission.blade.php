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
    {!! Form::model($permission, ['route' => ['mpermissions.update', $permission->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @else
    {!! Form::open(['method' => 'POST', 'route' => 'mpermissions.store', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
    </div>
    @if(!$roles->isEmpty()) {{-- //If no roles exist yet --}}
    <h4>Assign Permission to Roles</h4>
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
@endif
<br>
<hr>
{!! Form::submit("Save !", ['class' => 'btn btn-success btn-lg btn-block']) !!}
{!! Form::close() !!}
@endcomponent
</div>

@endsection
