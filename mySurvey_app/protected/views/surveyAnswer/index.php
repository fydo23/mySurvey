<?php
/* @var $this SurveyAnswerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Survey Answers',
);

$this->menu=array(
	array('label'=>'Create SurveyAnswer', 'url'=>array('create')),
	array('label'=>'Manage SurveyAnswer', 'url'=>array('admin')),
);
?>

<h1>Survey Answers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
