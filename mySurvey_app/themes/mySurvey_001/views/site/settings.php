<div class="stripe">
	<div class="page-name">
		<h1>Account Settings</h1>
		<p class="intro-text">Need to update your account information?<br> Review and update your settings below or reset your password.</p>
	</div>
</div>

<div class="content-width">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-settings',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	
    
    <div class="row">

		<?php echo $form->textField($model,'first_name',array('placeholder'=>'first name')); ?>
		<span class="arrow-left"></span><?php echo $form->error($model,'first_name'); ?>
	</div>
	
	<div class="row">

		<?php echo $form->textField($model,'last_name',array('placeholder'=>'last name')); ?>
		<span class="arrow-left"></span><?php echo $form->error($model,'last_name'); ?>
	</div>
	        
	<div class="row">

		<?php echo $form->passwordField($model,'password',array('placeholder'=>'old password')); ?>
		<span class="arrow-left"></span><?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">

		<?php echo $form->passwordField($model,'new_password',array('placeholder'=>'new password')); ?>
		<span class="arrow-left"></span><?php echo $form->error($model,'new_password'); ?>
	</div>
	
	<div class="row">

		<?php echo $form->passwordField($model,'new_password_repeat',array('placeholder'=>'retype new password')); ?>
		<span class="arrow-left"></span><?php echo $form->error($model,'new_password_repeat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="button" onclick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/survey';" value="Cancel" />
	</div>

<?php $this->endWidget(); ?>
</div>