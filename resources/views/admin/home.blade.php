@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h3 class="title text-center">Generate New Bill</h3>
		<br>
		<div class="card">
			<div class="card-content">
				{!! Form::open(['method' => 'POST', 'route' => 'muser.store', 'class' => 'form-horizontal']) !!}
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						{!! Form::label('name', 'Customer Name') !!}
						{!! Form::text('name', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('name') }}</small>
					</div>
					<div class="form-group{{ $errors->has('plan_name') ? ' has-error' : '' }}">
						{!! Form::label('plan_name', 'Package') !!}
						{!! Form::text('plan_name', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('plan_name') }}</small>
					</div>
					<div class="form-group{{ $errors->has('balance') ? ' has-error' : '' }}">
						{!! Form::label('balance', 'Pending Balance') !!}
						{!! Form::text('balance', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('balance') }}</small>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group{{ $errors->has('numbers') ? ' has-error' : '' }}">
						{!! Form::label('numbers', 'Contact Numbers') !!}
						{!! Form::text('numbers', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('numbers') }}</small>
					</div>
					<div class="form-group{{ $errors->has('mrp') ? ' has-error' : '' }}">
						{!! Form::label('mrp', 'MRP') !!}
						{!! Form::text('mrp', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('mrp') }}</small>
					</div>
					<div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
						{!! Form::label('total', 'Total Bill Amt') !!}
						{!! Form::text('total', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('total') }}</small>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
						{!! Form::label('address', 'Address') !!}
						{!! Form::text('address', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('address') }}</small>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<div class="form-group{{ $errors->has('bill_date') ? ' has-error' : '' }}">
						{!! Form::label('bill_date', 'Bill Date') !!}
						{!! Form::text('bill_date', null, ['class' => 'form-control datepicker']) !!}
						<small class="text-danger">{{ $errors->first('bill_date') }}</small>
					</div>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<div class="form-group{{ $errors->has('due_date') ? ' has-error' : '' }}">
						{!! Form::label('due_date', 'Due Date') !!}
						{!! Form::text('due_date', null, ['class' => 'form-control datepicker']) !!}
						<small class="text-danger">{{ $errors->first('due_date') }}</small>
					</div>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<div class="form-group{{ $errors->has('expiry') ? ' has-error' : '' }}">
						{!! Form::label('expiry', 'Expiry Date') !!}
						{!! Form::text('expiry', null, ['class' => 'form-control datepicker' ]) !!}
						<small class="text-danger">{{ $errors->first('expiry') }}</small>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
						{!! Form::label('notes', 'Notes') !!}
						{!! Form::text('notes', null, ['class' => 'form-control']) !!}
						<small class="text-danger">{{ $errors->first('notes') }}</small>
					</div>
				</div>
				<div class="clearfix"></div>
				{!! Form::submit("Get Bill !", ['class' => 'btn btn-danger btn-lg btn-block']) !!}
				{!! Form::close() !!}

				<div class="clearfix"></div>
				<br>
			</div>
		</div>
	</div>
</div>
@endsection