<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<h1>Edit Survey:</h1>

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

		//DRAGGABLE 
		$('ul.sortable').sortable({
                        items: '> li',
                        start:function(event, ui){
                                $(ui.item).addClass('dragging');
                        },
                        stop:function(event, ui){      
                                $(ui.item).removeClass('dragging');
                                fix_sortable_input_names($(this).closest('.sortable'));
                        }
		});
		
                
		$('#questions').on('click','a.edit',function(e){
			e.stopPropagation();//allows us to catch window click outside event.
			e.preventDefault();//stops the link from following the url
			//this is a hack to bi-pass browser security of immutable type attributes on inputs.
			var newInput = $(this).closest('li').find('input[name*=text]').clone();
			if(!$(this).closest('li').hasClass('active')){
				$('.active a.edit').trigger('click');
				$(this).closest('li').addClass('active');
				$(this).closest('li').find('.text').hide();
				$(this).closest('li').find('input[type=hidden][name*=text]').replaceWith(newInput.attr('type','text'));
                                newInput.focus();
			}else{
				$(this).closest('li').removeClass('active');
				$(this).closest('li').find('input[type=text][name*=text]').replaceWith(newInput.attr('type','hidden'));
				$(this).closest('li').find('.text').html(newInput.val()).show();
			}
		}).on('click','a.delete',function(e){
			e.preventDefault();//stops the link from following the url
			var listItem = $(this).closest('li');
			listItem.hide();
                        $('#questions').append(listItem.detach());
                        listItem.find('input[name*=status]').val('delete');
                        fix_sortable_input_names('#questions');
		});

                /**
                 * Adds a sortable element by coping the hidden template at the head of the sortable. 
                 */
		$('.add-sortable').on('click',function(e){
			e.preventDefault(); // don't follow links.
			var sortable = $(this).data('target');
			var newItem = $(sortable).find('.template').clone().removeClass('template');
			newItem.find('input').removeAttr('disabled');
			$(sortable).append(newItem);
                        $($(sortable).find('li').get().reverse()).each(function(idx, elem){
                            var delete_elem = $(elem).find('[value=delete]');
                            if(delete_elem.length){
                                delete_elem.before(newItem.detach());
                            }else{
                                return false;
                            }
                        });
                        fix_sortable_input_names(sortable);
                        
                        // display/focus the new element's text field.
			e.stopPropagation(); 
			newItem.find('.edit').trigger('click');
		});
                
                /**
                 * Change the name of attribute to reflect model's new order_num
                 * Propogate order_number into 'name' attribute. This function makes sure to
                 * format the name attribute so that the resulting $_POST array contains a list
                 * of sortable items with each index reflecting the element's order_number.
                 * 
                 * @param $sortable | the .sortable element being fixed
                 */
                function fix_sortable_input_names(sortable){
                        var oldCheckedProps = $(sortable).find('li input').clone();
                        var count = 0;
                        $(sortable).find('li').each(function(order_num,elem){
                                $(elem).find('input').each(function(idx, input){ 
                                        var old_name = $(input).attr('name');
                                        var old_order_number = old_name.split('[')[1].split(']')[0];
                                        var new_name = old_name.replace(old_order_number, order_num);
                                        
                                        $(input).attr('name',new_name);
                                        var checked = $(oldCheckedProps[count++]).is(':checked');
                                        $(input).prop('checked',checked);
                                });
                        });
                }
	});

</script>

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
                <ul id="trash"><?php //deleted posts go here ?></ul>
                <ul id="questions" class="sortable">
                    <?php echo $this->renderPartial('/question/update',array(
                            'model'=>new SurveyQuestion('template'),
                            'form'=>$form
                    )); ?>
                    <?php foreach($questions as $record) { ?>
                            <?php echo $this->renderPartial('/question/update',array(
                                    'model'=>$record,
                                    'form'=>$form
                            )); ?>
                    <?php } ?>   
                </ul>

                <div class="row buttons">
                        <a class="add-sortable" data-target="#questions" href="#">Add new question'</a>
                </div>

        <?php $this->endWidget(); ?>
			
</div><!-- form -->