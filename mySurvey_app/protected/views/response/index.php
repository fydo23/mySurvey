<?php
/* @var $this SurveyResponseController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Survey Responses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
