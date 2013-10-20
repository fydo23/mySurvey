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
    $('[draggable]').on({
        drag:function(event){
            $(this).addClass('dragging');
        },
        dragend:function(event){
            $('.dragging').removeClass('dragging');
        },    
        drop: function(event){
            $(this).siblings('[draggable]').andSelf().each(function(idx,elem){
                $(elem).find('.order_number').val(idx);
            });
            $.post($(this).closest('form').attr('action'),$(this).closest('form').serialize());
            return false;
        }, 
        dragover:function(event){
            if($(this).prevAll('.dragging').length){
                $(this).after($('.dragging'));
            }else if($(this).nextAll('.dragging').length){
                $(this).before($('.dragging'));
            }
            return false;
        }
    });

});


    function reorder_questions(){
        $.ajax({
            
        });
    }