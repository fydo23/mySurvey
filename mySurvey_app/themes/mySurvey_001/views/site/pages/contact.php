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
<div class="contact-us">
	<h1>Contact Us</h1>

	<p>000 Commonwealth Avenue<br>
	Boston, MA 02215
	</p>

	<p class="white"><br>If you have business inquiries or other questions, <br>please contact us at 617-000-0000 or via <a href="#">email</a>.</p>

	<div class="back-button"><?php echo CHtml::link('Back', Yii::app()->request->baseUrl.'/survey'); ?></div>

</div>