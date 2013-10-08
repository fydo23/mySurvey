<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
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
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// all fields are required
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
	 * Authenticates the password.
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
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
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
			//sql insert code
			$sqlStmt="insert into survey_creator(username, email, password, first_name, last_name) values(:username,:email,password(:password),:firstname, :lastname)";
			$connection = Yii::app()->db;
			$command=$connection->createCommand($sqlStmt);
			$command->bindValue(':username',$this->username);
			$command->bindValue(':email',$this->email);
			$command->bindValue(':password',$this->password);
			$command->bindValue(':firstname',$this->firstname);
			$command->bindValue(':lastname',$this->lastname); 
			if($command->execute())
				return true;
			else{
				$this->addError('email','Error with the database');
				return false;
			}
		}
		else
			return false;
	}
}
