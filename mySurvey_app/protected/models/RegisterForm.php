<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * user register form data. It is used by the 'register' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $firstname;
	public $lastname;
	public $email;
	public $password;
	public $password2;
	public $username;
	

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username email password and password2 are required,
	 * password length needs to be >= 8 but <= 45
	 * password and password2 need to be the same
	 * and email needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// list fields that are required
			array('username, email, password, password2', 'required'),
			// ensuring email field is a valid email address
			array('email','email'),
			// password length must exceed 8 characters
			array('password','length','min' => 8,'max'=> 45),
			// two passwords must match
			array('password2', 'compare', 'compareAttribute'=>'password'),
			// password needs to be authenticated
			array('email', 'authenticate'),
			// default values for firstname and lastname
			array('firstname, lastname', 'default','value'=>null),
		);
	}
	// labels for attributes
	public function attributeLabels(){
		return array(
			'username'=>'User name',
			'email'=>'Email',
			'password2'=>'Retype password',
			'firstname'=>'First name',
			'lastname'=>'Last name'
		);
	}
	/**
	 * Authenticates the email for duplicates.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->email,'');
			if(!$this->_identity->authenticateRegister())
				$this->addError('email','This email account is already registered.');
		}
	}

	/**
	 * inserts the new user data into the database
	 * @return boolean whether insert is successful
	 */
	public function register()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,'');
			$this->_identity->authenticateRegister();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			//sql insert code, password is hashed with sha1 algo
			$insertModel=new SurveyCreator;
			$insertModel->email=$this->email;
			$insertModel->username=$this->username;
			$insertModel->password=hash('sha1',$this->password);
			$insertModel->last_name=$this->lastname;
			$insertModel->first_name=$this->firstname;
			if($insertModel->save()){
				return true;
			}
			else{
				$this->addError('email','Error with the database');
				return false;
			}
		}
		else
			return false;
	}
}
