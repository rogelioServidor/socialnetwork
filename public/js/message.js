$(document).ready(function(){
	doRun();
});


function doRun(){
	$('#sendBtn').on('click',function(){
		var input = $('#inputMessage').val();
		var output = "<p>"+ input +"</p>";
		$('#outputMessage').append(output);
		$('#inputMessage').val('');
		$('#outputMessage').prop({ scrollTop: $('#outputMessage').prop('scrollHeight') });
	});

	/*$('#inputMessage').on('focus',function(){
		$(document).on('keydown',function(event){
			if(event.keyCode == 13){
				var input = $('#inputMessage').val();
				var output = "<p>"+ input +"</p>";
				$('#outputMessage').append(output);
				$('#inputMessage').val('');
			}
		});
	});*/
	$(document).on('keydown',function(event){
		if(event.keyCode === 13 && event.shiftKey === false){
			var input = $('#inputMessage').val();
			var output = "<p>"+ input +"</p>";
			$('#outputMessage').append(output);
			$('#inputMessage').val('');
			$('#outputMessage').prop({ scrollTop: $('#outputMessage').prop('scrollHeight') });
		}
	});
	
}