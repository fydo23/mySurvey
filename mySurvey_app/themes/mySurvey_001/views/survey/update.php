<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<<<<<<< HEAD
<!--======== EDIT SURVEY ========-->
<h1>Survey Editor</h1>
=======
<h1>Edit Survey:</h1>
>>>>>>> dev

<script>
    
	$(function(){

<<<<<<< HEAD
<div id="survey-url">
	<h3>Survey URL:</h3> <p>surveyurl.example.com</p>
</div>

<!--======== FORM ========-->
<div class="form questions">

    <div>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'question_order',
            'action'=>'/survey/reorderQuestions/survey_id/'.$model->id
        ));
        
        ?>
        <!--======== QUESTION LIST ========-->
        <ul id="sortable">
            <?php if(isset($questions_dataProvider)) { ?>
                <?php foreach($questions_dataProvider->getData() as $record) { ?>
                   <li class="question_summary" >
                       <span class="text"><?php echo $record->text ?></span>
                       <input class="order_number" type="hidden" name="SurveyQuestion[<?php echo $record->id ?>][order_number]" value="<?php echo $record->order_number ?>"/>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/delete/' . $record->id; ?>">Delete</a>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/update/' . $record->id; ?>">Edit</a>
                   </li>
                <?php } ?>   
            <?php } ?>
        </ul>
       
       
       <!--======== ADD NEW QUESTION ========-->
        <div class="add-question">
            <?php echo CHtml::link('Add New Question',array('/question/create/survey_id/' . $model->id)); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>

=======
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
		
                /**
                 * Event handler for editing a list item. Triggered by clicking the edit link.
                 * This function toggles the text editing of quesitons.
                 */
		$('#questions').on('click','a.edit',function(e){
			e.stopPropagation();//allows us to catch window click outside event.
			e.preventDefault();//stops the link from following the url
			//bi-pass browser security: clone to allow mutation of 'type' attribute.
			var newInput = $(this).closest('li').find('input[name*=text]').clone();
                        var list_item = $(this).closest('li');
			if(!list_item.hasClass('active')){
                            //start edit funciton
				$('.active a.edit').trigger('click');
				list_item.addClass('active');
				list_item.find('.text').hide();
				list_item.find('input[type=hidden][name*=text]').replaceWith(newInput.attr('type','text')).focus();
			}else{
                            //stop editing function.
				list_item.removeClass('active');
				list_item.find('input[type=text][name*=text]').replaceWith(newInput.attr('type','hidden'));
				list_item.find('.text').html(newInput.val()).show();
			}
		})
                
                /**
                 * This event handles the deletion of list items. It hides the item
                 * apends it after the .trash item.
                 */
                $('#questions').on('click','a.delete',function(e){
			e.preventDefault();//stops the link from following the url
			var listItem = $(this).closest('li');
			listItem.hide();
                        //move deleted items after trash item to allows the preservation of order_num.
                        $('#questions .trash').after(listItem.detach());
                        listItem.find('input[name*=delete]').val('True');
                        fix_sortable_input_names('#questions');
		});

                /**
                 * Adds a sortable element by coping the hidden template at the head of the sortable. 
                 */
		$('.add-sortable').on('click',function(e){
			e.preventDefault(); // don't follow links.
			var sortable = $(this).data('target');
			var newItem = $(sortable).find('.template').clone().removeClass('template');
			newItem.find('input, select').removeAttr('disabled');
			$(sortable).find('.trash').before(newItem);
                        
                        //add the new element before the delete selements that are stored at the end of the list                        $(sortable).;
                        fix_sortable_input_names(sortable);
                        
                        // display/focus the new element's text field.
			e.stopPropagation(); 
			newItem.find('.edit').trigger('click');
		});
                
                /**
                 * Change the name of attribute to reflect model's new order_num
                 * Propogate order_number into 'name' attribute. This function makes sure to
                 * format the name attribute to make the resulting $_POST array contains a list
                 * of sortable items with each index reflecting the element's order_number. This
                 * function should be called whenever an update is made to the sortable list.
                 * 
                 * @param $sortable | the .sortable element being fixed
                 */
                function fix_sortable_input_names(sortable){
                        //renames item inputs to reflect order
                        $(sortable).find('li:not(.template, .trash)').each(function(order_num,list_item){
                                $(list_item).find('input,select').each(function(idx, input){ 
                                        var old_name = $(input).attr('name');
                                        var old_order_number = old_name.split('[')[1].split(']')[0];
                                        var new_name = old_name.replace(old_order_number, order_num);
                                        $(input).attr('name',new_name);
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
                    <li class="trash"><?php //trash goes after this list item. ?></li>
                </ul>

                <div class="row buttons">
                        <a class="add-sortable" data-target="#questions" href="#">Add new question'</a>
                </div>

        <?php $this->endWidget(); ?>
			
>>>>>>> dev
</div><!-- form -->