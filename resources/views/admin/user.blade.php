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
	{!! Form::model($user, ['route' => ['muser.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal'])
	!!}
	@else
	{!! Form::open(['method' => 'POST', 'route' => 'muser.store', 'class' => 'form-horizontal']) !!}
	@endif
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
			<li><a href="#tab_2" data-toggle="tab">Address</a></li>
			<li><a href="#tab_3" data-toggle="tab">Kyc</a></li>
			<li><a href="#tab_4" data-toggle="tab">Misc</a></li>
			<li><a href="#tab_5" data-toggle="tab">Contact</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
							{!! Form::label('fname', 'First Name') !!}
							{!! Form::text('fname', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('fname') }}</small>
						</div>
						<div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
							{!! Form::label('lname', 'Last Name') !!}
							{!! Form::text('lname', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('lname') }}</small>
						</div>
						<div class="form-group{{ $errors->has('bname') ? ' has-error' : '' }}">
							{!! Form::label('bname', 'Business Name') !!}
							{!! Form::text('bname', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('bname') }}</small>
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
							{!! Form::password('password', ['class' => 'form-control', !isset($edit) ? 'required' : null  ]) !!}
							<small class="text-danger">{{ $errors->first('password') }}</small>
						</div>
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							{!! Form::label('email', 'Email Id') !!}
							{!! Form::text('email', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('email') }}</small>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_2">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group{{ $errors->has('addr1') ? ' has-error' : '' }}">
							{!! Form::label('addr1', 'Address #1') !!}
							{!! Form::text('addr1', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('addr1') }}</small>
						</div>
						<div class="form-group{{ $errors->has('addr2') ? ' has-error' : '' }}">
							{!! Form::label('addr2', 'Address #2') !!}
							{!! Form::text('addr2', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('addr2') }}</small>
						</div>

					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group{{ $errors->has('addr3') ? ' has-error' : '' }}">
							{!! Form::label('addr3', 'Address #3') !!}
							{!! Form::text('addr3', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('addr3') }}</small>
						</div>
						<div class="form-group{{ $errors->has('addr4') ? ' has-error' : '' }}">
							{!! Form::label('addr4', 'Address #4') !!}
							{!! Form::text('addr4', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('addr4') }}</small>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
							{!! Form::label('country', 'Country') !!}
							{!! Form::text('country', 'India', ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('country') }}</small>
						</div>
						<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
							{!! Form::label('city', 'City') !!}
							{!! Form::text('city', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('city') }}</small>
						</div>

					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
							{!! Form::label('state', 'State') !!}
							{!! Form::text('state', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('state') }}</small>
						</div>

					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_3">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-dark">
						<thead>
							<tr>
								<th scope="col">ID Type</th>
								<th scope="col">Number</th>
								<th scope="col">Scan / Copy</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">AADHAAR CARD</th>
								<td>
									<div class="form-group{{ $errors->has('kyc_aadhar') ? ' has-error' : '' }}">
										{!! Form::text('kyc_aadhar', null, ['class' => 'form-control']) !!}
										<small class="text-danger">{{ $errors->first('kyc_aadhar') }}</small>
									</div>
								</td>
								<td style="text-align: center">
									<div class="form-group{{ $errors->has('kyc_aadhar_copy') ? ' has-error' : '' }}">
										<div class="fileinput fileinput-new text-center" data-provides="fileinput">
											<div>
												<span class="btn btn-rose btn-round btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="kyc_aadhar_copy" id="kyc_aadhar_copy" />
												</span>
												<a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
													data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
												<span class="fileinput-filename"></span>
											</div>
										</div>
										<small class="text-danger">{{ $errors->first('kyc_aadhar_copy') }}</small>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">PASSPORT</th>
								<td>
									<div class="form-group{{ $errors->has('kyc_passport') ? ' has-error' : '' }}">
										{!! Form::text('kyc_passport', null, ['class' => 'form-control']) !!}
										<small class="text-danger">{{ $errors->first('kyc_passport') }}</small>
									</div>
								</td>
								<td style="text-align: center">
									<div class="form-group{{ $errors->has('kyc_passport_copy') ? ' has-error' : '' }}">
										<div class="fileinput fileinput-new text-center" data-provides="fileinput">
											<div>
												<span class="btn btn-rose btn-round btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="kyc_passport_copy"
														id="kyc_passport_copy" />
												</span>
												<a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
													data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
												<span class="fileinput-filename"></span>
											</div>
										</div>
										<small class="text-danger">{{ $errors->first('kyc_passport_copy') }}</small>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">PAN CARD</th>
								<td>
									<div class="form-group{{ $errors->has('kyc_pan') ? ' has-error' : '' }}">
										{!! Form::text('kyc_pan', null, ['class' => 'form-control']) !!}
										<small class="text-danger">{{ $errors->first('kyc_pan') }}</small>
									</div>
								</td>
								<td style="text-align: center">
									<div class="form-group{{ $errors->has('kyc_pan_copy') ? ' has-error' : '' }}">
										<div class="fileinput fileinput-new text-center" data-provides="fileinput">
											<div>
												<span class="btn btn-rose btn-round btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="kyc_pan_copy" id="kyc_pan_copy" />
												</span>
												<a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
													data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
												<span class="fileinput-filename"></span>
											</div>
										</div>
										<small class="text-danger">{{ $errors->first('kyc_pan_copy') }}</small>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">DRIVING LICENSE</th>
								<td>
									<div class="form-group{{ $errors->has('kyc_driving') ? ' has-error' : '' }}">
										{!! Form::text('kyc_driving', null, ['class' => 'form-control']) !!}
										<small class="text-danger">{{ $errors->first('kyc_driving') }}</small>
									</div>
								</td>
								<td style="text-align: center">
									<div class="form-group{{ $errors->has('kyc_driving_copy') ? ' has-error' : '' }}">
										<div class="fileinput fileinput-new text-center" data-provides="fileinput">
											<div>
												<span class="btn btn-rose btn-round btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="kyc_driving_copy" id="kyc_driving_copy" />
												</span>
												<a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
													data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
												<span class="fileinput-filename"></span>
											</div>
										</div>
										<small class="text-danger">{{ $errors->first('kyc_driving_copy') }}</small>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">OTHERS</th>
								<td>
									<div class="form-group{{ $errors->has('kyc_other') ? ' has-error' : '' }}">
										{!! Form::text('kyc_other', null, ['class' => 'form-control']) !!}
										<small class="text-danger">{{ $errors->first('kyc_other') }}</small>
									</div>
								</td>
								<td style="text-align: center">
									<div class="form-group{{ $errors->has('kyc_other_copy') ? ' has-error' : '' }}">
										<div class="fileinput fileinput-new text-center" data-provides="fileinput">
											<div>
												<span class="btn btn-rose btn-round btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="kyc_other_copy" id="kyc_other_copy" />
												</span>
												<a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
													data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
												<span class="fileinput-filename"></span>
											</div>
										</div>
										<small class="text-danger">{{ $errors->first('kyc_other_copy') }}</small>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane" id="tab_4"></div>
			<div class="tab-pane" id="tab_5">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group{{ $errors->has('phone1') ? ' has-error' : '' }}">
							{!! Form::label('phone1', 'Phone #1') !!}
							{!! Form::number('phone1', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('phone1') }}</small>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group{{ $errors->has('phone2') ? ' has-error' : '' }}">
							{!! Form::label('phone2', 'Phone #2') !!}
							{!! Form::number('phone2', null, ['class' => 'form-control']) !!}
							<small class="text-danger">{{ $errors->first('phone2') }}</small>
						</div>
					</div>
				</div>
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