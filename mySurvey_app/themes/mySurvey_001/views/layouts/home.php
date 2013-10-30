<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" id="home">
<head>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/main.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

	<!--======== LAYOUT MODEL FOR HOMEPAGE ========-->
    <body>
		
		<!--======== PAGE ========-->
        <div class="container" id="page">

				<!--======== HEADER ========-->
                <div id="header">
                        <div class="makeCenter"><img id="appLogo" src="<?php echo Yii::app()->request->baseUrl; ?>/static/img/logo-white.png"></div>
                </div><!-- header -->


				<!--======== CONTENT: Pulls in index.php ========-->
                <div id="content">
                    <?php echo $content; ?>
                </div><!-- content -->


				<!--======== FOOTER ========-->
                <div id="footer">
                        <p>Footer content tk...</p>
                </div><!-- footer -->

        </div><!-- page -->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/functions.js"></script>
        
    </body>
</html>
