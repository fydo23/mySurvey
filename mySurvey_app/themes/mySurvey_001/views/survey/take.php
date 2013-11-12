<?php Yii::app()->controller->layout = 'takeLayout'; 
	echo '<h1>'.$title.'</h1></br></br>';
	foreach($question_dataProvider->getData() as $question){
		echo '<h2>'.$question->text.' type:'.$question->type.'</h2></br>';
		foreach ($answer_array[$question->id] as $answer){
			echo '<h4> text:'.$answer->text.'</h4></br>';
		}
	}
?>