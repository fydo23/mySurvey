<?php
/* @var $this SurveyResponseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Survey Responses',
);

$this->menu=array(
	array('label'=>'Create SurveyResponse', 'url'=>array('create')),
	array('label'=>'Manage SurveyResponse', 'url'=>array('admin')),
);
?>

<h1>Survey Responses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
