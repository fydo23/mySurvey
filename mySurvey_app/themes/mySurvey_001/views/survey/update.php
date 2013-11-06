<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<!--======== EDIT SURVEY ========-->
<h1>Survey Editor</h1>

<script>

    
	$(function(){

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
         * Handels the draggable items enabled by jquery-ui.
         */
		$('.sortable').sortable({
            items: '> li',
            start:function(event, ui){
                $(ui.item).addClass('dragging');
            },
            stop:function(event, ui){      
                $(ui.item).removeClass('dragging');
                fix_sortable_input_names($(this).closest('.sortable'));
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
    		var listItem = $(this).closest('li');
    		listItem.hide().attr('data-deleted',"True").find('input[name*=delete]').val("True");
            //move deleted items after trash item to allows the preservation of order_num.
            listItem.siblings('.trash').after(listItem.detach());
            fix_sortable_input_names(listItem.closest('.sortable'));
		});

        /**
         * Adds a sortable element by coping the hidden template at the head of the sortable. 
         */
		$('form').on('click','.add-sortable',function(e){
            e.preventDefault(); // don't follow links.
			var sortable = $(this).data('target');
			var newItem = $(sortable).find('.template').first().clone().removeClass('template');
			newItem.find('input, select').removeAttr('disabled');
			$(sortable).find('.trash').last().before(newItem);
            //add the new element before the delete selements that are stored at the end of the list
            fix_sortable_input_names(sortable);
            fix_sub_sortable_target(newItem);
            
            // display/focus the new element's text field.
			e.stopPropagation(); 
			newItem.find('.edit:first').trigger('click');
		});
                
        /**
         * Change the name of attribute to reflect model's new order_num
         * Propogate order_number into 'name' attribute. This function makes sure to
         * format the name attribute to make the resulting $_POST array contains a list
         * of sortable items with each index reflecting the element's order_number. This
         * function should be called whenever an update is made to the sortable list.
         * 
         * The expected name schem should be:
         *      sortable1[sortable1_indexes][sortable2][sortable2_indexes][[...][...]etc...]['attributes']
         * (ie. expected name attributers are: SurveyQuestion[1][SurveyAnswer][2][choice_letter]['text'])
         * 
         * @param $sortable | the .sortable element being fixed
         */
        function fix_sortable_input_names(sortable){
            //nesting will keep track where we need to break the array to rename the proper index.
            //if zero parent sortables, change first [#], if 1 parent sortable, change third [#]
            var nesting = 2 * ($(sortable).parents('.sortable').length) + 1;
            $(sortable).children('li:not(.template, .trash, [data-deleted])').each(function(order_num,list_item){
                $(list_item).find('input, select, .sortable').each(function(idx, input){ 
                    var parent_sortables = ($(list_item).parents('.sortable').length) - 1
                    var old_name = $(input).attr('name');
                    //construct new name based on how nested this sortble item is.
                    var new_name = old_name.split('[').slice(0,nesting).join('[') + "[" + order_num + "]" + old_name.split(']').slice(nesting).join(']');
                    $(input).attr('name',new_name);
                });
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
            var old_target = addSortablebutton.data('target');
            //if a sub-sortable exists..
            if(addSortablebutton.length){
                //define the new target id.
                var new_target = old_target.split('_').slice(0,1) +'_'+Math.floor(Math.random() * 1000000000);
                //set the target and respective id to match.
                addSortablebutton.data('target',new_target);
                sortable_item.attr('id',new_target.substr(1));
            }
        }
	});

</script>

<div id="survey-url">
    <h3>Survey URL:</h3> <p>surveyurl.example.com</p>
</div>

<div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'survey-form',
                'focus'=>array($model, 'title'),
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                        'validateOnChange'=>true,
                        'validateOnType'=>true,
                )
        )); ?>

                <?php echo $form->errorSummary($model); ?>
                <div class="row buttons">
                        <?php echo CHtml::submitButton('Save'); ?>
                        <?php echo CHtml::link('Cancel', '/survey') ?>
                </div>

                <div class="row">
                        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100, 'class'=>'title')); ?>
                        <span class="arrow-left"></span><?php echo $form->error($model,'title',array('successCssClass','success')); ?>
                </div>

                <h4>Questions</h4>
                <ul id="questions" class="sortable">
                    <?php echo $this->renderPartial('/question/_form',array(
                            'question'=>new SurveyQuestion('template')
                    )); ?>
                    <?php foreach($questions as $record) { ?>
                            <?php echo $this->renderPartial('/question/_form',array(
                                    'question'=>$record
                            )); 
                            ?>
                    <?php } ?>  
                    <li class="trash"><?php //trash goes after this list item. ?></li>
                </ul>

                <div class="row buttons">
                        <a class="add-sortable" data-target="#questions" href="#">Add new question'</a>
                </div>

        <?php $this->endWidget(); ?>
			
</div><!-- form -->