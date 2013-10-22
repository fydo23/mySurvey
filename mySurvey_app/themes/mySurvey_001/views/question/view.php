<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */
?>

<h1>View SurveyQuestion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'survey_ID',
		'survey_question_number',
		'survey_question_type',
		'survey_question_answer_required',
		'survey_question_default_next_link',
	),
)); ?>
