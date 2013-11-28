<?php           
echo CHtml::link('Bar Charts', array('site/reports/type/bar'), array('class' => 'button'));

foreach ($currentSurvey->questions as $question) {
        
        //show piechart for all non-short answer questions
        if ($question->type != 0) {
            echo '<h2>' . $question->text . '</h2><br>';
                                        
            $chartArray = array();
            $answerCount = 0;

            foreach ($question->answers as $answer) {
                $answerCount+=count($answer->responses);
                $chartArray[] = array($answer->text, count($answer->responses));
            }

            if ($answerCount == 0) {
                echo '<h2>Currently there are no responses</h2></br>';
            } else {
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    //'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
                    'options' => array(
                        'gradient' => array('enabled' => true),
                        'credits' => array('enabled' => false),
                        'exporting' => array('enabled' => true),
                        'chart' => array(
                            'plotBackgroundColor' => null,
                            'plotBorderWidth' => null,
                            'plotShadow' => true,
                        ),
                        'legend' => array('enabled' => false),
                        'title' => array('text' => 'Survey Pie Chart'),
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
            }
        }
        //short answers
        else {

            //get all the answer texts
            $answersText = '';
            foreach ($question->answers as $answer) {
                foreach ($answer->responses as $response)
                {
                    $answersText = $answersText . $response->text;
                }
            }

            //count the words
            $wordsArray = array_count_values(str_word_count($answersText, 1));
            arsort($wordsArray);

            $chartArray = array();
            $answerArray = array();
            $responseCount = 0;

            foreach(array_slice($wordsArray, 0, 10) as $w => $c) {
                $chartArray[] = array($w, $c);
                $answerArray[] = array($w);
                $responseCount = count($wordsArray);
            }

            if ($responseCount == 0) {
                echo '<h2>' . $question->text . '</h2>';
                echo '<h4>Currently there are no responses</h4></br>';
                return;
            } else {
                echo '<h2>' . $question->text . '</h2>';
                echo '<h5>Top 10 words used in all responses. To see all the repsonses please use the \'Download CSV\' button above.</h5>';
                //bar chart
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'scripts' => array('highcharts-more', 'modules/exporting', 'themes/grid'),
                    'options' => array(
                        'chart' => array('type' => 'bar'),
                        'credits' => array('enabled' => false),
                        'title' => array(''),
                        'xAxis' => array('categories' => $answerArray, 'title' => array('text' => 'Words')),
                        'yAxis' => array('title' => array('text' => 'Word Counter', 'align' => 'high', 'margin' => 8),
                        'gridLineDashStyle' => 'longdash',
                        'tickInterval' => 1,
                        'min' => 0,
                        'labels' => array('overflow' => 'justify')),
                        'legend' => array('enabled' => false),
                        'tooltip' => array('formatter' => "js:function(){return '<b>' + this.y + ' people used this word in their response</b>'}"),
                        'plotOptions' => array(
                            'bar' => array('groupPadding' => 0, 'pointPadding' => 0.33,
                                'dataLabels' => array('enabled' => true, 'align' => 'right', 'color' => '#FFFFFF', 'x' => -10)),
                            'series' => array('minPointLength' => 2, 'colorByPoint' => false, 'color' => '#1aadce', 'shadow' => true, 'cursor' => 'pointer')),
                        'series' => array(array('data' => $chartArray)),
                        'navigation' => array('buttonOptions' => array('height' => 34, 'width' => 42, 'symbolSize' => 18, 'symbolX' => 19, 'symbolY' => 17, 'symbolStrokeWidth' => 2)),
                        'exporting' => array('enabled' => false, 'filename' => 'MySurvey-report'),
                    )
                ));
                echo '</br>';
            }
        }
    }