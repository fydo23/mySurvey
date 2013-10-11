<?php
/* @var $this SurveyAnswerController */
/* @var $model SurveyAnswer */

$this->breadcrumbs=array(
	'Survey Answers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SurveyAnswer', 'url'=>array('index')),
	array('label'=>'Create SurveyAnswer', 'url'=>array('create')),
	array('label'=>'View SurveyAnswer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SurveyAnswer', 'url'=>array('admin')),
);
?>

<h1>Update SurveyAnswer <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>