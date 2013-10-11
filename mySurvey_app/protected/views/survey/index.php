<?php
/* @var $this SurveyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Surveys',
);

$this->menu=array(
	array('label'=>'Create Survey', 'url'=>array('create')),
	array('label'=>'Manage Survey', 'url'=>array('admin')),
);
?>

<h1>Surveys</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
