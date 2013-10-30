<?php
/* @var $this SurveyResponseController */
/* @var $model SurveyResponse */

$this->breadcrumbs=array(
	'Survey Responses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SurveyResponse', 'url'=>array('index')),
	array('label'=>'Create SurveyResponse', 'url'=>array('create')),
	array('label'=>'View SurveyResponse', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SurveyResponse', 'url'=>array('admin')),
);
?>

<h1>Update SurveyResponse <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>