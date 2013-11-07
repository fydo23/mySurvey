<?php
	class SurveyQuestionTest extends CDbTestCase{
		public function testInsert(){
			//========Data insertion test. Create a test user========
			$surveyCreator=new SurveyCreator('register');
			$surveyCreator->setAttributes(array(
				'email'=>'testCase@example.com',
				'password'=>'testpswd',
				'password_repeat'=>'testpswd',
				'first_name'=>'testFirst',
				'last_name'=>'testLast',
				'level'=>0
			));
			$this->assertTrue($surveyCreator->save());
			
			//========Create a survey for test user========
			//The 'survey_creator_ID' is a foreign key pointing to the 
		 	//primary key of table survey_creator, which is represented by SurveyCreator class
			$survey = new Survey;
			$survey->setAttributes(array(
				'url'=>'testURL',
				'created'=>new CDbExpression('NOW()'),
				'survey_creator_ID'=>$surveyCreator->id,
				'is_published'=>0,
				'title'=>'test title'
			));
			$this->assertTrue($survey->save());
				
			//========Create survey questions for test survey========
			$surveyQuestion = new SurveyQuestion;
			$surveyQuestion->setAttributes(array(
				'survey_ID'=>$survey->id,
				'survey_question_number'=>3,
				'survey_question_type'=>1,
				'survey_question_answer_required'=>'Y',
				'survey_question_default_next_link'=>'test'
			));
			$this->assertTrue($surveyQuestion->save());
						
			//Access static member model(), get the AR instance of a specific row
			//Assert the row is not null
// 			$this -> assertNotNull($surveyResponse::model() -> findByAttributes(array(
// 				'survey_ID' => $surveyQuestion -> survey_ID,
// 				'survey_question_number' => $surveyQuestion -> survey_question_number,
// 				'survey_question_type' => $surveyQuestion -> survey_question_type,
// 				'survey_question_answer_required' => $surveyQuestion -> survey_question_answer_required)));
		}
		
		public function testUpdate(){
			
// 			//========Update user information========
// 			$surveyCreator=new SurveyCreator();
// 			$surveyCreator=$surveyCreator::model()->findByAttributes(array('last_name'=>'testLast','password'=>sha1('testpswd')));
// 			$surveyCreator->email='test3333@example.com';
// 			$this->assertTrue($surveyCreator->save());
// 			$this->assertNotNull($surveyCreator::model()->findByAttributes(array('email'=>$surveyCreator->email,'password'=>sha1('testpswd'))));
		
			//========Update survey to published========
			$survey = new Survey;
			$survey = $survey::model()->findByAttributes(array('url'=>'testURL'));
			$survey -> is_published = 1;
			$this->assertTrue($survey->save());
			$this->assertNotNull($survey::model()->findByAttributes(array('is_published'=>$survey->is_published,'url'=>$survey->url)));
			
			//========Update survey question========
			//Check the existing table for 'survey_ID' and 'survey_question_ID'
			$surveyQuestion = new SurveyQuestion;
			$surveyQuestion = $surveyQuestion::model()->findByAttributes(array('survey_ID'=> $survey->id,'survey_question_number'=> 3));
			$surveyQuestion -> survey_question_type = 2;
			$surveyQuestion -> survey_question_answer_required = 'N';
			$this->assertTrue($surveyQuestion->save());
			$this->assertNotNull($surveyQuestion::model()->findByAttributes(array(
					'survey_question_type'=>$surveyQuestion->survey_question_type,
					'survey_question_answer_required'=>$surveyQuestion->survey_question_answer_required)));
// 			$this->assertTrue(true);
		}
		
		public function testDelete(){
			//========Delete all testing record========
			$surveyCreator=new SurveyCreator();
			$survey = new Survey;
			$surveyQuestion = new SurveyQuestion;
// 			$surveyAnswers = new SurveyAnswer;
// 			$surveyResponse = new SurveyResponse;
			
// 			$this->assertSame($surveyResponse::model()->deleteAllByAttributes(array('survey_response_responder'=>'TestUser')),1);
// 			$this->assertSame($surveyAnswers::model()->deleteAllByAttributes(array('choice_letter'=>'test')),1);
			$this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('survey_question_default_next_link'=>'test')),1);
			$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'testURL')),1);
			$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
		}
	}
?>