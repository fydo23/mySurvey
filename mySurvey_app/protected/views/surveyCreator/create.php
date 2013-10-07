<?php
/* @var $this SurveyCreatorController */
/* @var $model SurveyCreator */

$this->breadcrumbs=array(
	'Survey Creators'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SurveyCreator', 'url'=>array('index')),
	array('label'=>'Manage SurveyCreator', 'url'=>array('admin')),
);
?>

<h1>Create SurveyCreator</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>