<?php
/* @var $this SurveyResponseController */
/* @var $model SurveyResponse */

$this->breadcrumbs=array(
	'Survey Responses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SurveyResponse', 'url'=>array('index')),
	array('label'=>'Create SurveyResponse', 'url'=>array('create')),
	array('label'=>'Update SurveyResponse', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SurveyResponse', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SurveyResponse', 'url'=>array('admin')),
);
?>

<h1>View SurveyResponse #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'survey_ID',
		'survey_question_ID',
		'survey_answer_ID',
		'survey_answer_choice_letter',
		'survey_response_time',
		'survey_response_responder',
		'survey_response_text',
	),
)); ?>
