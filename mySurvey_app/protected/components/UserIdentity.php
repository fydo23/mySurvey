<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $email;
	private $_id;
	const ERROR_EMAIL_DUPLICATE=3;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function __construct($email,$password){
		$this->email=$email;
		parent::__construct('', $password); 
	}
	public function authenticate()
	{
		/*
		 * find user with the same email and password
		 * password is hashed using mysql password() function
		*/
		$user = SurveyCreator::model()->findByAttributes(
        	array('email'=>$this->email),
            'password=password(:pswd)',
            array(':pswd'=>$this->password)
        );
		if(!$user)
			$this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
		else{
			$this->username=$user->username;
			$this->_id=$user->id;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function authenticateRegister()
	{
		/*
		 * find user with the same email and password
		 * password is hashed using mysql password() function
		*/
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
	//over writes default getId to return _id instead of username
	public function getId(){
		return $this->_id;
	}
}