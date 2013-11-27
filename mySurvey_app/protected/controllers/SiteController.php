<?php

/**
 * Default controller class. It will handle request to the homepage level.
 */
class SiteController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                        array('allow',
                                'actions'=>array('index', 'register', 'login', 'view'),
                                'users'=>array('?'),
                        ),
			array('deny',
				'users'=>array('?'),
			),
		);
	}
        
        
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            
            $this->render('index',array(
                'loginForm'=>new LoginForm(), 
                'surveyCreator'=>new SurveyCreator('register')
            ));
	}
        
        
        public function actionView($page){
            $this->render('pages/'.$page);
        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$loginForm=new LoginForm();

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($loginForm);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$loginForm->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($loginForm->validate() && $loginForm->login())
				$this->redirect(Yii::app()->request->baseUrl . '/survey');
		}
                $this->render('index',array(
                    'loginForm'=>$loginForm, 
                    'surveyCreator'=>new SurveyCreator('register')
                ));
	}
	/**
	 * Displays the login or register selection page
	 */
	public function actionRegister()
	{
		$survey_creator = new SurveyCreator('register');
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($survey_creator);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['SurveyCreator']))
		{
			$survey_creator->attributes=$_POST['SurveyCreator'];
                        $survey_creator->password_repeat = $_POST['SurveyCreator']['password_repeat'];
			// validate user input and redirect to the previous page if valid
			if($survey_creator->validate() && $survey_creator->save()){
                                // log the user in
                                $identity = new UserIdentity($_POST['SurveyCreator']['email'], $_POST['SurveyCreator']['password']);
                                $identity->authenticate();
                                yii::app()->user->login($identity);
				$this->redirect(Yii::app()->request->baseUrl . '/survey');
			}
		}
                $this->render('index',array(
                    'loginForm'=>new LoginForm(), 
                    'surveyCreator'=>$survey_creator
                ));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Show form to update the current users information
	 */
	public function actionSettings(){
		$survey_creator = SurveyCreator::model()->findByAttributes(array('email'=> Yii::app()->user->id));
		if(isset($_POST['SurveyCreator'])){
			if($survey_creator->password!=sha1($_POST['SurveyCreator']['password'])){
				$survey_creator->addError('password','Invalid password');
			}
			else{
				$survey_creator->attributes=$_POST['SurveyCreator'];
				if($survey_creator->save()){
					$this->redirect(Yii::app()->homeUrl);
				}
			}
		}
		$survey_creator->setScenario('update');
		$survey_creator->password='';
		$this->render('settings',array('model'=>$survey_creator));
	}
 	
	/**
	 * Show current user's survey report
	 */
	public function actionReports(){
	    $survey_creator = SurveyCreator::model()->findByAttributes(array('email'=> Yii::app()->user->id));
	    $userId = $survey_creator->id;
	    $surveys=Survey::model()->findAllByAttributes(array('survey_creator_ID'=>$userId));

	    $currentSurvey = null;
	    $survey_list_data = array('No Surveys');
	    if(count($surveys)){
	    	$currentSurvey = $surveys[0];
	    	$survey_list_data = CHtml::listData($surveys, 'id', 'title');
	    }
	    if(isset($_POST['Survey']['id'])){
	    	$currentSurvey = Survey::model()->findByPk($_POST['Survey']['id']);
	    }

            $this->render('reports',array(
                    'currentSurvey'=>$currentSurvey,
                    'survey_list_data'=>$survey_list_data,
                    'surveys'=>$surveys
            ));
	} 
        
	
	/**
	 * Show current user's survey report
	 */
	public function actionReportsbar(){
	    $survey_creator = SurveyCreator::model()->findByAttributes(array('email'=> Yii::app()->user->id));
	    $userId = $survey_creator->id;
	    $surveys=Survey::model()->findAllByAttributes(array('survey_creator_ID'=>$userId));

	    $currentSurvey = null;
	    $survey_list_data = array('No Surveys');
	    if(count($surveys)){
	    	$currentSurvey = $surveys[0];
	    	$survey_list_data = CHtml::listData($surveys, 'id', 'title');
	    }
	    if(isset($_POST['Survey']['id'])){
	    	$currentSurvey = Survey::model()->findByPk($_POST['Survey']['id']);
	    }

            $this->render('reports_bar',array(
                    'currentSurvey'=>$currentSurvey,
                    'survey_list_data'=>$survey_list_data,
                    'surveys'=>$surveys
            ));            
	}   

}