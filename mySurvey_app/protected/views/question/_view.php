<?php
/* @var $this SurveyQuestionController */
/* @var $data SurveyQuestion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_ID')); ?>:</b>
	<?php echo CHtml::encode($data->survey_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_question_number')); ?>:</b>
	<?php echo CHtml::encode($data->survey_question_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_question_type')); ?>:</b>
	<?php echo CHtml::encode($data->survey_question_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_question_answer_required')); ?>:</b>
	<?php echo CHtml::encode($data->survey_question_answer_required); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_question_default_next_link')); ?>:</b>
	<?php echo CHtml::encode($data->survey_question_default_next_link); ?>
	<br />


</div>