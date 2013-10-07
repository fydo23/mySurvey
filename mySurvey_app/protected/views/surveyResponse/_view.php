<?php
/* @var $this SurveyResponseController */
/* @var $data SurveyResponse */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_ID')); ?>:</b>
	<?php echo CHtml::encode($data->survey_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_question_ID')); ?>:</b>
	<?php echo CHtml::encode($data->survey_question_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_answer_ID')); ?>:</b>
	<?php echo CHtml::encode($data->survey_answer_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_answer_choice_letter')); ?>:</b>
	<?php echo CHtml::encode($data->survey_answer_choice_letter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_response_time')); ?>:</b>
	<?php echo CHtml::encode($data->survey_response_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_response_responder')); ?>:</b>
	<?php echo CHtml::encode($data->survey_response_responder); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_response_text')); ?>:</b>
	<?php echo CHtml::encode($data->survey_response_text); ?>
	<br />

	*/ ?>

</div>