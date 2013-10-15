<?php Yii::app()->controller->layout = 'home'?> 
<?php $action = Yii::app()->controller->action->id ?>
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<?php
/* Redirect to survey index if the user is logged in. */
if (Yii::app()->user->id) {
  $this->redirect(array('/survey'));
}?>

<div id="top-half">

	<h1>Design. Collect. Analyze.</h1>

	<p>MySurvey is a web application that allows you to create, share and analyze online surveys.</p>

	<div id="login-logout">
                <a id="register-link" class="button">Sign up</a>
                <p>or <a id="sign-in">Sign in</a></p>
	</div>




	<div id="login" class="modal" <?php if($action=='login')echo 'data-visible="True"' ?>>
  		<div class="form">
        	<?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->request->baseUrl . '/login',
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
			)); ?>

                

                <div class="row">
                        
                        <?php echo $form->textField($loginForm,'email',array('placeholder'=>'email')); ?>
                        <span class="arrow-left"></span><?php echo $form->error($loginForm,'email'); ?>
                </div>

                <div class="row">
                        
                        <?php echo $form->passwordField($loginForm,'password',array('placeholder'=>'password')); ?>
                        <span class="arrow-left"></span><?php echo $form->error($loginForm,'password'); ?>
                </div>

                <div class="row rememberMe">
                        <?php echo $form->checkBox($loginForm,'rememberMe'); ?>
                        <?php echo $form->label($loginForm,'rememberMe'); ?>
                        <span class="arrow-left"></span><?php echo $form->error($loginForm,'rememberMe'); ?>
                </div>

                <div class="row buttons">
                        <?php echo CHtml::submitButton('Sign in'); ?>
                </div>

			<?php $this->endWidget(); ?>
		</div>
    
		<p>or <a id="register-btn">Sign up</a></p>
    
	</div>
    
    
	<div id="register" class="modal" <?php if($action=='register')echo 'data-visible="True"' ?>>

   		<div class="form">

       		<?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->request->baseUrl . '/register',
                'id'=>'register-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
			)); ?>


				<div class="row">
                    
                    <?php echo $form->textField($surveyCreator,'first_name',array('placeholder'=>'first name')); ?>
                    <span class="arrow-left"></span><?php echo $form->error($surveyCreator,'first_name'); ?>
				</div>

				<div class="row">
                    
                    <?php echo $form->textField($surveyCreator,'last_name',array('placeholder'=>'last name')); ?>
                    <span class="arrow-left"></span><?php echo $form->error($surveyCreator,'last_name'); ?>
				</div>
				
				<div class="row">
                    
                    <?php echo $form->textField($surveyCreator,'email',array('placeholder'=>'email')); ?>
                    <span class="arrow-left"></span><?php echo $form->error($surveyCreator,'email'); ?>
				</div>

				<div class="row">
                    
                    <?php echo $form->passwordField($surveyCreator,'password',array('placeholder'=>'password')); ?>
                    <span class="arrow-left"></span><?php echo $form->error($surveyCreator,'password'); ?>
				</div>

				<div class="row">
                    
                    <?php echo $form->passwordField($surveyCreator,'password_repeat',array('placeholder'=>'retype password')); ?>
                    <span class="arrow-left"></span><?php echo $form->error($surveyCreator,'password_repeat'); ?>
				</div>

				

				<div class="row buttons">
                    <?php echo CHtml::submitButton('Sign up'); ?>
				</div>
			<?php $this->endWidget(); ?>
		</div>
		
		<p>or <a id="sign-in-btn">Sign in</a></p>
		
	</div>

</div>

