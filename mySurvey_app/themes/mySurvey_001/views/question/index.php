<?php
/* @var $this SurveyQuestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Survey Questions',
);

$this->menu=array(
	array('label'=>'Create SurveyQuestion', 'url'=>array('create')),
	array('label'=>'Manage SurveyQuestion', 'url'=>array('admin')),
);
?>

<h1>Survey Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
