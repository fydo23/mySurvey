<?php
/* @var $this SurveyResponseController */
/* @var $model SurveyResponse */
?>

<h1>View SurveyResponse #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'survey_answer_ID',
		'choice_letter',
		'survey_response_time',
		'survey_response_responder',
		'survey_response_text',
	),
)); ?>
