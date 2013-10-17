<?php
class SurveyTest extends CDbTestCase{

	//function to test inserts into Survey table
	public function testInsert(){
     	//creates a new test user
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
		
		//create a new survey with all valid inputs
		$survey = new Survey;
		$survey->setAttributes(array(
				'url'=>'this/isa/test',
				'created'=>new CDbExpression('NOW()'),  //(new DateTime('NOW'))->format('c') causes wrong insert time
				'survey_creator_ID'=>$surveyCreator->id,
				'is_published'=>0,
				'title'=>'test survey'
		));
		$this->assertTrue($survey->save());  //assert that insert is a success
		//assert that the newly created survey can be retrieved
		$this->assertNotNull($survey::model()->findByAttributes(array('url'=>'this/isa/test')));   
		
		//this should not pass but it does (url's should be unique)
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
		
		
		//this test fails to pass as expected as url > 80 or title >100
		$survey4 = new Survey;
		$survey4->setAttributes(array(
				'url'=>'this/isa/test4kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk',
				'survey_creator_ID'=>$surveyCreator->id,
				'is_published'=>0,
				'title'=>'test survey4'
		));
		$this->assertFalse($survey4->save()); 
		
		
	}
	
	//function to test updates to Survey table
	public function testUpdate(){
		//load the survey from db
		$survey=new Survey;
		$survey=$survey::model()->findByAttributes(array('url'=>'this/isa/test'));
		//change the published status
		$survey->is_published = 1;
		//assert the update is successfull
		$this->assertTrue($survey->save());
		$this->assertNotNull($survey::model()->findByAttributes(array('url'=>$survey->url,'is_published' => 1)));
		//ensure that the survey is in published status, and check for un-published returns NULL
		$this->assertNull($survey::model()->findByAttributes(array('url'=>$survey->url,'is_published' => 0)));
	}
	
	//function to test deletes from Survey table
	public function testDelete(){
		//assert the deletion is successful
		$survey1=new Survey;
		$this->assertSame($survey1::model()->deleteAllByAttributes(array('url'=>'this/isa/test1')),1);
		
		//now try to delete the first survey created, after adding a question to it
		$survey=new Survey;
		$survey=$survey::model()->findByAttributes(array('url'=>'this/isa/test'));
		$surveyQuestion = new SurveyQuestion;  //add a question to this survey
			$surveyQuestion->setAttributes(array(
				'survey_ID'=>$survey->id,
				'survey_question_number'=>3,
				'survey_question_type'=>1,
				'survey_question_answer_required'=>'Y',
				'survey_question_default_next_link'=>'test'
			));
		$this->assertTrue($surveyQuestion->save()); 
		
		//ensure that the delete fails because a question is present
		/*this test fails as expected because of fk constraint to survey question table
		$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'this/isa/test')),1);
		*/
		
		//now delete the question, and the survey
		$this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('survey_question_default_next_link'=>'test')),1);
		$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'this/isa/test')),1);
		//delete the test user
		$surveyCreator=new SurveyCreator();
		$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
	}
}
	