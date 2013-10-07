<?php
/* @var $this SurveyCreatorController */
/* @var $model SurveyCreator */

$this->breadcrumbs=array(
	'Survey Creators'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SurveyCreator', 'url'=>array('index')),
	array('label'=>'Create SurveyCreator', 'url'=>array('create')),
	array('label'=>'View SurveyCreator', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SurveyCreator', 'url'=>array('admin')),
);
?>

<h1>Update SurveyCreator <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>