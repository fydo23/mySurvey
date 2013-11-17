<?php Yii::app()->controller->layout = 'takeLayout'; 
	echo '<h1>'.$model->title.'</h1></br></br>';
	$questionNum = 0;
	$responseModels=array(); ?>
	<div class="form">
<?php
	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-response-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php
	foreach($questions as $i=>$question){
		echo '<h2>'.++$questionNum.'. '.$question->text.'</h2></br>';
			$responseModels[$i]=new SurveyResponse('template');
            $this->renderPartial('/survey/_form',array(
                        'model'=>$responseModels[$i],
                        'question'=>$question,
            			'form'=>$form,
                     ));
	}?>
	<div class="row buttons">
	<?php 
	$userID = null;
	if(!Yii::app()->user->isGuest)
		$userID = SurveyCreator::model()->findByAttributes(array('email'=> Yii::app()->user->getId()))->id;
	if($model->survey_creator_ID != $userID)
		echo CHtml::submitButton('Submit');
	else
		echo CHtml::link('Back to Edit Survey', '/survey/update/'. $model->id);
	$this->endWidget();
	?>
	</div>
</div><!-- end form -->