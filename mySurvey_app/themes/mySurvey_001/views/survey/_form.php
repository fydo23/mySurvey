<?php
//This form is shared by create and update actions.

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


            <div class="row survey-title-buttons">
            		<div id="title-header">
            			<h3>Survey Title:</h3>
						<?php echo $form->textField($model,'title',array('size'=>60,'placeholder'=>'Survey Title','maxlength'=>100)); ?>
						<span class="arrow-left"></span><?php echo $form->error($model,'title'); ?>
					</div>
					 <div class="buttons">
						 <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
						 <input type="button" onclick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/survey';" value="Cancel" />
					</div> 
            
            
            </div>
  

    <?php $this->endWidget(); ?>

</div><!-- form -->