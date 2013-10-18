<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_ID'); ?>
		<?php echo $form->textField($model,'survey_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_question_number'); ?>
		<?php echo $form->textField($model,'survey_question_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_question_type'); ?>
		<?php echo $form->textField($model,'survey_question_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_question_answer_required'); ?>
		<?php echo $form->textField($model,'survey_question_answer_required',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_question_default_next_link'); ?>
		<?php echo $form->textField($model,'survey_question_default_next_link',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->