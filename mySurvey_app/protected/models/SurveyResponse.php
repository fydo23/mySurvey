<?php

/**
 * This is the model class for table "survey_response".
 *
 * The followings are the available columns in table 'survey_response':
 * @property integer $id
 * @property integer $survey_answer_ID
 * @property string $choice_letter
 * @property string $survey_response_time
 * @property string $survey_response_responder
 * @property string $survey_response_text
 *
 * The followings are the available model relations:
 * @property Survey $survey
 * @property SurveyQuestion $surveyQuestion
 * @property SurveyAnswer $surveyAnswer
 */
class SurveyResponse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_response';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('survey_answer_ID', 'required', 'on'=>'save'),
			array('survey_response_text', 'required', 'on'=>'template','message'=>'All reponses are required.'),
			array('survey_answer_ID', 'numerical', 'integerOnly'=>true),
			array('choice_letter', 'length', 'max'=>5),
			array('survey_response_responder', 'length', 'max'=>45),
			array('survey_response_time, survey_response_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, survey_ID, survey_question_ID, survey_answer_ID, choice_letter, survey_response_time, survey_response_responder, survey_response_text', 'safe', 'on'=>'search'),
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
			'survey' => array(self::BELONGS_TO, 'Survey', 'survey_ID'),
			'question' => array(self::BELONGS_TO, 'SurveyQuestion', 'survey_question_ID'),
			'answer' => array(self::BELONGS_TO, 'SurveyAnswer', 'survey_answer_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'survey_ID' => 'Survey',
			'survey_question_ID' => 'Survey Question',
			'survey_answer_ID' => 'Survey Answer',
			'choice_letter' => 'Survey Answer Choice Letter',
			'survey_response_time' => 'Survey Response Time',
			'survey_response_responder' => 'Survey Response Responder',
			'survey_response_text' => 'Your Response:',
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
		$criteria->compare('survey_ID',$this->survey_ID);
		$criteria->compare('survey_question_ID',$this->survey_question_ID);
		$criteria->compare('survey_answer_ID',$this->survey_answer_ID);
		$criteria->compare('choice_letter',$this->choice_letter,true);
		$criteria->compare('survey_response_time',$this->survey_response_time,true);
		$criteria->compare('survey_response_responder',$this->survey_response_responder,true);
		$criteria->compare('survey_response_text',$this->survey_response_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveyResponse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
