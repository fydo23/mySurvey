<?php
/* @var $this SurveyAnswerController */
/* @var $model SurveyAnswer */

?>

<h1>View SurveyAnswer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'survey_ID',
		'survey_question_ID',
		'survey_answer_choice_letter',
		'survey_answer_response_time',
		'survey_answer_next_link',
	),
)); ?>
