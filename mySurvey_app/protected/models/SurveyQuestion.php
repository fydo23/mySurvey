<?php

/**
 * This is the model class for table "survey_question".
 *
 * The followings are the available columns in table 'survey_question':
 * @property integer $id
 * @property integer $survey_ID
 * @property integer $survey_question_number
 * @property integer $survey_question_type
 * @property string $survey_question_answer_required
 * @property string $survey_question_default_next_link
 * @property string $text 
 *
 * The followings are the available model relations:
 * @property SurveyAnswer[] $surveyAnswers
 * @property Survey $survey
 * @property SurveyResponse[] $surveyResponses
 */
class SurveyQuestion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('survey_ID, survey_question_number, survey_question_type', 'required'),
			array('survey_ID, survey_question_number, survey_question_type', 'numerical', 'integerOnly'=>true),
			array('survey_question_answer_required', 'length', 'max'=>1),
			array('survey_question_default_next_link', 'length', 'max'=>80),
                        array('text', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, survey_ID, survey_question_number, survey_question_type, survey_question_answer_required, survey_question_default_next_link, text', 'safe', 'on'=>'search'),
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
			'surveyAnswers' => array(self::HAS_MANY, 'SurveyAnswer', 'survey_question_ID'),
			'survey' => array(self::BELONGS_TO, 'Survey', 'survey_ID'),
			'surveyResponses' => array(self::HAS_MANY, 'SurveyResponse', 'survey_question_ID'),
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
			'survey_question_number' => 'Survey Question Number',
			'survey_question_type' => 'Survey Question Type',
			'survey_question_answer_required' => 'Survey Question Answer Required',
			'survey_question_default_next_link' => 'Survey Question Default Next Link',
                        'text' => 'Text',
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
		$criteria->compare('survey_question_number',$this->survey_question_number);
		$criteria->compare('survey_question_type',$this->survey_question_type);
		$criteria->compare('survey_question_answer_required',$this->survey_question_answer_required,true);
		$criteria->compare('survey_question_default_next_link',$this->survey_question_default_next_link,true);
                $criteria->compare('text',$this->text,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveyQuestion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
