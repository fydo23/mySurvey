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


    //DRAGGABLE CONTENT
    $('ul#sortable').sortable({
        items: '> li',
        start:function(event, ui){
            $(ui.item).addClass('dragging');
        },
        stop:function(event, ui){
            $(ui.item).removeClass('dragging');
            $(ui.item).siblings().andSelf().each(function(idx,elem){
                $(elem).find('.order_number').val(idx);
            });
            $.post(
                $(ui.item).closest('form').attr('action'),
                $(ui.item).closest('form').serialize()
            );
        }
    });

});