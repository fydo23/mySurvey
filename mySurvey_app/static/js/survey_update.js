
$(function(){

    var strategy = {
        question: {
            //question
            add:function(event){
                //add question, focus first input
                var sortable = $(event.target).attr('data-target');

                var newItem = $(sortable).find('.template').first().clone().removeClass('template');

                //enable all non-template input/select
                newItem.find('input, select').filter(function(){
                    return !$(this).closest('.template').length;
                }).removeAttr('disabled');

                $(sortable).find('>.trash').before(newItem);

                // display/focus the new element's text field.
                newItem.find('.edit:first').trigger('click');

                //fix the input post order
                fix_sub_sortable_target(newItem);
            }
        },
        answer:{
            0:{//short answer
                add:function(event){
                    //add answer, don't focus
                    //add question, return question
                    var sortable = $(event.target).closest('li').find('.sortable');
                    var newItem = sortable.find('.template').first().clone();
                    newItem.removeClass('template').find('input, select').removeAttr('disabled');
                    $(sortable).find('.trash').last().before(newItem.hide());
                    return newItem;
                },
                change:function(event){
                    //add blank answer, 
                    this.add(event);
                    //hide add-sortable button
                    $(event.target).closest('li').find('.add-sortable').hide();
                }
            },
            1:{//true false
                add:function(event){
                    //add question, don't focus
                    var sortable = $(event.target).closest('li').find('.sortable');
                    var newItem = sortable.find('.template').first().clone();
                    newItem.removeClass('template').find('input, select').removeAttr('disabled');
                    newItem.find('.delete').hide();
                    $(sortable).find('.trash').last().before(newItem);
                    return newItem;
                },
                change:function(event){
                    //add two answers, focus first;
                    var true_answer = this.add(event);
                    true_answer.find('input[type=text]').val('True');
                    true_answer.find('.text').html('True');
                    var false_answer = this.add(event);
                    false_answer.find('input[type=text]').val('False');
                    false_answer.find('.text').html('False');
                    //hide add sortable button
                    $(event.target).closest('li').find('.add-sortable').hide();
                    //hide add-sortable button
                }
            },
            2:{//multiple choice
                add:function(event){
                    strategy.question.add(event);
                },
                change:function(event){
                    $(event.target).find('.add-sortable').show();
                }
            }
        }
   }
   //mutiple slect behaves the same as mutlple choice;
   strategy.answer[3] = strategy.answer[2]; 

    /*Initialize the sortables.*/
    do_sortables();


    /**
     * Deactivates actively editing questions when clicking outside the sortable element.
     */
	$(window).on('click',function(e){
		var clickedActiveQuestion = $(e.target).closest('.active').length || $(e.target).hasClass('active');
		if(!clickedActiveQuestion){
			$('.active a.edit').trigger('click');
		}
	});
	


    /**
     * Event handler for editing a list item. Triggered by clicking the edit link.
     * This function toggles the text editing of quesitons.
     */
	$('.sortable').on('click','a.edit',function(e){
		e.stopPropagation();//allows us to catch window click outside event.
		e.preventDefault();//stops the link from following the url
        var editable = $(this).closest('[data-editable]');
		if(!editable.hasClass('active')){
            //close other editors.
			$('.active a.edit').trigger('click');
			editable.addClass('active');
            editable.find('[data-hide-on-edit]').hide();
            editable.find('[data-show-on-edit]').show().first().focus();
		}else{
            //stop editing function.
			editable.removeClass('active');
            editable.find('[data-show-on-edit]').hide().each(function(idx,elem){
                var html = $(elem).val();
                if($(elem).is('select')){
                    html = $(elem).find('option[value='+$(elem).val()+']').text();
                }
                editable.find($(elem).attr('data-source')).html(html);
            });
            editable.find('[data-hide-on-edit]').show();
		}
	});
      


    /**
     * This event handles the deletion of list items. It hides the item
     * apends it after the .trash item.
     */
    $('.sortable').on('click','a.delete',function(e){
		e.preventDefault();//stops the link from following the url
        e.stopPropagation();
		var listItem = $(this).closest('li');
		listItem.hide().attr('data-deleted',"True").find('input[name*=delete]').val("True");
        //move deleted items after trash item to allows the preservation of order_num.
        listItem.siblings('.trash').after(listItem.detach());
        fix_sortable_input_names();
        var sortable_id = listItem.closest('.sortable').attr('id');
        $('[data-target=#'+sortable_id+']').show();
	});



    /**
     * Adds a sortable element by coping the hidden template at the head of the sortable.
     * (Delegates function call to 'add' strategy. It then updates the naem attributes
     * of all form elements.
     */
	$('form').on('click',':not(.template) .add-sortable', function(event){
        event.preventDefault(); 
        event.stopPropagation(); 

        //add sortable functionality to the newly added item.
        do_sortables();

        //let the strategy pattern handle the non-default actions.
        if($(event.target).data('model') == 'question'){
            strategy.question.add(event);
        }else{
            var questionType = $(event.target).closest('li').find('[name*=type]').val();
            strategy.answer[questionType].add(event);
        }
        //add the new element before the delete selements that are stored at the end of the list
        fix_sortable_input_names();
	});


    /**
     * OnChange event of a any input named type, deletes all existing sub_sortable elemnts.
     * Delegates the function call to the appropriate change strategy. 
     */
    $('#questions').on('change', '[name*=type]',function(event){
        var question = $(this).closest('li');
        //delete all previous answers.
        question.find('.sortable li:not(.template) .delete').trigger('click');
        //update add-sortable button.
        question.find('.add-sortable').attr('data-parent-type',$(this).val());
        strategy.answer[$(this).val()].change(event);
        //add the new element before the delete selements that are stored at the end of the list
        fix_sortable_input_names();
    });
      

    /**
     * Handels the draggable items enabled by jquery-ui.
     */
    function do_sortables(){
        $('.sortable').sortable({
            items: '> li:not(.trash, [data-deleted], .template)',
            start:function(event, ui){
                $(ui.item).addClass('dragging');
            },
            stop:function(event, ui){      
                $(ui.item).removeClass('dragging');
                fix_sortable_input_names();
            }
        });
    };


    /**
     * Change the name of attribute to reflect survey new order_number which are
     * Propogated into 'name' attribute. This function makes sure to format the 
     * name attribute to make the resulting $_POST array contains a list of sortable 
     * items with each index reflecting the element's order_number and respective parent 
     * model. This function should be called whenever a sort update is made to the list.
     * 
     * The expected name schem should be:
     *      sortable1[sortable1_indexes][sortable2][sortable2_indexes][[...][...]etc...]['attributes']
     * (ie. expected name attributers are: SurveyQuestion[1][SurveyAnswer][2][choice_letter]['text'])
     * 
     */
    function fix_sortable_input_names(){
        $('#questions').find('li:not(.template, .trash)').find('input, select').each(function(idx, input){ 
            //get the old name
            var old_name = $(input).attr('name');

            //fix top level order number...
            var farthest_li = $(input).parents('.sortable li').last();
            var top_order = farthest_li.siblings().andSelf().not('.trash, .template').index( farthest_li ); 
            top_fixed = old_name;
            if(top_order > -1){
                var top_fixed = old_name.split('[').slice(0,1) + "[" + top_order + "]" + old_name.split(']').slice(1).join(']');
            }

            //fix sub-sortable specific order number. 
            var nearest_li = $(input).parents('.sortable li').first();
            var bottom_order = nearest_li.siblings().andSelf().not('.trash, .template').index( nearest_li ); 
            new_name = top_fixed;
            if(bottom_order > -1){
                var nesting = 2 * ($(input).parents('.sortable').length) - 1;  
                var new_name = top_fixed.split('[').slice(0,nesting).join('[') + "[" + bottom_order + "]" + top_fixed.split(']').slice(nesting).join(']');
            }
            $(input).attr('name',new_name);
        });
    }



    /**
     * This function fixes the repeated sortable id and add-sortable data-target inherited from 
     * the generating template. This funtion generates a new unique sortable id for the add-sortable 
     * button to have work again.
     * 
     * @param  $(.sortable li) sortable_item
     * @return null
     */
    function fix_sub_sortable_target(sortable_item){
        var addSortablebutton = sortable_item.find('.add-sortable[data-target]');
        var old_target = addSortablebutton.attr('data-target');
        //if a sub-sortable exists..
        if(addSortablebutton.length){
            //define the new target id.
            var new_target = old_target.split('_').slice(0,1) +'_'+Math.floor(Math.random() * 1000000000);
            //set the target and respective id to match.
            addSortablebutton.attr('data-target',new_target);
            sortable_item.find(old_target).attr('id',new_target.substr(1));
        }
    }
});