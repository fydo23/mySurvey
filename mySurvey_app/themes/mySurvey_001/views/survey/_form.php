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
		if($question->type==0){ 
				echo $form->labelEx($model,'['.$arrayNum.']survey_response_text').'</br>';
				echo $form->textField($model,'['.$arrayNum.']survey_response_text').'</br>';
				echo $form->error($model,'['.$arrayNum.']survey_response_text').'</br>';
		}
		else if($question->type==1||$question->type==2){
			$radioArray=array();
			foreach ($question->answers as $i=>$answer){
				$radioArray[$i]=$answer->text;
			}
			echo $form->labelEx($model,'['.$arrayNum.']survey_response_text').'</br>';
			echo $form->radioButtonList($model,'['.$arrayNum.']survey_response_text',$radioArray).'</br>';				
			echo $form->error($model,'['.$arrayNum.']survey_response_text').'</br>';
		}
		else if($question->type==3){
			$checkArray=array();
			foreach ($question->answers as $i=>$answer){
				$checkArray[$i]=$answer->text;
			}
			echo $form->labelEx($model,'['.$arrayNum.']survey_response_text').'</br>';
			echo $form->checkBoxList($model,'['.$arrayNum.']survey_response_text',$checkArray).'</br>';				
			echo $form->error($model,'['.$arrayNum.']survey_response_text').'</br>';
		}
		else{
			echo 'Unknown question type!!</br>';
		}
		?>
	</div>