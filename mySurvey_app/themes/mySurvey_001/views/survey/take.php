<?php Yii::app()->controller->layout = 'takeLayout'; 
	echo '<h1>'.$title.'</h1></br></br>';
	$questionNum = 0;
	foreach($questions as $question){
		echo '<h2>'.++$questionNum.'. '.$question->text.'</h2></br>';
		//foreach($question->answers as $idx => $answer) {
			$model = new SurveyResponse;
            $this->renderPartial('/response/_form',array(
                         'model'=>$model
                     ));
			//echo '<h4> text:'.$answer->text.'</h4></br>';
        //}
	}
?>