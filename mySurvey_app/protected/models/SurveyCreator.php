<?php

/**
 * This is the model class for table "survey_creator".
 *
 * The followings are the available columns in table 'survey_creator':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 */
class SurveyCreator extends Model
{
        //used for registration.
        public $password_repeat;
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_creator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('username, email', 'unique'),
			array('username, email, password', 'required'),
			array('username, email, password, first_name, last_name', 'length', 'max'=>45),
                        //registration scenario validation 
                        array('password_repeat', 'compare', 'compareAttribute'=>'password', 'on'=>'register', 'message'=>'Password must be repeated exactly.'),
                        array('password_repeat', 'required', 'on'=>'register'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email, password, first_name, last_name', 'safe', 'on'=>'search'),
		);
	}
        
        public function beforeSave() {
            parent::beforeSave();
            switch($this->scenario){
                case 'register':
                    $this->password = sha1($this->password);
                    break;
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'password_repeat' => 'Repeat Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveyCreator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
