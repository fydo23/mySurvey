<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_URL'); ?>
		<?php echo $form->textField($model,'survey_URL',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'survey_URL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_date_time_created'); ?>
		<?php echo $form->textField($model,'survey_date_time_created'); ?>
		<?php echo $form->error($model,'survey_date_time_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_creator_ID'); ?>
		<?php echo $form->textField($model,'survey_creator_ID'); ?>
		<?php echo $form->error($model,'survey_creator_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_publish_status'); ?>
		<?php echo $form->textField($model,'survey_publish_status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'survey_publish_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'survey_publish_date_time'); ?>
		<?php echo $form->textField($model,'survey_publish_date_time'); ?>
		<?php echo $form->error($model,'survey_publish_date_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->