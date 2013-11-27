<script src='http://code.highcharts.com/highcharts.js' type='text/javascript'> </script>
<div class="stripe">
	<div class="page-name">
		<h1>Reports</h1>
    	<!-- Data source select form prototype, data should be retrieved from MySQL 
    	     This form submits selected value to the current page -->
			<form method="POST" action=""> 
				<?php 
					if($currentSurvey) { 
						echo '<p class="intro-text">Choose data source to view statistical report.</p>';
						echo CHtml::activeDropDownList(new Survey(), 'id', $survey_list_data, 
						array(
							'onChange' => "this.form.submit()", 
							'options'=> array( 
								$currentSurvey->id => array('selected'=>true)
							)
						)); 
					} else {
						echo '<p class="intro-text">To get started, please create a new survey.</p></br>';
					}
				?>
			</form>
	</div>
</div>
<div class="content-width">
	</br>
	<?php
	//output report
	if($currentSurvey){
		if($currentSurvey->questions == null) {
			echo '<h2>Add some new questions for "' . $currentSurvey->title . '" first.</h2></br>';
		} else {
			echo CHtml::link('Download CSV',array('survey/export/id/'.$currentSurvey->id),array('class'=>'button'));
		}
		
		foreach ($currentSurvey->questions as $question){
			//show piechart for all non-short answer questions
			if($question->type!=0){
				$chartArray=array();
				$answerArray=array();
				$responseCount=0;
				
	    		foreach ($question->answers as $answer){
	    				$chartArray[]=array($answer->text,count($answer->responses));
						$answerArray[]=array($answer->text);
						$responseCount+=count($answer->responses);
	    		}
				
				if($responseCount == 0){
					echo '<h2>Currently there are no responses</h2></br>';
					return;
				} else {
					echo '<h2>'.$question->text.'</h2>';
					
					//bar chart
	    		    $this->Widget('ext.highcharts.HighchartsWidget', array(
							'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
	    		            'options' => array(
									'chart' => array('type' => 'bar'),
									'title' => array(''),
	    		                    'xAxis' => array('categories' => $answerArray, 'title' => array('text' => null)),
									'yAxis' => array('title' => array('text' => 'Response', 'align'=>'high', 'margin'=>8),
													 'gridLineDashStyle'=> 'longdash',
													 'tickInterval'=> 1,
													 'min'=>0,
												 	 'labels' => array('overflow' => 'justify')),
	    		                    'legend' => array('enabled'=> false),
	    		                    'tooltip' => array('formatter' => "js:function(){return '<b>' + this.y + ' people chose this answer</b>'}"),
	    		                    'plotOptions' => array(
													'bar' => array('groupPadding'=> 0, 'pointPadding'=>0.33, 
																	'dataLabels' => array('enabled' => true, 'align'=>'right', 'color'=>'#FFFFFF', 'x'=>-10)),
													'series' => array('minPointLength'=>2, 'colorByPoint'=>false, 'color'=>'#1aadce', 'shadow'=>true, 'cursor'=>'pointer')),
	    		                    'series' => array(array('data' => $chartArray)),
									'navigation' => array('buttonOptions' => array('height'=>34, 'width'=>42, 'symbolSize'=>18, 'symbolX'=>19, 'symbolY'=>17, 'symbolStrokeWidth'=>2)),
									'exporting' => array('enabled' => false, 'filename' => 'MySurvey-report'),
								)
	    		    ));
					echo '</br>';
				}
			}
    	    //short answers
    		else{
				echo '<h2>'.$question->text.'</h2>';
    			echo 'short answer report goes here!!</br></br>';
    		}}
    	}
    	//end of output report
	?>
</div>