<?php
/* @var $this SurveyController */
/* @var $data Survey */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_URL')); ?>:</b>
	<?php echo CHtml::encode($data->survey_URL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_date_time_created')); ?>:</b>
	<?php echo CHtml::encode($data->survey_date_time_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_creator_ID')); ?>:</b>
	<?php echo CHtml::encode($data->survey_creator_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_publish_status')); ?>:</b>
	<?php echo CHtml::encode($data->survey_publish_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_publish_date_time')); ?>:</b>
	<?php echo CHtml::encode($data->survey_publish_date_time); ?>
	<br />


</div>