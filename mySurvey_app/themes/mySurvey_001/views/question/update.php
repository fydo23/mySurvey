<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */
?>

<h1>Update Question</h1>

        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'survey-question-form',
                'focus'=>array($model, 'text'),
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                       'validateOnChange'=>true,
                       'validateOnType'=>true,
                )
        )); ?>
            <?php echo $form->errorSummary($model); ?>
            <div class="row">
                    <?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>100)); ?>
                    <span class="arrow-left"></span><?php echo $form->error($model,'text',array('successCssClass','success')); ?>
            </div>
        <?php $this->endWidget(); ?>
            

<?php // $this->renderPartial('_form', array('model'=>$model)); ?>