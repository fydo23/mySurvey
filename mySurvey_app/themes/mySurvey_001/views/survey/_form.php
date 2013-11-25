<?php
/* @var $this SurveyResponseController */
/* @var $model SurveyResponse */
/* @var $form CActiveForm*/
/*
 * answer type value table
 * 0: short answer
 * 1: true/false
 * 2: multiple choice
 * 3: multiple select
 */
?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php
		echo CHtml::hiddenField('SurveyResponse['.$question->id.'][survey_question_type]',$question->type);
		if($question->type==0){ 
				
				echo CHtml::hiddenField('SurveyResponse['.$question->id.'][survey_answer_id]',$question->answers[0]->id);
				echo $form->textArea($model,'['.$question->id.']text').'</br>';
				echo $form->error($model,'['.$question->id.']text').'</br>';
		}
		else if($question->type==1||$question->type==2){
			$radioArray=array();
			foreach ($question->answers as $answer){
				$radioArray[$answer->id]=$answer->text;
			}
			
			echo $form->radioButtonList($model,'['.$question->id.']text',$radioArray).'</br>';				
			echo $form->error($model,'['.$question->id.']text').'</br>';
		}
		else if($question->type==3){
			$checkBoxArray=array();
			foreach ($question->answers as $answer){
				$checkBoxArray[$answer->id]=$answer->text;
			}
			
			echo $form->checkBoxList($model,'['.$question->id.']text',$checkBoxArray).'</br>';				
			echo $form->error($model,'['.$question->id.']text').'</br>';
		}
		else{
			echo 'Unknown question type!!</br>';
		}?>
	</div>