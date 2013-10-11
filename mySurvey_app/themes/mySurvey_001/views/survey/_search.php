<?php
/* @var $this SurveyController */
/* @var $model Survey */
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
		<?php echo $form->label($model,'survey_URL'); ?>
		<?php echo $form->textField($model,'survey_URL',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_date_time_created'); ?>
		<?php echo $form->textField($model,'survey_date_time_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_creator_ID'); ?>
		<?php echo $form->textField($model,'survey_creator_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_publish_status'); ?>
		<?php echo $form->textField($model,'survey_publish_status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'survey_publish_date_time'); ?>
		<?php echo $form->textField($model,'survey_publish_date_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->