<?php
/* @var $this SurveyCreatorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Survey Creators',
);

$this->menu=array(
	array('label'=>'Create SurveyCreator', 'url'=>array('create')),
	array('label'=>'Manage SurveyCreator', 'url'=>array('admin')),
);
?>

<h1>Survey Creators</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
