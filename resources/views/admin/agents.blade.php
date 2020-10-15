@extends('layouts.master')

@section('content')
@component('inc.box')

@slot('title')
agents
@endslot
@slot('tools')
{{-- tools --}}
@endslot

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
  <table class="table table-hover datatables">
    <thead>
      <tr>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($agents as $agent)
      <tr>
        <td style="width: 20%">{{ $agent->name }}</td>
        <td>
          <div style="width: 20%">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <a href="{{ route('magent.edit',$agent->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>     
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <form action="{{ route('magent.destroy', $agent->id) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger"  onclick="return confirm('You really want to delted this item ?')"><i class="fa fa-trash"></i></button>
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
        <th>Actions</th>
      </tr>
    </tfoot>
  </table>
</div>

@endcomponent
@endsection
