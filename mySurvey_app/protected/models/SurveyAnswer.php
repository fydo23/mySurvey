<?php

/**
 * This is the model class for table "survey_answer".
 *
 * The followings are the available columns in table 'survey_answer':
 * @property integer $id
 * @property integer $survey_question_ID
 * @property string $survey_answer_response_time
 * @property string $survey_answer_next_link
 * @property string $text
 * @property integer $order_number
 *
 * The followings are the available model relations:
 * @property SurveyQuestion $surveyQuestion
 * @property SurveyResponse[] $surveyResponses
 */
class SurveyAnswer extends CActiveRecord
{
    //custome fields and defaults
    public $class = "";
    public $delete_button_class = "";
    public $disabled = False;
    public $delete = False;
    public $survey_question_order = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_answer';
	}
        
    /**
     * Event that is fired after the model is initialized.
     * 
     * @return parent::afterConstruct();
     */
    public function afterConstruct() 
    {
        if($this->scenario == 'template'){
            $this->class = "template";
            $this->disabled = True;
            $this->order_number = 0;
        }
        return parent::afterConstruct();
    }

    public function afterSave()
    {
    	$this->afterFind();
        return parent::afterSave();
    }
        
    public function afterFind()
    {	
    	$this->survey_question_order = $this->question->order_number;
        if(in_array($this->question->type, array(0,1)))
        	$this->delete_button_class = "hide";
        return parent::afterFind();
    }
    
    /**
     * 
     * @param String $attribute | name of the attribute for the string
     * @return String html name attribute for supplied name
     */
    public function getNameForAttribute($attribute){
        return 'SurveyQuestion['.$this->survey_question_order.'][SurveyAnswer]['.$this->order_number.']['.$attribute.']';
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('survey_question_ID, order_number, text', 'required'),
			array('survey_question_ID, order_number', 'numerical', 'integerOnly'=>true),
			array('survey_answer_next_link', 'length', 'max'=>80),
			array('text', 'length', 'max'=>1000),
			array('survey_answer_response_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, survey_question_ID, survey_answer_response_time, survey_answer_next_link, text, order_number', 'safe', 'on'=>'search'),
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
			'responses' => array(self::HAS_MANY, 'SurveyResponse', 'survey_answer_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'survey_question_ID' => 'Survey Question',
			'survey_answer_response_time' => 'Survey Answer Response Time',
			'survey_answer_next_link' => 'Survey Answer Next Link',
			'text' => 'Text',
			'order_number' => 'Order Number',
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
		$criteria->compare('survey_question_ID',$this->survey_question_ID);
		$criteria->compare('survey_answer_response_time',$this->survey_answer_response_time,true);
		$criteria->compare('survey_answer_next_link',$this->survey_answer_next_link,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('order_number',$this->order_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveyAnswer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
