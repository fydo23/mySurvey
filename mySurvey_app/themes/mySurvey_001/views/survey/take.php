<div class="stripe">
	<div class="page-name">
		<h1>Take Survey</h1>
		<p class="intro-text">some text here.</p>
	</div>
</div>
<?php 
	foreach($question_dataProvider->getData() as $question){
		echo '<h1>'.$question->text.'</h1></br>';
		foreach ($answer_array[$question->id] as $answer){
			echo '<h2>'.$answer->text.'</h2></br>';
		}
	}
?>