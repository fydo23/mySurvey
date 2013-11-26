<script src='http://code.highcharts.com/highcharts.js' type='text/javascript'> </script>
<div class="stripe">
	<div class="page-name">
		<h1>Reports</h1>
		<p class="intro-text">Choose data source to view statistical report.</p>
    	
    	<!-- Data source select form prototype, data should be retrieved from MySQL 
    	     This form submits selected value to the current page -->
			<form method="POST" action=""> 
				<?php echo CHtml::activeDropDownList(new Survey(), 'id', $survey_list_data, 
					array(
						'onChange' => "this.form.submit()", 
						'options'=> array( 
							$currentSurvey->id => array('selected'=>true)
						)
				)); ?>
			</form>
	</div>
</div>
<div class="content-width">
	</br>
	<?php
        
	//output report
	if($currentSurvey){

		echo CHtml::link('Download CSV',array('survey/export/id/'.$currentSurvey->id),array('class'=>'button'));

		$questions = array();
		foreach ($currentSurvey->questions as $question)
			$questions[$question->order_number] = $question;
		ksort($questions);
		foreach ($questions as $question){
			//show piechart for all non-short answer questions
			if($question->type!=0){
				$chartArray=array();
				$answerCount=0;
				$answerArray=array();
				
	    		foreach ($question->answers as $answer){
						$answerCount+=count($answer->responses);
	    				$chartArray[]=array($answer->text,count($answer->responses));
						$answerArray[]=array($answer->text);
	    		}
				
				if($answerCount==0){
					echo '<h2>Currently there are no responses</h2></br>';
					return;
				} else {
					echo '<h2>'.$question->text.'</h2></br>';
					
					//bar chart
	    		    $this->Widget('ext.highcharts.HighchartsWidget', array(
							//'scripts' => array('highcharts-more','themes/grid'),
	    		            'options' => array(
									'chart' => array('type' => 'bar'),
									'title' => array(''),
	    		                    'xAxis' => array('categories' => $answerArray, 'title' => array('text' => null)),
									'yAxis' => array('title' => array('text' => 'Response', 'align'=>'high', 'margin'=>20),
													 'gridLineDashStyle'=> 'longdash',
													 'tickInterval'=> 1,
													 'min'=>0,
												 	 'labels' => array('overflow' => 'justify')),
	    		                    'legend' => array('enabled'=> false),
	    		                    'tooltip' => array('formatter' => "js:function(){return '<b>' + this.y + ' people chose this answer</b>'}"),
	    		                    'plotOptions' => array(
													'bar' => array('groupPadding'=> 0, 'pointPadding'=>0.33, 
																	'dataLabels' => array('enabled' => true, 'align'=>'right', 'color'=>'#FFFFFF', 'x'=>-10)),
													'series' => array('minPointLength'=>1, 'colorByPoint'=>false, 'color'=>'#1aadce', 'shadow'=>true, 'cursor'=>'pointer')),
	    		                    'series' => array(array('data' => $chartArray)),
	    		            )
	    		    ));
					
				}
			}
    	    //short answers
    		else{
				echo '<h2>'.$question->text.'</h2>';
    			echo 'short answer report goes here!!</br>';
    		}
    	}
    	}
    	//end of output report
	?>
	
</div>