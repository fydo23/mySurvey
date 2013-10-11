<?php

/**
 * This is the model class for table "survey".
 *
 * The followings are the available columns in table 'survey':
 * @property integer $id
 * @property string $survey_URL
 * @property string $survey_date_time_created
 * @property integer $survey_creator_ID
 * @property string $survey_publish_status
 * @property string $survey_publish_date_time
 *
 * The followings are the available model relations:
 * @property SurveyCreator $surveyCreator
 * @property SurveyAnswer[] $surveyAnswers
 * @property SurveyQuestion[] $surveyQuestions
 * @property SurveyResponse[] $surveyResponses
 */
class Survey extends Model
{
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
			array('survey_URL, survey_date_time_created, survey_creator_ID', 'required'),
			array('survey_creator_ID', 'numerical', 'integerOnly'=>true),
			array('survey_URL', 'length', 'max'=>80),
			array('survey_publish_status', 'length', 'max'=>1),
			array('survey_publish_date_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, survey_URL, survey_date_time_created, survey_creator_ID, survey_publish_status, survey_publish_date_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'surveyCreator' => array(self::BELONGS_TO, 'SurveyCreator', 'survey_creator_ID'),
			'surveyAnswers' => array(self::HAS_MANY, 'SurveyAnswer', 'survey_ID'),
			'surveyQuestions' => array(self::HAS_MANY, 'SurveyQuestion', 'survey_ID'),
			'surveyResponses' => array(self::HAS_MANY, 'SurveyResponse', 'survey_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'survey_URL' => 'Survey Url',
			'survey_date_time_created' => 'Survey Date Time Created',
			'survey_creator_ID' => 'Survey Creator',
			'survey_publish_status' => 'Survey Publish Status',
			'survey_publish_date_time' => 'Survey Publish Date Time',
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
		$criteria->compare('survey_URL',$this->survey_URL,true);
		$criteria->compare('survey_date_time_created',$this->survey_date_time_created,true);
		$criteria->compare('survey_creator_ID',$this->survey_creator_ID);
		$criteria->compare('survey_publish_status',$this->survey_publish_status,true);
		$criteria->compare('survey_publish_date_time',$this->survey_publish_date_time,true);

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
