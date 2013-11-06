<?php
/* @var $this SurveyAnswerController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Survey Answers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
