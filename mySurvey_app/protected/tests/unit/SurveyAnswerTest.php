<?php
	class SurveyAnswerTest extends CDbTestCase{
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
				'survey_answer_choice_letter'=>'test',
				'survey_answer_response_time'=>new CDbExpression('NOW()'),
				'survey_answer_next_link'=>'test'
			));
			$this->assertTrue($surveyAnswers->save());
			
			
			//Access static member model(), get the AR instance of a specific row
			//Assert the row is not null
			$this -> assertNotNull($surveyAnswers::model() -> findByAttributes(array(
				'survey_question_ID'=>$surveyQuestion->id)));
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
                                             
                        //change the survey_answer_response_time
                        $surveyAnswer -> survey_answer_response_time = new CDbExpression('NOW()');
                        //assert the update is successfull
			$this->assertTrue($surveyAnswer->save());   
                        
                        //change the survey_question_ID
                        $surveyAnswer -> survey_question_ID = null;
                        //assert the update is unsuccessfull
			$this->assertFalse($surveyAnswer->save());   
                        
                        //change the survey_question_ID
                        $surveyAnswer -> survey_question_ID = $surveyQuestion->id;
                        //assert the update is successfull
			$this->assertTrue($surveyAnswer->save());   
                        
                        //change the survey_answer_choice_letter
                        $surveyAnswer -> survey_answer_choice_letter = 't';
                        //assert the update is successfull
			$this->assertTrue($surveyAnswer->save());     
                        
                        //change the survey_answer_choice_letter
                        $surveyAnswer -> survey_answer_choice_letter = 'test';
                        //assert the update is successfull
			$this->assertTrue($surveyAnswer->save());      
                        
                        //change the survey_answer_next_link
                        $surveyAnswer -> survey_answer_next_link = 'test2';
                        //assert the update is successfull
			$this->assertTrue($surveyAnswer->save());                        
	 	}
		
		public function testDelete(){
			//========Delete all testing record========
			$surveyCreator=new SurveyCreator();
			$survey = new Survey;
			$surveyQuestion = new SurveyQuestion;
			$surveyAnswers = new SurveyAnswer;
			
			$this->assertSame($surveyAnswers::model()->deleteAllByAttributes(array('survey_answer_choice_letter'=>'test')),1);
			$this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('text'=>'test')),1);
			$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'testURL')),1);
                        $this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
		}
	}
?>