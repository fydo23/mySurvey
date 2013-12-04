<script src='http://code.highcharts.com/highcharts.js' type='text/javascript'> </script>
<div class="stripe reports">
    	<div class="page-name">
    		<h1>Reports</h1>
    		<!-- Data source select form prototype, data should be retrieved from MySQL 
    			 This form submits selected value to the current page -->
    			<?php 
    				if($currentSurvey) { 
    					echo '<p class="intro-text">View real-time results as soon as your survey responses roll in. <br><span>Select a Survey:</span></p>';

                        $form=$this->beginWidget('CActiveForm'); 

        					echo $form->dropDownList(new Survey(), 'id', $survey_list_data, array(
        						'onChange' => "this.form.submit()", 
        						'options'=> array( 
        							$currentSurvey->id => array('selected'=>true)
        						)
        					)); 

                        $this->endWidget();
    				} else {
    					echo '<p class="intro-text">To get started, please create a new survey.</p></br>';
    				}?>
        	</div>
        </div>
        <div class="content-width reports-content">
        	<?php
        		
        		//output report
        		echo "<div class='report-basics'>";
        		if($currentSurvey){
        	        if ($currentSurvey->questions == null) {
        	            echo '<h2 class="no-questions">Oops! First, create some questions for "' . $currentSurvey->title . '".</h2></br>';
        	        } else {
						echo '<h2 id="analysis-headline">' . $currentSurvey->title . '</h2>';
						echo '<div class="totalNum"><p class="intro-text"> Total number of people who took the survey:  ', count($currentSurvey->responseHashes), '</p></div>';
        	            
        	            echo CHtml::link('Download Full Report (.csv)', array('survey/export/id/'.$currentSurvey->id), array('class' => 'button'));
        	            echo "</div>";
        	            
        	            
                        $this->renderPartial('/site/_'.$type.'Chart',array(
                            'currentSurvey'=>$currentSurvey,
                            'survey_list_data'=>$survey_list_data,
                            'surveys'=>$surveys,
                        ));
        	        }

                }
        	?>
</div>