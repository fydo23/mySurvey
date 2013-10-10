<?php
/* @var $this SurveyResponseController */
/* @var $model SurveyResponse */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-response-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_ID'); ?>
		<?php echo $form->textField($model,'survey_ID'); ?>
		<?php echo $form->error($model,'survey_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_question_ID'); ?>
		<?php echo $form->textField($model,'survey_question_ID'); ?>
		<?php echo $form->error($model,'survey_question_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_answer_ID'); ?>
		<?php echo $form->textField($model,'survey_answer_ID'); ?>
		<?php echo $form->error($model,'survey_answer_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_answer_choice_letter'); ?>
		<?php echo $form->textField($model,'survey_answer_choice_letter',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'survey_answer_choice_letter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_response_time'); ?>
		<?php echo $form->textField($model,'survey_response_time'); ?>
		<?php echo $form->error($model,'survey_response_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_response_responder'); ?>
		<?php echo $form->textField($model,'survey_response_responder',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'survey_response_responder'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_response_text'); ?>
		<?php echo $form->textField($model,'survey_response_text'); ?>
		<?php echo $form->error($model,'survey_response_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->