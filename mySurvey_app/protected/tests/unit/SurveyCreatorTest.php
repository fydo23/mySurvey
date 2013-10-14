<?php
class SurveyCreatorTest extends CDbTestCase{
	public function testInsert(){
		$surveyCreator=new SurveyCreator('register');
		$surveyCreator->setAttributes(array(
			'email'=>'testCase@example.com',
			'password'=>'testpswd',
			'password_repeat'=>'testpswd',
			'first_name'=>'testFirst',
			'last_name'=>'testLast',
			'level'=>0,
		));
		$this->assertTrue($surveyCreator->save());
		$this->assertNotNull($surveyCreator::model()->findByAttributes(array('email'=>$surveyCreator->email,'password'=>$surveyCreator->password)));
	}
	public function testDelete(){
		$surveyCreator=new SurveyCreator();
		$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
	}
}
?>