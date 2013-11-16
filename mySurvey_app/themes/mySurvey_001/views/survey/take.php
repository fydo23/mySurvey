<?php Yii::app()->controller->layout = 'takeLayout'; 
	echo '<h1>'.$title.'</h1></br></br>';
	$questionNum = 0;
	foreach($questions as $question){
		echo '<h2>'.++$questionNum.'. '.$question->text.'</h2></br>';
		//foreach($question->answers as $idx => $answer){
            $this->renderPartial('/response/_form',array(
                         'model'=>new SurveyResponse('template'),
                          'answers'=>$question->answers
                     ));
			//echo '<h4> text:'.$answer->text.'</h4></br>';
        //}
	}
?>