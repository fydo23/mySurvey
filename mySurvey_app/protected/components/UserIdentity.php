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
	public function getId(){
		return $this->_id;
	}
}