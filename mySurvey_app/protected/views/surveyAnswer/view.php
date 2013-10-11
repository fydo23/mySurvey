<?php
/* @var $this SurveyAnswerController */
/* @var $model SurveyAnswer */

$this->breadcrumbs=array(
	'Survey Answers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SurveyAnswer', 'url'=>array('index')),
	array('label'=>'Create SurveyAnswer', 'url'=>array('create')),
	array('label'=>'Update SurveyAnswer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SurveyAnswer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SurveyAnswer', 'url'=>array('admin')),
);
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
