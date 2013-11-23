<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
Yii::app()->controller->layout = 'home'; 
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Contact Page</h1>

<?php echo CHtml::link('Back', Yii::app()->request->baseUrl.'/survey/'); ?>

