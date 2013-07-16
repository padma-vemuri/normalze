$(function(){
	$('#userid').bind('input propertychange',function(){
		if($(this).val().length > 13)
			$('#loginjs').html('Your userid can not be more than 13 characters');
		else if($(this).val().length <6)
			$('#loginjs').html('Your username can not be less than 6 characters');
		else if($(this).val().length > 6 && $(this).val().length < 13)
			$('#loginjs').html('');
});});

	$('#password').bind('input propertychange',function(){
		if($(this).val().length < 8)
			$('#passwordjs').html('Your password can not be less than 8 characters');
		else if($(this).val().length > 8)
			$('#passwordjs').html('');	



});
	$('#casenumber').bind('input propertychange',function(){
		if($(this).val().length > 15)
			$('#casenumberjs').html('Your Issue Number can not be more than 15 characters');
		else if($(this).val().length < 15)
			$('#casenumberjs').html('');	
	});

	setTimeout(function(){
		$("p.sucesslog").hide('blind',{},500)
	},5000);






$(function() {
	$( "#reporteddate" ).datepicker();
	
});

