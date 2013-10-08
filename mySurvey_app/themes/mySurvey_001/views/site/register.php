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
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('placeholder'=>'Email')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('placeholder'=>'User Name')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2',array('placeholder'=>'Retype password')); ?>
		<?php echo $form->error($model,'password2'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('placeholder'=>'First name')); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('placeholder'=>'Last name')); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('register'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php echo 'Or '.CHtml::link('Login',array('site/login'),'');?> 