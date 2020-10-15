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
    {!! Form::model($role, ['route' => ['mroles.update', $role->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @else
    {!! Form::open(['method' => 'POST', 'route' => 'mroles.store', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <br>
        <h5><b>Assign Permissions</b></h5>
        @foreach ($permissions  as $permission)
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <div class="well well-sm">
              <div class="checkbox">
                <label>
                  {{ Form::checkbox('permissions[]',  $permission->id , (isset($edit)) ? $role->permissions : null ) }}
                  &nbsp; <b>{{ $permission->name, ucfirst($permission->name) }}</b>
              </label>
          </div>
      </div>
  </div>
  @endforeach
</div>
<hr>
{!! Form::submit("Save !", ['class' => 'btn btn-success btn-lg btn-block']) !!}
{!! Form::close() !!}
@endcomponent
</div>

@endsection
