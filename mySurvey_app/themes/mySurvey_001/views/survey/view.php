<?php
/* @var $this SurveyController */
/* @var $model Survey */

$this->menu=array(
	array('label'=>'List Survey', 'url'=>array('index')),
	array('label'=>'Create Survey', 'url'=>array('create')),
	array('label'=>'Update Survey', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Survey', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Survey', 'url'=>array('admin')),
);
?>

<h1>View Survey #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'survey_URL',
		'survey_date_time_created',
		'survey_creator_ID',
		'survey_publish_status',
		'survey_publish_date_time',
	),
)); ?>
