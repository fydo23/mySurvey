<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" id="home">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/main.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div class="makeCenter"><img id="appLogo" src="http://localhost/static/img/logo.png"></div>
	</div><!-- header -->

                
        <div id="content">
            <?php echo $content; ?>
        </div>
                

	<div id="footer">
		<p>Footer content tk...</p>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
