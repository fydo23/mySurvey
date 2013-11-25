<?php
	class SurveyResponseTest extends CDbTestCase{
		public function testInsert(){
			//========Data insertion test. Create a test user========
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
		
                        //asserts the insert is success
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
                        //asserts the insert is success
			$this->assertTrue($survey->save());
				
			//========Create survey questions for test survey========
			$surveyQuestion = new SurveyQuestion;
			$surveyQuestion->setAttributes(array(
				'survey_ID'=>$survey->id,
				'order_number'=>3,
				'type'=>1,
				'text'=>'test'
			));
                        //asserts the insert is success
			$this->assertTrue($surveyQuestion->save());
			
			//========Create survey answers for test survey========
			$surveyAnswers = new SurveyAnswer;
			//set the attributes with dummy data
			$surveyAnswers->setAttributes(array(
				'survey_question_ID'=>$surveyQuestion->id,
				'choice_letter'=>'test',
				'survey_answer_response_time'=>new CDbExpression('NOW()'),
				'survey_answer_next_link'=>'test'
			));
			$this->assertTrue($surveyAnswers->save());
			
			//========Create responses for survey_response========
			$surveyResponse = new SurveyResponse;
			$surveyResponse -> setAttributes(array(
				'survey_answer_ID' => $surveyAnswers->id,
				'choice_letter' => 'Test',
				'survey_response_time' => NULL,
				'survey_response_responder' => 'TestUser',
				'survey_response_text' => NULL
			));
			
			//Assert the data successfully inserted
			$this -> assertTrue($surveyResponse -> save());
			
			//Access static member model(), get the AR instance of a specific row
			//Assert the row is not null
			$this -> assertNotNull($surveyResponse::model() -> findByAttributes(array(
				'survey_answer_ID' => $surveyResponse -> survey_answer_ID)));
		}
		
		public function testUpdate(){
 			$surveyCreator=new SurveyCreator();
 			$surveyCreator=$surveyCreator::model()->findByAttributes(array('email'=>'testCase@example.com','password'=>sha1('testpswd')));

			$survey = new Survey;
			$survey = $survey::model()->findByAttributes(array('survey_creator_ID'=>$surveyCreator->id, 'url'=>'testURL', 'title'=>'test title'));

			$surveyQuestion=new SurveyQuestion();
			$surveyQuestion=$surveyQuestion::model()->findByAttributes(array('survey_ID'=> $survey->id,'order_number'=> 3));

                        $surveyAnswer=new SurveyAnswer();
			$surveyAnswer = $surveyAnswer::model()->findByAttributes(array('survey_question_ID'=> $surveyQuestion->id,'survey_answer_choice_letter'=>'test'));
                        
			//========Update survey response time========
			//Check the existing table for 'survey_ID' and 'survey_question_ID'
			$surveyResponse = new SurveyResponse;

			$surveyResponse = $surveyResponse::model()->findByAttributes(array('survey_answer_ID'=> $surveyAnswer->id,'survey_response_responder'=> 'TestUser'));
                        
                        
                        //change the survey_response_time
                        $surveyResponse -> survey_response_time = new CDbExpression('NOW()');
                        //assert the update is successfull
			$this->assertTrue($surveyResponse->save());   
                        
                        //change the survey_answer_ID
                        $surveyResponse -> survey_answer_ID = null;
                        //assert the update is unsuccessfull
			$this->assertFalse($surveyResponse->save());   
                        
                        //change the survey_answer_ID
                        $surveyResponse -> survey_answer_ID = $surveyAnswer->id;
                        //assert the update is successfull
			$this->assertTrue($surveyResponse->save());   
                        
                        //change the survey_response_text
                        $surveyResponse -> survey_response_text = "test2";
                        //assert the update is successfull
			$this->assertTrue($surveyResponse->save()); 
                        
                        //change the survey_response_responder
                        $surveyResponse -> survey_response_responder = "test2";
                        //assert the update is successfull
			$this->assertTrue($surveyResponse->save()); 

		}
		
		public function testDelete(){
			//========Delete all testing record========
			$surveyCreator=new SurveyCreator();
			$survey = new Survey;
			$surveyQuestion = new SurveyQuestion;
			$surveyAnswers = new SurveyAnswer;
			$surveyResponse = new SurveyResponse;
			
			$this->assertSame($surveyResponse::model()->deleteAllByAttributes(array('survey_answer_choice_letter'=>'Test')),1);
			$this->assertSame($surveyAnswers::model()->deleteAllByAttributes(array('survey_answer_choice_letter'=>'test')),1);
			$this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('text'=>'test')),1);

			$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'testURL')),1);
			$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
		}
	}
?>