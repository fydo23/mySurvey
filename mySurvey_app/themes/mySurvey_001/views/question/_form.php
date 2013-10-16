<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-question-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'survey_ID'); ?>
		<?php echo $form->textField($model,'survey_ID'); ?>
		<?php echo $form->error($model,'survey_ID'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'survey_question_number'); ?>
		<?php echo $form->textField($model,'survey_question_number'); ?>
		<?php echo $form->error($model,'survey_question_number'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textField($model,'text'); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
<!--	<div class="row">
		<?php echo $form->labelEx($model,'survey_question_type'); ?>
		<?php echo $form->textField($model,'survey_question_type'); ?>
		<?php echo $form->error($model,'survey_question_type'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'survey_question_answer_required'); ?>
		<?php echo $form->textField($model,'survey_question_answer_required',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'survey_question_answer_required'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'survey_question_default_next_link'); ?>
		<?php echo $form->textField($model,'survey_question_default_next_link',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'survey_question_default_next_link'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                <input type="button" onclick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/survey';" value="Cancel" />
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->