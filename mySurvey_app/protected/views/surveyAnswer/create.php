<?php
/* @var $this SurveyAnswerController */
/* @var $model SurveyAnswer */

$this->breadcrumbs=array(
	'Survey Answers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SurveyAnswer', 'url'=>array('index')),
	array('label'=>'Manage SurveyAnswer', 'url'=>array('admin')),
);
?>

<h1>Create SurveyAnswer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>