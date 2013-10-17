<?php
class SurveyTest extends CDbTestCase{
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

		$survey = new Survey;
		$survey->setAttributes(array(
				'url'=>'this/isa/test',
				'created'=>new CDbExpression('NOW()'),  //(new DateTime('NOW'))->format('c') causes wrong insert time
				'survey_creator_ID'=>$surveyCreator->id,
				'is_published'=>0,
				'title'=>'test survey'
		));
		$this->assertTrue($survey->save());
		$this->assertNotNull($survey::model()->findByAttributes(array('url'=>'this/isa/test')));
		
		//this should not pass but it does
		$survey1 = new Survey;
		$survey1->setAttributes(array(
				'url'=>'this/isa/test1',
				'created'=>new CDbExpression('NOW()'),
				'survey_creator_ID'=>$surveyCreator->id,
				'is_published'=>0,
				'title'=>'test survey1'
		));
		$this->assertTrue($survey1->save()); 
		
		
		/*this test fails to pass as expected as the survey creator id does not exist
		$survey2 = new Survey;
		$survey2->setAttributes(array(
				'url'=>'this/isa/test2',
				'created'=>new CDbExpression('NOW()'),
				'survey_creator_ID'=>35,
				'is_published'=>0,
				'title'=>'test survey2'
		));
		$this->assertFalse($survey2->save()); 
		*/
		
		//this test fails to pass as expected as url, created or creator id is not initialized
		$survey3 = new Survey;
		$survey3->setAttributes(array(
				'url'=>'this/isa/test3',
				'survey_creator_ID'=>$surveyCreator->id,
				'is_published'=>0,
				'title'=>'test survey3'
		));
		$this->assertFalse($survey3->save()); 
		
		
		//this test fails to pass as expected as url > 80
		$survey4 = new Survey;
		$survey4->setAttributes(array(
				'url'=>'this/isa/test4kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk',
				'survey_creator_ID'=>$surveyCreator->id,
				'is_published'=>0,
				'title'=>'test survey4'
		));
		$this->assertFalse($survey4->save()); 
		
		
	}
	
	public function testUpdate(){
		//load the user data from db
		$survey=new Survey;
		$survey=$survey::model()->findByAttributes(array('url'=>'this/isa/test'));
		//change the email
		$survey->is_published = 1;
		//assert the update is success and can be retrieved
		$this->assertTrue($survey->save());
		$this->assertNotNull($survey::model()->findByAttributes(array('url'=>$survey->url,'is_published' => 1)));
		$this->assertNull($survey::model()->findByAttributes(array('url'=>$survey->url,'is_published' => 0)));
	}
	
	public function testDelete(){
		//assert the deletion is successful
		$survey1=new Survey;
		$this->assertSame($survey1::model()->deleteAllByAttributes(array('url'=>'this/isa/test1')),1);
		$survey=new Survey;
		$survey=$survey::model()->findByAttributes(array('url'=>'this/isa/test'));
		$surveyQuestion = new SurveyQuestion;
			$surveyQuestion->setAttributes(array(
				'survey_ID'=>$survey->id,
				'survey_question_number'=>3,
				'survey_question_type'=>1,
				'survey_question_answer_required'=>'Y',
				'survey_question_default_next_link'=>'test'
			));
		$this->assertTrue($surveyQuestion->save());
		/*this test fails as expected because of fk constraint to survey question table
		$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'this/isa/test')),1);
		*/
		$this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('survey_question_default_next_link'=>'test')),1);
		$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'this/isa/test')),1);
		$surveyCreator=new SurveyCreator();
		$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
	}
}
	