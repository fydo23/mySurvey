<?php
/* @var $this SurveyResponseController */
/* @var $model SurveyResponse */

$this->breadcrumbs=array(
	'Survey Responses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SurveyResponse', 'url'=>array('index')),
	array('label'=>'Manage SurveyResponse', 'url'=>array('admin')),
);
?>

<h1>Create SurveyResponse</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>