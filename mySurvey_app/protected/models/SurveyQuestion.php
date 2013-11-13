<?php

/**
 * This is the model class for table "survey_question".
 *
 * The followings are the available columns in table 'survey_question':
 * 
 *  integer $id
 * 
 *  integer $survey_ID
 * 
 *  integer $order_number
 * 
 *  integer $type
 * 
 *  string $text
 *
 * The followings are the available model relations:
 * 
 *  SurveyAnswer[] $surveyAnswers
 * 
 *  Survey $survey
 * 
 *  SurveyResponse[] $surveyResponses
 */
class SurveyQuestion extends Model
{
    //custome fields and defaults
    public $delete = False;
    public $class = "";
    public $add_answer_button_class= "";
    public $disabled = False;
    public $type_choices = array('Short Answer', 'True/False', 'Multiple Choice', 'Multiple Select');
    public $type = 2; //default = Multiple Choice.
    public $answersUniqueId = 0;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_question';
	}
    
    /**
     * Event that is fired after the model is initialized.
     * 
     * @return parent::afterConstruct();
     */
    public function afterConstruct() 
    {
        $this->answersUniqueId = rand();
        if($this->scenario == 'template'){
            $this->class = "template";
            $this->disabled = True;
            $this->order_number = 0;
        }
        return parent::afterConstruct();
    }

    /**
     * Called after the model is fetched frmo the DB.
     * @return parent::afterFind();
     */
    public function afterFind(){
        $this->answersUniqueId = rand();
        if($this->type<2){
        	$this->add_answer_button_class = "hide";
        } 
        return parent::afterFind();
    }
    
    
    /**
     * 
     * @param String $attribute | name of the attribute for the string
     * @return String html name attribute for supplied name
     */
    public function getNameForAttribute($attribute){
        return 'SurveyQuestion['.$this->order_number.']['.$attribute.']';
    }


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('survey_ID, order_number, type, text', 'required'),
			array('survey_ID, order_number, type', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, survey_ID, order_number, type, text', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'SurveyAnswer', 'survey_question_ID', 'order'=>'order_number ASC'),
			'survey' => array(self::BELONGS_TO, 'Survey', 'survey_ID'),
			'responses' => array(self::HAS_MANY, 'SurveyResponse', 'survey_question_ID'),
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
			'order_number' => 'Order Number',
			'type' => 'Question Type',
			'text' => 'Question',
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
		$criteria->compare('order_number',$this->order_number);
		$criteria->compare('type',$this->type);
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
