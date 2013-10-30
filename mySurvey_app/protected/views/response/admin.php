<?php
/* @var $this SurveyResponseController */
/* @var $model SurveyResponse */

$this->breadcrumbs=array(
	'Survey Responses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SurveyResponse', 'url'=>array('index')),
	array('label'=>'Create SurveyResponse', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#survey-response-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Survey Responses</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'survey-response-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'survey_ID',
		'survey_question_ID',
		'survey_answer_ID',
		'survey_answer_choice_letter',
		'survey_response_time',
		/*
		'survey_response_responder',
		'survey_response_text',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
