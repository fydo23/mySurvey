<?php
/* @var $this SurveyCreatorController */
/* @var $model SurveyCreator */

$this->breadcrumbs=array(
	'Survey Creators'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SurveyCreator', 'url'=>array('index')),
	array('label'=>'Create SurveyCreator', 'url'=>array('create')),
	array('label'=>'Update SurveyCreator', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SurveyCreator', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SurveyCreator', 'url'=>array('admin')),
);
?>

<h1>View SurveyCreator #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'password',
		'first_name',
		'last_name',
	),
)); ?>
