<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);
?>
<h1>Register</h1>
<p>Please fill out the following form to register:</p>
<?php echo 'Or '.CHtml::link('Login',array('site/login'),'');?> 