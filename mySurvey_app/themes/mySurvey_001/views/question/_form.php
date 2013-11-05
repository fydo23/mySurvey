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
	    <?php if(CController::getAction()->getId()=='create'){ ?>
			<?php echo $form->labelEx($model,'type'); ?>
			<?php echo $form->dropDownList($model,'type', array(0=>'Simple Text', 1=>'Multiple Choice')); ?>
			<?php echo $form->error($model,'type'); ?>
		<?php } ?>
		<?php if(CController::getAction()->getId()=='update'){ ?>
			<?php echo $form->label($model,'type'); ?>
			<?php if($model->type == 0){echo '&nbsp&nbspSimple text';} ?>
			<?php if($model->type == 1){echo '&nbsp&nbspMultiple choice';} ?>
			<?php echo $form->error($model,'type'); ?>
		<?php } ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
	<?php if((CController::getAction()->getId()=='update') && ($model->type == 1)){ ?>
	
    <div id="choice">
    	<h4>Choices</h4>
        <ul id="sortable">
            <?php if(isset($answer_dataProvider)) { ?>
                <?php foreach($answer_dataProvider->getData() as $record) { ?>
                   <li class="answer_summary" >
                   		<label class="label"><?php echo $record->getAttributeLabel('text') ?>:</label>
                       <span> <?php echo $record->text ?></span><br>
                       <label class="label"><?php echo $record->getAttributeLabel('survey_answer_choice_letter') ?>:</label>
                       <span><?php echo $record->survey_answer_choice_letter ?></span><br>
                       <label class="label"><?php echo $record->getAttributeLabel('survey_answer_next_link') ?>:</label>
                       <span><?php echo $record->survey_answer_next_link ?></span><br>
                       <input class="order_number" type="hidden" name="SurveyAnswer[<?php echo $record->id ?>][order_number]" value="<?php echo $record->order_number ?>"/>
                       <a href="<?php echo Yii::app()->createUrl('answer/update',array('id'=>$record->id,'surveyQuestion_id'=>$model->id)); ?>">Edit</a>
                       <a href="<?php echo Yii::app()->createUrl('answer/delete',array('id'=>$record->id,'surveyQuestion_id'=>$model->id)); ?>">Delete</a>
                   </li>
                <?php } ?>   
            <?php } ?>
        </ul>
        <div class="row buttons">
            <?php echo CHtml::link('Add new choice',array('/answer/create/'.$model->id)); ?>
        </div>
    <?php } ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
