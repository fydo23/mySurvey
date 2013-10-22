<?php
/* @var $this SurveyQuestionController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Survey Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
