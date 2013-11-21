<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="language" content="en" />


            <!--======== CSS FRAMEWORK ========-->
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/print.css" media="print" />
            <!--[if lt IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/ie.css" media="screen, projection" />
            <![endif]-->

            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/main.css" />

            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/jquery.min.js"></script>-->
            
            <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>


	<!--======== LAYOUT MODEL FOR INTERIOR PAGES ========-->
    <body>
    
    	<!--======== PAGE ========-->
        <div class="container take-survey-view" id="page">


				

				
			<!--======== MENU + MAIN CONTENT AREA ========-->
            <div class="content-area">
                
                
                		
                        

				<!--======== BREADCRUMBS ========-->
                <?php if(isset($this->breadcrumbs)):?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links'=>$this->breadcrumbs,
                        )); ?><!-- breadcrumbs -->
                <?php endif?>


				<!--======== CONTENT: Pulls in .php views from Site & Survey ========-->
                <div id="content">
                    <?php echo $content; ?>
                </div><!-- content -->
            
            </div><!-- content-area -->        



				<!--======== FOOTER ========-->
                <div id="footer">
                        <p>Powered by MySurvey</p>
                </div><!-- footer -->

        </div><!-- page -->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/jquery-ui.min.js"></script>-->
	   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/functions.js"></script>
        
    </body>
</html>
