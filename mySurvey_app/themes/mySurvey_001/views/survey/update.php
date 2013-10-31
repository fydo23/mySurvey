<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<h1>Edit Survey:</h1>

<script>
	var new_sortables = {
		counter: 0,
	};

	$(function(){

		$(window).on('click',function(e){
			//check if where we clicked has an parent that is active, or has an active class itself.
			var clickedActiveQuestion = $(e.target).closest('.active').length || $(e.target).hasClass('active');
			if(!clickedActiveQuestion){
				$('.active a.edit').trigger('click');
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
			}else{
				$(this).closest('li').removeClass('active');
				$(this).closest('li').find('input[type=text][name*=text]').replaceWith(newInput.attr('type','hidden'));
				$(this).closest('li').find('.text').html(newInput.val()).show();
			}
		}).on('click','a.delete',function(e){
			e.preventDefault();//stops the link from following the url
			var listItem = $(this).closest('li');
			// delete new_sortables[listItem.data('sort-key')];
			listItem.remove();
		});

		$('.add-sortable').on('click',function(e){
			e.preventDefault();
			e.stopPropagation();
			var target = $(this).data('target');
			var newItem = $(target).find('.template').clone().removeClass('template');
			var sort_key = new_sortables.counter;
			// new_sortables[sort_key] = newItem.attr('data-sort-key', sort_key);
			new_sortables.counter++;
			newItem.find('input').removeAttr('disabled').each(function(idx,elem){
				var tempName = $(elem).attr('name').replace('new','new_'+sort_key);
				$(elem).attr('name', tempName);
			});
			$(target).append(newItem);
			newItem.find('.edit').trigger('click');
		});


		//DRAGGABLE CONTENT
		$('ul.sortable').sortable({
				items: '> li',
				start:function(event, ui){
						$(ui.item).addClass('dragging');
				},
				stop:function(event, ui){
						$(ui.item).removeClass('dragging');
						$(ui.item).siblings().andSelf().each(function(idx,elem){
								$(elem).find('input[name*=order_number]').val(idx);

						});
				}
		});
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
			</div>


			<div class="row">
				<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100, 'class'=>'title')); ?>
				<span class="arrow-left"></span><?php echo $form->error($model,'title',array('successCssClass','success')); ?>
			</div>
			
			
			<h4>Questions</h4>
			<ul id="questions" class="sortable">
			   <li class="question_summary template">
				   <span class="text"></span>
				   <input disabled type="hidden" name="SurveyQuestion[new][text]" value=""/>
				   <input disabled type="hidden" name="SurveyQuestion[new][order_number]" value=""/>
				   <a class="delete" href="#">Delete</a>
				   <a class="edit" href="#">Edit</a>
			   </li>
				<?php if(isset($questions_dataProvider)) { ?>
					<?php foreach($questions_dataProvider->getData() as $record) { ?>
					   <li class="question_summary" >
						   	<span class="text"><?php echo $record->text ?></span>
						   	<input type="hidden" name="SurveyQuestion[<?php echo $record->id ?>][text]" value="<?php echo $record->text ?>"/>
						   	<input type="hidden" name="SurveyQuestion[<?php echo $record->id ?>][order_number]" value="<?php echo $record->order_number ?>"/>
					   		<a class="delete" href="#">Delete</a>
						   	<a class="edit" href="#">Edit</a>
					   </li>
					<?php } ?>   
				<?php } ?>
			</ul>

			<div class="row buttons">
				<a class="add-sortable" data-target="#questions" href="#">Add new question'</a>
			</div>

		<?php $this->endWidget(); ?>
			
</div><!-- form -->