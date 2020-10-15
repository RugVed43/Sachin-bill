@extends('layouts.master')

@section('content')

@component('inc.box')

@slot('title')
Welcome
@endslot
@slot('tools')
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
@endslot
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
	<table class="table table-hover datatables">
		<thead>
			<tr>
				<th>2</th>
				<th>2</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>3</td>
				<td>3</td>
				
			</tr>
		</tbody>
				<tfoot>
			<tr>
				<th>A</th>
				<th>A</th>
				
			</tr>
		</tfoot>
	</table>
</div>

@endcomponent

@endsection
