<?php
/* @var $this SurveyController */
/* @var $model Survey */
?>

<<<<<<< HEAD
<!--======== CREATE SURVEY ========-->
=======

>>>>>>> dev
<h1>Create Survey</h1>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'survey-form',
            'enableAjaxValidation'=>false,
    )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                    <?php echo $form->labelEx($model,'title'); ?>
                    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'title'); ?>
            </div>

            <div class="row buttons">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                    <input type="button" onclick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/survey';" value="Cancel" />
            </div>   

    <?php $this->endWidget(); ?>

</div><!-- form -->
