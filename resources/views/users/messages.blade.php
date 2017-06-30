@extends('layouts.master')

@section('title')
	Messages
@endsection

@section('content')
	<h3>Messages</h3>
	<hr>
	<div id="userId" class="form-group">
		<input class="form-control" type="text" name="userId" placeholder="User Id">
	</div>
	<div id="chatbox">
		<div id="chatdisplay">
			<div class="user-photo"></div>
			<div id="outputMessage"></div>
		</div>
		<div id="chatform">
			<textarea id="inputMessage" class="form-control"></textarea>
			<button class="btn btn-primary" id="sendBtn">Send</button>
		</div>
	</div>

	<script type="text/javascript" src="js/message.js"></script>
@endsection

