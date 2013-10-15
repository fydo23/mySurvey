<?php Yii::app()->controller->layout = 'home'?> 

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php
/* Redirect to survey index if the user is logged in. */
if (Yii::app()->user->id) {
  $this->redirect(array('/survey'));
}?>

<h1>Lorem ipsum headline goes here.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed nulla ultricies, pellentesque felis nec, fringilla augue. Sed rutrum in nibh a mollis.</p>

<div id="login-logout">
        <a href="#register" class="button">Sign up</a>
        <p>or <a href="#login" id="sign-in">Sign in</a></p>
</div>




<div id="login" class="modal">
    <h1>Login</h1>
    <p>Please fill out the following form with your login credentials:</p>
    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->request->baseUrl . '/login',
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )); ?>

                <p class="note">Fields with <span class="required">*</span> are required.</p>

                <div class="row">
                        <?php echo $form->labelEx($loginForm,'email'); ?>
                        <?php echo $form->textField($loginForm,'email',array('placeholder'=>'email')); ?>
                        <?php echo $form->error($loginForm,'email'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($loginForm,'password'); ?>
                        <?php echo $form->passwordField($loginForm,'password',array('placeholder'=>'password')); ?>
                        <?php echo $form->error($loginForm,'password'); ?>
                </div>

                <div class="row rememberMe">
                        <?php echo $form->checkBox($loginForm,'rememberMe'); ?>
                        <?php echo $form->label($loginForm,'rememberMe'); ?>
                        <?php echo $form->error($loginForm,'rememberMe'); ?>
                </div>

                <div class="row buttons">
                        <?php echo CHtml::submitButton('Login'); ?>
                </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
    
<div id="register" class="modal">
    <h1>Register</h1>
    <p>Please fill out the following form to register:</p>
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->request->baseUrl . '/register',
                'id'=>'register-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )); ?>
            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <div class="row">
                    <?php echo $form->labelEx($surveyCreator,'email'); ?>
                    <?php echo $form->textField($surveyCreator,'email',array('placeholder'=>'Email')); ?>
                    <?php echo $form->error($surveyCreator,'email'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($surveyCreator,'password'); ?>
                    <?php echo $form->passwordField($surveyCreator,'password',array('placeholder'=>'Password')); ?>
                    <?php echo $form->error($surveyCreator,'password'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($surveyCreator,'password_repeat'); ?>
                    <?php echo $form->passwordField($surveyCreator,'password_repeat',array('placeholder'=>'Retype password')); ?>
                    <?php echo $form->error($surveyCreator,'password_repeat'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($surveyCreator,'first_name'); ?>
                    <?php echo $form->textField($surveyCreator,'first_name',array('placeholder'=>'First name')); ?>
                    <?php echo $form->error($surveyCreator,'first_name'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($surveyCreator,'last_name'); ?>
                    <?php echo $form->textField($surveyCreator,'last_name',array('placeholder'=>'Last name')); ?>
                    <?php echo $form->error($surveyCreator,'last_name'); ?>
            </div>

            <div class="row buttons">
                    <?php echo CHtml::submitButton('register'); ?>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>





<div id="learn-more">
        <p><a class="learn" href="#about">learn more</a></p>
</div>

<div id="about"> 
	
	<div id="what-it-is">
		<div class="text">
			<h1>Surveys made easy</h1>
			<p>Nullam et mollis neque, egestas faucibus urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras nec turpis et nisl vestibulum aliquam pharetra a dui.</p>
		</div>
		<div class="image">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/static/img/placeholder.gif">
		</div>		
	</div>
	
	
	<div id="feature-1">	
		<div class="image">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/static/img/placeholder.gif">
		</div>				
		<div class="text">
			<h1>Wherever you are</h1>
			<p>Nullam et mollis neque, egestas faucibus urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras nec turpis et nisl vestibulum aliquam pharetra a dui.</p>
		</div>				
	</div>
	
	
	<div id="feature-2">
		<div class="text">
			<h1>Analyzing results</h1>
			<p>Nullam et mollis neque, egestas faucibus urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras nec turpis et nisl vestibulum aliquam pharetra a dui.</p>
		</div>
		<div class="image">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/static/img/placeholder.gif">
		</div>		
	</div>
	
		
</div>

<?php if(yii::app()->user->isGuest){?>
    <div id="signup-button">
                    <a href="#register" class="button">Sign up</a>
    </div>
<?php }?>