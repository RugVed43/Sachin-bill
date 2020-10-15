@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <p class="category">Total Employees</p>
                <h3 class="card-title">{{ $users->count() }}</h3>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="rose">
                <i class="material-icons">equalizer</i>
            </div>
            <div class="card-content">
                <p class="category">Current Month</p>
                <h3 class="card-title">&#x20b9; {{ $users->count() }}</h3>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="green">
                <i class="material-icons">av_timer</i>
            </div>
            <div class="card-content">
                <p class="category">Previous Month</p>
                <h3 class="card-title">&#x20b9; {{ $users->count() }}</h3>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="fa fa-trophy"></i>
            </div>
            <div class="card-content">
                <p class="category">Highest Attendance Previous Month</p>
                <b class="card-title">
                    {{ $users->count() }}
                </b>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h3 class="title text-center">What Do You Want To Do Today ?</h3>
        <br>
        <div class="nav-center">
            <ul class="nav nav-pills nav-pills-primary nav-pills-icons" role="tablist">
                <!--
                        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                    -->
                <li class="active ">
                    <a href="#newclient-1" role="tab" data-toggle="tab" class="">
                        <i class="material-icons">person_add</i> Add User
                    </a>
                </li>
                <li>
                    <a href="#addnewtask-1" role="tab" data-toggle="tab">
                        <i class="material-icons">track_changes</i> Roles
                    </a>
                </li>
                <li>
                    <a href="#tasks-1" role="tab" data-toggle="tab">
                        <i class="material-icons">attach_money</i> Payments
                    </a>
                </li>
                <li>
                    <a href="#tasks-2" role="tab" data-toggle="tab">
                        <i class="material-icons">gps_fixed</i> Admins
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="newclient-1">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Add a New User here!</h4>

                    </div>
                    <div class="card-content text-center">
                        <a href="#" class="btn btn-success btn-lg"><i class="material-icons">person_add</i> Add</a>

                        <div class="clearfix">

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection