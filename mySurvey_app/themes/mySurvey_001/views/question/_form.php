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
	
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', array(1=>'Short Answer', 2=>'Multiple Choice'),array('ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('/question/update/1'),
			'data'=>array('type'=>'js:this.value'),
			'success'=>'function(data){ location.reload();}'
		)));?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        <?php if($model->type==1){?>
	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
<?php }else if($model->type==2){ echo 'multiple choice';}?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->