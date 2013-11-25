/*
	Javascript for MySurvey Project
	Boston University MET CS673
	Software Engineering
	Fall 2013
*/


$(function(){


	 
	 
	 //-------------------- Default Hompage with Login & Register Buttons --------------------//
	 
	 $('#login').hide();
	 $('#register').hide();
	 if($('#register,#login').filter('[data-visible="True"]').show().length){
			 $('#login-logout').hide();
	 }    
	 
	 $('.errorMessage:visible').closest('.row').addClass('error');


	 //-------------------- Show/Hide Login --------------------//
	 $('#sign-in').click(function(){
			
			$('#login-logout').hide();
			$('#login').show();
			$('#register').hide();
			
	 });
	 
	 
	$('#sign-in-btn').click(function(){
			
			$('#login-logout').hide();
			$('#login').show();
			$('#register').hide();
			
		});
	 
	 
	 
		//-------------------- Show/Hide Registration --------------------//
		$('#register-btn').click(function(){
			
			$('#login-logout').hide();
			$('#login').hide();
			$('#register').show();
			
		});
	 
		$('#register-link').click(function(){
			
			$('#login-logout').hide();
			$('#login').hide();
			$('#register').show();
			
		});



	//-------------- Top Half Content Height = Window Size --------------//

	if (($(window).height()) > 700) {
		$('#top-half').css({'height': (($(window).height())-244)+'px'});

		$(window).resize(function(){
			$('#top-half').css({'height':(($(window).height())-244)+'px'});
		});

	}
	else {
		$('#top-half').css({'height': '500px'});
		$('#learn-more').css({'display': 'none'});
	}

});
