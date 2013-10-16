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
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                <input type="button" onclick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/survey';" value="Cancel" />
	</div>   
        <h4>Questions</h4>
        <div>
            <ul>
                <?php if(isset($questions_dataProvider)) { ?>
                    <?php foreach($questions_dataProvider->getData() as $record) { ?>
                       <li>
                           <?php echo $record->survey_question_number ?>: 
                           <?php echo $record->text ?>
                           <a href="<?php echo Yii::app()->request->baseUrl . '/question/update/' . $record->id; ?>">Edit</a>
                           <a href="<?php echo Yii::app()->request->baseUrl . '/question/delete/' . $record->id; ?>">Delete</a>
                       </li>
                    <?php } ?>   
                <?php } ?>
            </ul>
            <?php if (isset($model->id)) { ?>
                <div class="row buttons">
                    <?php echo CHtml::link('Add new question',array('/question/create/' . $model->id)); ?>
                </div>
            <?php } ?> 
	</div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->