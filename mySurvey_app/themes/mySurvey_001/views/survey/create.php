<?php
/* @var $this SurveyController */
/* @var $model Survey */

$this->menu=array(
	array('label'=>'List Survey', 'url'=>array('index')),
	array('label'=>'Manage Survey', 'url'=>array('admin')),
);
?>

<!--======== CREATE SURVEY ========-->
<h1>Create Survey</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>