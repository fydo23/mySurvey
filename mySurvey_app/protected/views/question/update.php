<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */

$this->breadcrumbs=array(
	'Survey Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SurveyQuestion', 'url'=>array('index')),
	array('label'=>'Create SurveyQuestion', 'url'=>array('create')),
	array('label'=>'View SurveyQuestion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SurveyQuestion', 'url'=>array('admin')),
);
?>

<h1>Update SurveyQuestion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>