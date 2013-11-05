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
			<?php echo $form->dropDownList($model,'type', array(1=>'Simple Text', 2=>'Multiple Choice')); ?>
			<span class="arrow-left"></span><?php echo $form->error($model,'type'); ?>
		<?php } ?>
		<?php if(CController::getAction()->getId()=='update'){ ?>
			<?php echo $form->label($model,'type'); ?>
			<?php if($model->type == 1){echo '&nbsp&nbspSimple text';} ?>
			<?php if($model->type == 2){echo '&nbsp&nbspMultiple choice';} ?>
			<span class="arrow-left"></span><?php echo $form->error($model,'type'); ?>
		<?php } ?>
	</div>
        
	<div class="row">
		
		<?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>1000, 'placeholder'=>'Enter Question Text')); ?>
		<span class="arrow-left"></span><?php echo $form->error($model,'text'); ?>
	</div>
	<?php if((CController::getAction()->getId()=='update') && ($model->type == 2)){ ?>
	
    <div id="choice">
    	<h4>Choices</h4>
        <ul id="sortable">
            <?php if(isset($answer_dataProvider)) { ?>
                <?php foreach($answer_dataProvider->getData() as $record) { ?>
                   <li class="answer_summary" >
                       <input class="text" value="<?php echo $record->text ?>" name="SurveyAnswer[<?php echo $record->id;?>][text]"><br>
                       <input class="order_number" type="hidden" name="SurveyAnswer[<?php echo $record->id ?>][order_number]" value="<?php echo $record->order_number ?>"/>
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
