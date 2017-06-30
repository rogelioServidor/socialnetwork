@extends('layouts.master')

@section('title')
	Edit Profile
@endsection

@section('content')
	<div>
		@if(Session::has('updateSuccess'))
			<div class="alert alert-success">
				{{ Session::get('updateSuccess') }}
			</div>
		@endif
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Edit Profile</div>
		<div class="panel-body">
			<form action="{{ url('/updateProfile') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
				<div class="form-group {{ $errors->has('firstname') ? 'has-error': '' }}">
					<label for="firstname">Firstname: </label>
					<input class="form-control" type="text" name="firstname" value="{{ $user->firstname }}">
					@if($errors->has('firstname'))
						<span class="help-block">
							{{ $errors->first('firstname') }}
						</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('lastname') ? 'has-error': '' }}">
					<label for="lastname">Lastname: </label>
					<input class="form-control" type="text" name="lastname" value="{{ $user->lastname }}">
					@if($errors->has('lastname'))
						<span class="help-block">
							{{ $errors->first('lastname') }}
						</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('newPassword') ? 'has-error': '' }}">
					<label for="password">New Password: </label>
					<input class="form-control" type="password" name="newPassword">
					@if($errors->has('newPassword'))
						<span class="help-block">
							{{ $errors->first('newPassword') }}
						</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('confirmPassword') ? 'has-error': '' }}">
					<label for="password">Confirm Password: </label>
					<input class="form-control" type="password" name="confirmPassword">
					@if($errors->has('confirmPassword'))
						<span class="help-block">
							{{ $errors->first('confirmPassword') }}
						</span>
					@endif
				</div>
				<div class="form-group">
					<label for="profile_pic">Upload Image: </label>
					<input class="form-control" type="file" name="profile_pic">
				</div>
				<div>
					<button class="btn btn-danger" type="submit">Edit</button>
				</div>
			</form>
		</div>
	</div>

@endsection