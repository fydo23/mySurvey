<div class="stripe">
	<div class="page-name">
		<h1>Reports</h1>
		<p class="intro-text">Choose data source to view statistical report.</p>
    	
    	<!-- Data source select form prototype, data should be retrieved from MySQL 
    	     This form submits selected value to the current page -->
     	<form method="POST" action=""> 
		  <select name="selectReport" style="width:200px" onChange="this.form.submit()">
 		      <option value="0" <?php echo (isset($_POST['selectReport']) && ($_POST['selectReport'] == 0) ? "selected='selected'" : ""); ?>>Overall Data</option> 
 		      <option value="1" <?php echo (isset($_POST['selectReport']) && ($_POST['selectReport'] == 1) ? "selected='selected'" : ""); ?>>Chart-1</option> 
		      <option value="2" <?php echo (isset($_POST['selectReport']) && ($_POST['selectReport'] == 2) ? "selected='selected'" : ""); ?>>Chart-2</option> 
 		      <option value="3" <?php echo (isset($_POST['selectReport']) && ($_POST['selectReport'] == 3) ? "selected='selected'" : ""); ?>>Chart-3</option> 
	      </select>  
	    </form> 
    	
	</div>
</div>
<div class="content-width">
	</br>
	<?php

    	if (!isset($_POST['selectReport'])) {
    	    $_POST['selectReport'] = 0;
    	} 
	       
    	// Show the selected report 
    	switch ($_POST['selectReport']) {
    		case 0:
    		    /**
    		     * Combination chart
    		     */
    		    $this->Widget('ext.highcharts.HighchartsWidget', array(
    		            'scripts' => array('highcharts-more', 'modules/exporting'),
    		            'options'=>array(
    		                    'chart' => array(),
    		                    'title' => array('text' => 'Statistical data'),
    		                    'xAxis' => array('categories' => array('Design', 'xAxis', 'some', 'value', 'here')),
    		                    'yAxis' => array('title' => array('text' => 'yAxis value')),
    		                    'tooltip' => array(
            		                    'formatter' => "js:function() {
            		                        var s;
            		                        if (this.point.name) { 
            		                            s = ''+ this.point.name +': '+ this.y +' value here';
            		                        } else {
            		                            s = ''+ this.x  +': '+ this.y;
            		                        }
            		                        return s;
            		                    }"),
            		            'labels' => array('items' => array(
            		                    	         'html' => 'Small Pie Chart',
            		                    	         'style' => array(
                        		                          'left' => '40px',
                        		                    	  'top' => '8px',
                        		                    	  'color' => 'black')
            		                              )),
    		                    'series' => array(
    		                            array('type' => 'column', 'name' => 'Survey-1', 'data' => array(3, 2, 1, 3, 4)),
    		                            array('type' => 'column', 'name' => 'Survey-2', 'data' => array(2, 3, 5, 7, 6)),
    		                            array('type' => 'column', 'name' => 'Survey-3', 'data' => array(4, 3, 3, 9, 0)),
    		                            array('type' => 'spline', 'name' => 'Average', 'data' => array(3, 2.67, 3, 6.33, 3.33), 
    		                                      'marker' => array('lineWidth'=> 2, 'lineColor'=> 'Highcharts.getOptions().colors[3]', 'fillColor' => 'white')
    		                            ),
    		                            array('type' => 'pie', 
    		                                  'name' => 'Total', 
    		                                  'data' => array(
    		                                      array('name' => 'Survey-1', 'y' => 13, 'color' => 'Highcharts.getOptions().colors[0]'),
    		                                      array('name' => 'Survey-2', 'y' => 23, 'color' => 'Highcharts.getOptions().colors[1]'),
    		                                      array('name' => 'Survey-3', 'y' => 19, 'color' => 'Highcharts.getOptions().colors[2]')
    		                                      ),
    		                                  'center' => array(100,80),
    		                                  'size' => 100,
    		                                  'showInLegend' => false,
    		                                  'dataLabels' => array('enabled' => false)
    		                            )
    		                      )
    		            )
    		    ));
    		    break;
    		case 1:
    		    /**
    		     * Pie chart
    		     */
    		    $this->Widget('ext.highcharts.HighchartsWidget', array(
    		            'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
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
    		                                    'data' => array(
    		                                            array('label1', 63.51),
    		                                            array('label2', 35.14),
    		                                            array('label3', 1.35)),
    		                            )
    		                    ),
    		            )
    		    ));
    		    break;
    		case 2:
    		    /**
    		     * Basic column
    		     */
    		    $this->Widget('ext.highcharts.HighchartsWidget', array(
    		            'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
    		            'options' => array(
    		                    'title' => array(
    		                            'text' => 'Monthly Summary'),
    		                    'subtitle' => array(
    		                            'text' => '# of surveys by month'),
    		                    'xAxis' => array(
    		                            'title' => array('text' => 'Month'),
    		                            'categories' => array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')),
    		                    'yAxis' => array(
    		                            'min' => 0,
    		                            'title' => array('text' => 'Number')),
    		                    'tooltip' => array(
    		                            'headerFormat' => '<span style="font-size:10px">{point.key}</span><table>',
    		                            'pointFormat' => '<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y}</b></td></tr>',
    		                            'footerFormat' => '</table>',
    		                            'shared' => 'true',
    		                            'useHTML' => 'true'),
    		                    'plotOptions' => array(
    		                            'column' => array('pointPadding' => 0.2, 'borderWidth'=> 0)),
    		                    'series' => array(
    		                            array(
    		                              'type' => 'column',
    		                              'name' => 'aaa@aaa.com\'s surveys', 
    		                              'data' => array(0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 2, 5)))
    		            )
    		    ));
    		    break;
    		case 3:
    		    /**
    		     * Column with labels
    		     */
    		    $this->Widget('ext.highcharts.HighchartsWidget', array(
    		            'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
    		            'options' => array(
    		                    'title' => array(
    		                            'text' => 'Monthly Summary with rotated labels'),
    		                    'subtitle' => array(
    		                            'text' => '# of surveys by month'),
    		                    'xAxis' => array(
    		                            'categories' => array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')),
    		                    'labels' => array(
    		                            'rotation' => -45,
    		                            'align' => 'right',
    		                            'style' => array(
    		                                    'fontSize' => '13px',
    		                                    'fontFamily' => 'Verdana, sans-serif')),
    		                    'yAxis' => array(
    		                            'min' => 0,
    		                            'title' => array('text' => 'Number')),
    		                            'legend' => array('enabled' => 'false'),
    		                            'tooltip' => array(
    		                            'headerFormat' => '<span style="font-size:10px">{point.key}</span><table>',
    		                            'pointFormat' => '<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y}</b></td></tr>',
    		                            'footerFormat' => '</table>',
    		                            'shared' => 'true',
    		                            'useHTML' => 'true'),
    		                    'plotOptions' => array(
    		                            'column' => array('pointPadding' => 0.2, 'borderWidth'=> 0)),
    		                    'series' => array(
    		                            array(
        		                            'type' => 'column',
        		                            'dataLabels' => array(
        		                            'enabled' => true,
        		                            'rotation' => -90,
        		                            'color' => '#FFFFFF',
        		                            'align' => 'right',
        		                            'x' => 4,
        		                            'y' => 10,
        		                            'style' => array(
            		                            'fontSize' => '13px',
            		                            'fontFamily' => 'Verdana, sans-serif',
            		                            'textShadow' => '0 0 3px black'
            		                                    )),
    		                                'margin' => array(50, 50, 100, 80),
    		                                'name' => 'aaa@aaa.com\'s surveys', 'data' => array(0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 2, 5)))
    		            )
    		    ));
    		  break;
//     		default:
//     		    /**
//     		     * Default pie chart
//     		     */
//     		    $this->Widget('ext.highcharts.HighchartsWidget', array(
//     		            'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
//     		            'options' => array(
//     		                    'gradient' => array('enabled'=> true),
//     		                    'credits' => array('enabled' => false),
//     		                    'exporting' => array('enabled' => true),
//     		                    'chart' => array(
//     		                            'plotBackgroundColor' => null,
//     		                            'plotBorderWidth' => null,
//     		                            'plotShadow' => true,
//     		                    ),
//     		                    'legend' => array( 'enabled' => false),
//     		                    'title' => array( 'text' => 'Survey Pie Chart'),
//     		                    'tooltip' => array(
//     		                            'pointFormat' => '{series.name}: <b>{point.percentage}%</b>',
//     		                            'percentageDecimals' => 1,
//     		                    ),
//     		                    'plotOptions' => array(
//     		                            'pie' => array(
//     		                                    'allowPointSelect' => true,
//     		                                    'cursor' => 'pointer',
//     		                                    'dataLabels' => array(
//     		                                            'enabled' => true,
//     		                                            'color' => '#000000',
//     		                                            'connectorColor' => '#000000',
//     		                                            'formatter' => "js:function(){return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';}",
//     		                                    ),
//     		                            )
//     		                    ),
//     		                    'series' => array(
//     		                            array(
//     		                                    'type' => 'pie',
//     		                                    'name' => '% d\'utilisation',
//     		                                    'data' => array(
//     		                                            array('label1', 63.51),
//     		                                            array('label2', 35.14),
//     		                                            array('label3', 1.35)),
//     		                            )
//     		                    ),
//     		            )
//     		    ));
//     		    break;
    	   }
	?>
</br>
</div>