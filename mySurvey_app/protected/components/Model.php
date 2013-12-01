<?php
/**
 * Model is the customized base model class.
 * All model classes for this application should extend from this base class.
 */
class Model extends CActiveRecord
{
    
	
	/**
	 * generates a unique id for every survey taken
	 */
	public static function generate_unique_token($length = 6, $column='hash'){
		$valid_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$result = "";
		for($result_length = 0; $result_length < $length; $result_length++){
			$result .= substr($valid_chars, rand(0, strlen($valid_chars)-1), 1);
		}
		//static:: will call the inheriting class'static model() function.
		if(count(static::model()->findByAttributes(array($column=>$result)))){
			//recursivly call ensures that at some point we get a unique id that is never found..
			$result = generate_unique_responder_id($length, $column);
		}
		return $result;
	}
}
