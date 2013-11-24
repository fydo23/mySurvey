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
				echo '<h1>'.$question->text.'</h1></br>';
				//show piechart for all non-short answer questions
				if($question->type!=0){
					$chartArray=array();
					$answerCount=0;
					
					foreach ($question->answers as $answer){
							$answerCount+=count($answer->responses);
							$chartArray[]=array($answer->text,count($answer->responses));
					}
					
					if($answerCount==0){
						echo '<h2>Currently there are no responses</h2></br>';
					} else {
					$this->Widget('ext.highcharts.HighchartsWidget', array(
						//'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
						'options' => array(
								'gradient' => array('enabled'=> true),
								'credits' => array('enabled' => false),
								'exporting' => array('enabled' => true),
								'chart' => array(
										'plotBackgroundColor' => null,
										'plotBorderWidth' => null,
										'plotShadow' => true,
								),
								'legend' => array( 'enabled' => false),
								'title' => array( 'text' => 'Survey Pie Chart'),
								'tooltip' => array(
										'pointFormat' => '{series.name}: <b>{point.percentage}%</b>',
										'percentageDecimals' => 1,
								),
								'plotOptions' => array(
										'pie' => array(
												'allowPointSelect' => true,
												'cursor' => 'pointer',
												'dataLabels' => array(
														'enabled' => true,
														'color' => '#000000',
														'connectorColor' => '#000000',
														'formatter' => "js:function(){return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';}",
												),
										)
								),
								'series' => array(
										array(
												'type' => 'pie',
												'name' => '% d\'utilisation',
												'data' => $chartArray,
										)
								),
						)
						));
				}}
				//short answers
				else{
					echo 'short answer report goes here!!';
				}
			}
		}
		//end of output report
	?>
	
</div>