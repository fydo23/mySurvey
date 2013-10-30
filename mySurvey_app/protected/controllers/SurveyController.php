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

		$this->performAjaxValidation($model, True);

                $survey_creator = SurveyCreator::model()->findByAttributes(
                        array('email'=> Yii::app()->user->id)
                );
                
                $questions_dataProvider=new CActiveDataProvider('SurveyQuestion');
                $questions_criteria = new CDbCriteria(array(
                    'condition'=>'survey_ID = ' . $model->id,
                    'order'=>'order_number'
                ));
                $questions_dataProvider->setCriteria($questions_criteria);
                
                  

		$this->render('update',array(
			'model'=>$model,
                        'questions_dataProvider'=>$questions_dataProvider,
		));
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
        
        public function actionReorderQuestions($survey_id){
            $questions = SurveyQuestion::model()->findAllByAttributes(array('survey_ID'=>$survey_id));
            if($questions){
                foreach($questions as $idx => $question){
                    $question->setAttribute('order_number', $_POST['SurveyQuestion'][$question->id]['order_number']);
                    $question->save();
                }
            }
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

	/**
	 * Performs the AJAX validation.
	 * @param Survey $model the model to be validated
	 */
	protected function performAjaxValidation($model, $save=False)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='survey-form')
		{
			echo CActiveForm::validate($model);
                        if($save && !$model->hasErrors()){
                            $model->save();
                        }
                        Yii::app()->end();
		}
	}
}
