<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login In/Register';
$this->breadcrumbs=array(
	'Login In/Register',
);
?>
<?php echo '<div>logo here</div>'?>
<?php echo '<p>Lorem ipsum text about MySurvey</p>'?>
<?php echo CHtml::button('Register',array('submit'=>array('site/register')),'').'</br>';?>
<?php echo 'Or '.CHtml::link('Login',array('site/login'),'');?> 