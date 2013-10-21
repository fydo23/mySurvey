<?php
	class SurveyResponseTest extends CDbTestCase{
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
			
			//========Create survey answers for test survey========
			$surveyAnswers = new SurveyAnswer;
			//set the attributes with dummy data
			$surveyAnswers->setAttributes(array(
				'survey_ID'=>$survey->id,
				'survey_question_ID'=>$surveyQuestion->id,
				'survey_answer_choice_letter'=>'test',
				'survey_answer_response_time'=>new CDbExpression('NOW()'),
				'survey_answer_next_link'=>'test'
			));
			$this->assertTrue($surveyAnswers->save());
			
			//========Create responses for survey_response========
			$surveyResponse = new SurveyResponse;
			$surveyResponse -> setAttributes(array(
				'survey_ID' => $survey->id,
				'survey_question_ID' => $surveyQuestion->id,
				'survey_answer_ID' => $surveyAnswers->id,
				'survey_answer_choice_letter' => 'Test',
				'survey_response_time' => NULL,
				'survey_response_responder' => 'TestUser',
				'survey_response_text' => NULL
			));
			
			//Assert the data successfully inserted
			$this -> assertTrue($surveyResponse -> save());
			
			//Access static member model(), get the AR instance of a specific row
			//Assert the row is not null
			$this -> assertNotNull($surveyResponse::model() -> findByAttributes(array(
				'survey_ID' => $surveyResponse -> survey_ID,
				'survey_question_ID' => $surveyResponse -> survey_question_ID,
				'survey_answer_ID' => $surveyResponse -> survey_answer_ID)));
		}
		
		public function testUpdate(){
			//========Update user information========
			$surveyCreator=new SurveyCreator();
			$surveyCreator=$surveyCreator::model()->findByAttributes(array('last_name'=>'testLast','password'=>sha1('testpswd')));
			$surveyCreator->email='test3333@example.com';
			$this->assertTrue($surveyCreator->save());
			$this->assertNotNull($surveyCreator::model()->findByAttributes(array('email'=>$surveyCreator->email,'password'=>sha1('testpswd'))));
		
			//========Update survey to published========
			$survey = new Survey;
			$survey = $survey::model()->findByAttributes(array('url'=>'testURL'));
			$survey -> is_published = 1;
			$this->assertTrue($survey->save());
			$this->assertNotNull($survey::model()->findByAttributes(array('is_published'=>$survey->is_published,'url'=>$survey->url)));
			
			//========Update survey response time========
			//Check the existing table for 'survey_ID' and 'survey_question_ID'
			$surveyResponse = new SurveyResponse;
			$surveyResponse = $surveyResponse::model()->findByAttributes(array('survey_answer_choice_letter'=> 'Test','survey_response_responder'=> 'TestUser'));
			$surveyResponse -> survey_response_time = new CDbExpression('NOW()');
			$this->assertTrue($surveyResponse->save());
			$this->assertNotNull($surveyResponse::model()->findByAttributes(array('survey_answer_choice_letter'=>$surveyResponse->survey_answer_choice_letter,'survey_response_responder'=>$surveyResponse->survey_response_responder)));
		}
		
		public function testDelete(){
			//========Delete all testing record========
			$surveyCreator=new SurveyCreator();
			$survey = new Survey;
			$surveyQuestion = new SurveyQuestion;
			$surveyAnswers = new SurveyAnswer;
			$surveyResponse = new SurveyResponse;
			
			$this->assertSame($surveyResponse::model()->deleteAllByAttributes(array('survey_response_responder'=>'TestUser')),1);
			$this->assertSame($surveyAnswers::model()->deleteAllByAttributes(array('survey_answer_choice_letter'=>'test')),1);
			$this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('survey_question_default_next_link'=>'test')),1);
			$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'testURL')),1);
			$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'test3333@example.com')),1);
		}
	}
?>