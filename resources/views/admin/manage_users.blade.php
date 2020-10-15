	@extends('layouts.master')

	@section('content')
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		@component('inc.box')

		@slot('title')
		Users
		@endslot
		@slot('icon')
		people
		@endslot

		<table class="table table-hover datatables">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email ID</th>
					<th>Contact No</th>
					<th>Registered On</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{ $user->fname ." " . $user->lname }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->phone1 }}</td>
					<td>{{ $user->created_at->format('d-m-Y') }}</td>
					<td>
						<form action="{{ route('muser.destroy', $user->id) }}" method="POST">
							<a href="{{ route('muser.edit',$user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
							{{ method_field('DELETE') }}
							{{ csrf_field() }}
							<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Data ?')"><i class="fa fa-trash"></i></button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>Name</th>
					<th>Email ID</th>
					<th>Contact No</th>
					<th>Registered On</th>
					<th>Actions</th>
				</tr>
			</tfoot>
		</table>

		@endcomponent
	</div>
	@endsection
