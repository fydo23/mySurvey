<?php
/* @var $this SurveyController */
/* @var $data Survey */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('survey_creator_ID')); ?>:</b>
	<?php echo CHtml::encode($data->survey_creator_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_published')); ?>:</b>
	<?php echo CHtml::encode($data->is_published); ?>
	<br />


</div>