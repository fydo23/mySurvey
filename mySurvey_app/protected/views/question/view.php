<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */

$this->breadcrumbs=array(
	'Survey Questions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SurveyQuestion', 'url'=>array('index')),
	array('label'=>'Create SurveyQuestion', 'url'=>array('create')),
	array('label'=>'Update SurveyQuestion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SurveyQuestion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SurveyQuestion', 'url'=>array('admin')),
);
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
