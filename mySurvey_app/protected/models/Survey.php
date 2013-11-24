<?php

/**
 * This is the model class for table "survey".
 *
 * The followings are the available columns in table 'survey':
 * 
 *  integer $id
 * 
 *  string $url
 * 
 *  string $created
 * 
 *  integer $survey_creator_ID
 * 
 *  integer $is_published
 * 
 *  string $title
 *
 * The followings are the available model relations:
 * 
 *  SurveyCreator $surveyCreator
 * 
 *  SurveyAnswer[] $surveyAnswers
 * 
 *  SurveyQuestion[] $surveyQuestions
 * 
 *  SurveyResponse[] $surveyResponses
 */
class Survey extends Model
{

	//constant defaults
	public $is_published = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, created, survey_creator_ID, title', 'required'),
			array('survey_creator_ID, is_published', 'numerical', 'integerOnly'=>true),
			array('url', 'length', 'max'=>80),
			array('title', 'length', 'min'=>6, 'tooShort'=>'Title is too short.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, url, created, survey_creator_ID, is_published, title', 'safe', 'on'=>'search'),
		);
	}

        /**
	 * Generates a unique random string for the survey url.
	 * @param the length of the random string
	 * @return unique random string
	*/   
	public function generate_unique_url($length = 6){
		$valid_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$result = "";
		for($result_length = 0; $result_length < $length; $result_length++){
			$result .= substr($valid_chars, rand(0, strlen($valid_chars)-1), 1);
		}
		if($conflict_survey = Survey::model()->findByAttributes(array('url'=>$result))){
			//recursivly call ensures that at some point we get a unique id that is never found..
			$result = generate_unique_url($length);
		}
		return $result;
	}

	/** 
	 * Before we validate/save this model, make sure to set the defalts.
	 * @return boolean if validation can proceed.
	 */
	public function beforeValidate(){
		if($this->scenario == "create"){
		    $survey_creator = SurveyCreator::model()->findByAttributes(
		            array('email'=> Yii::app()->user->id)
		    );
		    //we need to remove url from the survey model
		    $this->survey_creator_ID = $survey_creator->id;
		    $this->created = new CDbExpression('NOW()');
			$this->url = $this->generate_unique_url();
		}
		return true;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'surveyAnswers' => array(self::HAS_MANY, 'SurveyAnswer', 'survey_ID'),
			'surveyQuestions' => array(self::HAS_MANY, 'SurveyQuestion', 'survey_ID'),
			'surveyResponses' => array(self::HAS_MANY, 'SurveyResponse', 'survey_ID'),
			'surveyCreator' => array(self::BELONGS_TO, 'SurveyCreator', 'survey_creator_ID', 'alias'=>'survey_creator'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'created' => 'Created',
			'survey_creator_ID' => 'Survey Creator',
			'is_published' => 'Is Published',
			'title' => 'Title',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('survey_creator_ID',$this->survey_creator_ID);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Survey the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
