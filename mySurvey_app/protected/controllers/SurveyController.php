<?php

class SurveyController extends Controller
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
				'actions'=>array('take'),
				'users'=>array('*')
			),
			array('deny', 
                'users'=>array('?'),
			)
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Survey('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Survey']))
		{
			$model->attributes=$_POST['Survey'];
			if($model->save())
				$this->redirect(array(
                    'update',
                    'id'=>$model->id
                ));
			else{
				print_r($model->getErrors());
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $questions = array();
        
        
        if(isset($_POST['SurveyQuestion'])){
            $questions = $this->process_post_questions($id);
        }
        //ajaxValidation halts execution before survey gets a change to validate.
        $this->performAjaxValidation(array_merge($questions,array($model)));
        
        if(!count($questions)){
            $questions_criteria = new CDbCriteria(array(
                'condition'=>'survey_ID = ' . $model->id,
                'order'=>'order_number'
            ));
            $questions = SurveyQuestion::model()->findAll($questions_criteria);
        } 
        if(isset($_POST['Survey'])){
            $model->attributes=$_POST['Survey'];
            if($model->validate()){
                $model->save();
            }
        }
        $this->render('update',array(
            'model'=>$model,
            'questions'=>$questions,
        ));
	}
        
        /**
         * This function processes the SurveyQuestions in $_POST by validating and attempting to save
         * them.
         * 
         * @return array $questions | an array containing all the questions in the current post request.
         */
        private function process_post_questions($survey_id){
        	$questions = array();
            foreach($_POST['SurveyQuestion'] as $q_idx => $attributes){
        		$attributes['survey_ID'] = $survey_id;
        		$attributes['order_number'] = $q_idx;
            	if($question = $this->create_save_or_delete('SurveyQuestion', $attributes)){
                	$questions[$q_idx] = $question;
	                if(isset($attributes['SurveyAnswer'])){
	                	foreach($attributes['SurveyAnswer'] as $a_idx => $answer_attributes){
	                		$answer_attributes['survey_question_ID'] = $question->id;
	                		$answer_attributes['order_number'] = $a_idx;
	                		$this->create_save_or_delete('SurveyAnswer', $answer_attributes);
	                	}
	                	$question->refresh(); 
	                }
            	}
            }
        	ksort($questions);
            return $questions;
        }

        private function create_save_or_delete($model_name, $attributes){
				$model = new $model_name('create');
                //if $attributes id is set, try to set model 
                if($attributes['id'] && !($model = $model_name::model()->findByPk($attributes['id'])) ){
                	//provided an id that doesn't exist. skip this question
                	return false;
                }
                if($attributes['delete']){
                	if($model->id){
                		//requesting to delete an existing model.
                    	$model->delete();
                	}
                	return false;
                }
                $model->attributes = $attributes;
                if($model->validate()){
                    $model->save();
                }
            	return $model;
        }
        
	/**
	 * Publish a survey model.
	 * If publish is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionPublish($id)
	{
		$model=$this->loadModel($id);
        $model->is_published = 1;
        $model->save();

        $this->redirect(array('index'));
	}       
 
	/**
	 * Unpublish a survey model.
	 * If publish is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUnpublish($id)
	{
		$model=$this->loadModel($id);

                $model->is_published = 0;
                $model->save();

                $this->redirect(array('index'));
	}            
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
                $this->redirect(array('index'));
	}
	/**
	 * Shows the take survey page identified by the hash value
	 * @param string $hash
	 */
	public function actionTake($hash){
		//get the cookie value
		$model=Survey::model()->findByAttributes(array('url'=>$hash));
		$cookieValue = Yii::app()->request->cookies->contains($model->id.'_taken') ? Yii::app()->request->cookies[$model->id.'_taken']->value : '';
		if(isset($_POST['SurveyResponse']) && $cookieValue != true){
		
			//set a cookie indicating that survey has been taken
			$cookie = new CHttpCookie($model->id.'_taken', true);
			$years = 3;  //number of years for the cookie to expire
			$cookie->expire = time()+60*60*24*365*$years; 
			Yii::app()->request->cookies[$model->id.'_taken'] = $cookie;
			
			//generate unique id for this submission
			$takerId = $this->generate_unique_responder_id();
			foreach ($_POST['SurveyResponse'] as $i=>$response){
				$surveyResponse=new SurveyResponse;
				$surveyResponse->survey_response_responder=$takerId;
				if($response['survey_question_type']==0){
					$surveyResponse->survey_answer_ID=$response['survey_answer_id'];
					$surveyResponse->survey_response_text=$response['survey_response_text'];
					$surveyResponse->save();
				}
				else if($response['survey_question_type']==1||$response['survey_question_type']==2){
					$surveyResponse->survey_answer_ID=$response['survey_response_text'];
					$surveyResponse->save();
				}
				else if($response['survey_question_type']==3){
					foreach($response['survey_response_text'] as $choice){
						$surveyResponse->survey_answer_ID=$choice;
						$surveyResponse->save();
						$surveyResponse=new SurveyResponse;	
						$surveyResponse->survey_response_responder=$takerId;
					}
				}
			}
			$this->redirect('/successfulSubmit');
		}
		
		
		$notCreator = true;  
		//if the user is not a guest and the creator of this survey
		if(!Yii::app()->user->isGuest && ($model->survey_creator_ID == SurveyCreator::model()->findByAttributes(array('email'=> Yii::app()->user->getId()))->id))
			$notCreator = false;
		//redirect if the survey is deleted or unpubished, provided user is not the creator
		if($model == null || ($model->is_published == 0 && $notCreator)){
			$message = "This Survey has been temporarily removed";
			if($model == null)
				$message = "This survey has been removed";
			$this->render('noSurvey',array('message'=>$message));
			return;
		}
		
		
		if($cookieValue == true && $notCreator){
			$this->redirect('/thankyou');
		}
		
		$questions_criteria = new CDbCriteria(array(
                        'condition'=>'survey_ID = ' . $model->id,
                        'order'=>'order_number'
                         ));
        $questions = SurveyQuestion::model()->findAll($questions_criteria);
		$this->render('take',array(
                    'model'=>$model,
                    'questions'=>$questions,
                    'notCreator'=>$notCreator,
                ));
	}
	
		/**
		 * generates a unique id for every survey taken
		 */
		private function generate_unique_responder_id($length = 6){
			$valid_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$result = "";
			for($result_length = 0; $result_length < $length; $result_length++){
				$result .= substr($valid_chars, rand(0, strlen($valid_chars)-1), 1);
			}
			if($conflict_responses = SurveyResponse::model()->findByAttributes(array('survey_response_responder'=>$result))){
				//recursivly call ensures that at some point we get a unique id that is never found..
				$result = generate_unique_responder_id($length);
			}
			return $result;
		}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $survey_creator = SurveyCreator::model()->findByAttributes(
                        array('email'=> Yii::app()->user->id)
                );

                $published_dataProvider=new CActiveDataProvider('Survey');
                $published_dataProvider->setCriteria(new CDbCriteria(array('condition'=>'is_published = 1 AND survey_creator_ID = '.($survey_creator->id))));

                $unPublished_dataProvider=new CActiveDataProvider('Survey');
                $unPublished_dataProvider->setCriteria(new CDbCriteria(array('condition'=>'is_published = 0 AND survey_creator_ID = '.($survey_creator->id))));
                
		$this->render('index',array(
			'published_dataProvider'=>$published_dataProvider,
			'unPublished_dataProvider'=>$unPublished_dataProvider,
		));
                
	}
        

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Survey the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Survey::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
