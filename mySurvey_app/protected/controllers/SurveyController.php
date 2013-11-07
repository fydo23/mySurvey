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
			array('deny', 
                'users'=>array('?'),
			),
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
		$model=new Survey;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                $survey_creator = SurveyCreator::model()->findByAttributes(
                        array('email'=> Yii::app()->user->id)
                );
                    
                //we need to remove url from the survey model
                $model->url = '/survey/take/id' ;
                $model->survey_creator_ID = $survey_creator->id;
                $model->is_published = 0;
                $model->created = new CDbExpression('NOW()');
		if(isset($_POST['Survey']))
		{
			$model->attributes=$_POST['Survey'];
			if($model->save())
				$this->redirect(array(
                                    'update',
                                    'id'=>$model->id
                                ));
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
	                	if(count($question->answers)>1 && $question->type == 0){
	                		//if short answer, delete all but the first question
	                		for($idx = 1; $idx<count($question->answers); $idx++){ 
	                			$question->answers[$idx]->delete();
	                		}
	                		//refresh the model to have the proper number of relations.
	                		$question->refresh(); 
	                	}
	                }
            	}
            }
            ksort($questions);
            return $questions;
        }

        private function create_save_or_delete($model_name, $attributes){
				$model = new $model_name('create');
                //if $attributes id is set, try to set model 
                if($attributes['id'] && !$model = $model_name::model()->findByPk($attributes['id'])){
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
