<script src='http://code.highcharts.com/highcharts.js' type='text/javascript'> </script>
<div class="stripe">
    	<div class="page-name">
    		<h1>Reports</h1>
    		<!-- Data source select form prototype, data should be retrieved from MySQL 
    			 This form submits selected value to the current page -->
    			<?php 
    				if($currentSurvey) { 
    					echo '<p class="intro-text">Choose data source to view statistical report.</p>';

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
        <div class="content-width">
        	<?php
        		
        		//output report
        		if($currentSurvey){
        	        if ($currentSurvey->questions == null) {
        	            echo '<h2>Add some new questions for "' . $currentSurvey->title . '" first.</h2></br>';
        	        } else {
        	            echo CHtml::link('Download CSV', array('survey/export/id/'.$currentSurvey->id), array('class' => 'button'));
                        $this->renderPartial('/site/_'.$type.'Chart',array(
                            'currentSurvey'=>$currentSurvey,
                            'survey_list_data'=>$survey_list_data,
                            'surveys'=>$surveys,
                        ));
        	        }

                }
        	?>
</div>