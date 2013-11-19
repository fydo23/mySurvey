<?php

/**
 * This is the model class for table "survey_question".
 *
 * The followings are the available columns in table 'survey_question':
 * @property integer $id
 * @property integer $survey_ID
 * @property integer $order_number
 * @property integer $type
 * @property string $text
 *
 * The followings are the available model relations:
 * @property SurveyAnswer[] $surveyAnswers
 * @property Survey $survey
 * @property SurveyResponse[] $surveyResponses
 */
class SurveyQuestion extends CActiveRecord
{

	//these are used by type_choices();
	public static $SHORT_ANSWER_TYPE 	= 0;
	public static $TRUE_FALSE_TYPE 		= 1;
	public static $MULTIPLE_COICE_TYPE 	= 2;
	public static $MULTIPLE_SELECT_TYPE	= 3;

    //custome fields and defaults
    public $delete = False;
    public $disabled = False;
    public $type = 2; //default = Multiple Choice.

    //private fields
    private $hash_num = 0; //used by get_unique_id()
    private $class = ""; //used by get_class();
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_question';
	}



    public function get_class(){
    	$this->class = "";
        if($this->scenario == 'template'){
            $this->class .= "template";
    	}
    	return $this->class;
    }

	public function get_add_answer_button_class(){
		$is_short_answer = $this->type == 0;
		$is_true_false_with_two_answers = $this->type == 1 && count($this->answers) > 1;
		if($is_short_answer || $is_true_false_with_two_answers) return "hide";
    	return "";
	}

	/**
	 * This function translates the type choice into it's string equivalent.
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	public function translate_choice($type){
		$choices = $this->type_choices();
		return $choices[$type];
	}

	public function type_choices(){
		$types = array(
			SurveyQuestion::$SHORT_ANSWER_TYPE		=> 'Short Answer',
			SurveyQuestion::$TRUE_FALSE_TYPE	 	=> 'True/False',
			SurveyQuestion::$MULTIPLE_COICE_TYPE 	=> 'Multiple Choice',
			SurveyQuestion::$MULTIPLE_SELECT_TYPE	=> 'Multiple Select'
		);
		return $types;
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

    /**
     * This function generates and returns a unique number for this model.
     * @return int hash_num
     */
    public function get_hash_num(){
    	if($this->hash_num == 0){
    		$this->hash_num = rand();
    	}
    	return $this->hash_num;
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
