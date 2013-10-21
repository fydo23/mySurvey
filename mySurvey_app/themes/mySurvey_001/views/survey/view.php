<?php
/* @var $this SurveyController */
/* @var $model Survey */

?>

<h1>View Survey #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'survey_URL',
		'survey_date_time_created',
		'survey_creator_ID',
		'survey_publish_status',
		'survey_publish_date_time',
	),
)); ?>
