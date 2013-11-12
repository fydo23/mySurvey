<?php Yii::app()->controller->layout = 'home'; 
	foreach($question_dataProvider->getData() as $question){
		echo '<h1>'.$question->text.' type:'.$question->type.'</h1></br>';
		foreach ($answer_array[$question->id] as $answer){
			echo '<h2> text:'.$answer->text.'</h2></br>';
		}
	}
?>