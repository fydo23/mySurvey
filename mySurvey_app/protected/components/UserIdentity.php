<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	// custom field to store user email and id
	public $email;
	private $_id;
	// custom error no.
	const ERROR_EMAIL_DUPLICATE=3;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both found in the database on login,
	 * or checks if the email already exists on the database on register.
	 * @return boolean whether authentication succeeds.
	 */
	
	// overloaded constructor for storing email address and hasing the password with sha1 algo
	public function __construct($email,$password){
		$this->email=$email;
		parent::__construct('', hash('sha1',$password)); 
	}
	public function authenticate()
	{
		//find user with the same email and password
		$user = SurveyCreator::model()->findByAttributes(array(
                    'email'=>$this->email,
                ));
		if(!$user)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($user->password !== $this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->username=$user->username;
			$this->_id=$user->id;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function authenticateRegister()
	{
		//check if the email is already registered
		$user = SurveyCreator::model()->findByAttributes(
        	array('email'=>$this->email)
        );
		if($user)
			$this->errorCode=$this::ERROR_EMAIL_DUPLICATE;
		else{
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	//over writes default getId used by WebUser class to return _id instead of username
	public function getId(){
		return $this->_id;
	}
}