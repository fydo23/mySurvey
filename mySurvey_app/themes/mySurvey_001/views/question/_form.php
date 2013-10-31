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
		<?php echo $form->dropDownList($model,'type', array(1=>'Short Answer', 2=>'Multiple Choice')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
	<?php if(CController::getAction()->getId()=='update'){ ?>
	    <h4>Questions</h4>
    <div>
        <ul id="sortable">
            <?php if(isset($answer_dataProvider)) { ?>
                <?php foreach($answer_dataProvider->getData() as $record) { ?>
                   <li class="answer_summary" >
                       <input class="text" value="<?php echo $record->text ?>" name="SurveyAnswer[<?php echo $record->id;?>][text]"><br>
                       <input class="order_number" type="hidden" name="SurveyAnswer[<?php echo $record->id ?>][order_number]" value="<?php echo $record->order_number ?>"/>
                       <a href="<?php echo Yii::app()->createUrl('answer/delete',array('id'=>$record->id,'survey_id'=>$model->survey_ID)); ?>">Delete</a>
                   </li>
                <?php } ?>   
            <?php } ?>
        </ul>
        <div class="row buttons">
            <?php echo CHtml::link('Add new answer',array('/answer/create/'.$model->id)); ?>
        </div>
    <?php } ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->