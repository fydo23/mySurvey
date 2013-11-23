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

		$('#top-half').css({'height': (($(window).height())-244)+'px'});

		$(window).resize(function(){
			$('#top-half').css({'height':(($(window).height())-244)+'px'});
		});
                
                
        //-------------- Survey delete and unpublish confirmation --------------//
        
	$(function(){
		$('.delete-confirm').on('click', function(e){
			e.preventDefault();
		})
		$('.delete-confirm').confirmOn('click', function(e, confirmed){
			if(confirmed) window.location = $(e.target).attr('href');
		});
	});
        
	$(function(){
		$('.unpublish-confirm').on('click', function(e){
			e.preventDefault();
		})
		$('.unpublish-confirm').confirmOn(
                        {questionText: 'If you unpublish the survey and plan to publish it again, you will lose the current submissions. Do you still want to continue?'} ,'click', function(e, confirmed){
			if(confirmed) window.location = $(e.target).attr('href');
		});
	});
        
});
