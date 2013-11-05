<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */
?>

<h1>Manage Survey Questions</h1>

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
	'id'=>'survey-question-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'survey_ID',
		'survey_question_number',
		'survey_question_type',
		'survey_question_answer_required',
		'survey_question_default_next_link',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
