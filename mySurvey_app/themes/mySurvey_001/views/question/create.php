<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */

$this->breadcrumbs=array(
	'Surveys'=>array('survey/index'),
	$model->survey_ID=>array('survey/update/' . $model->survey_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List SurveyQuestion', 'url'=>array('index')),
	array('label'=>'Manage SurveyQuestion', 'url'=>array('admin')),
);
?>

<h1>Create SurveyQuestion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>