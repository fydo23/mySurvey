<?php
class SurveyCreatorTest extends CDbTestCase{
	public function testInsert(){
		//creates a new user for register
		$surveyCreator=new SurveyCreator('register');
		//set the attributes with dummy data
		$surveyCreator->setAttributes(array(
			'email'=>'testCase@example.com',
			'password'=>'testpswd',
			'password_repeat'=>'testpswd',
			'first_name'=>'testFirst',
			'last_name'=>'testLast',
			'level'=>0,
		));
		//asserts the insert is success, and can be retrieved
		$this->assertTrue($surveyCreator->save());
		$this->assertNotNull($surveyCreator::model()->findByAttributes(array('email'=>$surveyCreator->email,'password'=>$surveyCreator->password)));
	}
	public function testUpdate(){
		//load the user data from db
		$surveyCreator=new SurveyCreator();
		$surveyCreator=$surveyCreator::model()->findByAttributes(array('email'=>'testCase@example.com','password'=>sha1('testpswd')));
		//change the email
		$surveyCreator->email='testCase2@example.com';
		//assert the update is success and can be retrieved
		$this->assertTrue($surveyCreator->save());
		$this->assertNotNull($surveyCreator::model()->findByAttributes(array('email'=>$surveyCreator->email,'password'=>sha1('testpswd'))));
	}
	public function testDelete(){
		//assert the deletion is successful
		$surveyCreator=new SurveyCreator();
		$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase2@example.com')),1);
	}
}
?>