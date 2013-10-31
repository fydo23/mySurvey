<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */
?>

<h1>Update SurveyQuestion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'answer_dataProvider'=>$answer_dataProvider)); ?>