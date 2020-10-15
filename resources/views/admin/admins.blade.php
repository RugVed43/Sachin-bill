@extends('layouts.master')

@section('content')
@component('inc.box')

@slot('title')
Welcome
@endslot
@slot('tools')
{{-- tools --}}
@endslot

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
	<table class="table table-hover datatables">
		<thead>
			<tr>
				<th>Name</th>
				<th>Roles</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($admins as $admin)
			<tr>
				<td>{{ $admin->username }}</td>
				<td>{{  $admin->roles()->pluck('name')->implode(' ') }}</td>
				<td>
					<div style="width: 20%">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<a href="{{ route('madmin.edit',$admin->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>			
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form action="{{ route('madmin.destroy', $admin->id) }}" method="POST">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button type="submit" class="btn btn-danger" onclick="return confirm('You really want to delted this item ?')"><i class="fa fa-trash"></i></button>
							</form>
						</div>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th>Name</th>
				<th>Roles</th>
				<th>Actions</th>
			</tr>
		</tfoot>
	</table>
</div>

@endcomponent
@endsection
