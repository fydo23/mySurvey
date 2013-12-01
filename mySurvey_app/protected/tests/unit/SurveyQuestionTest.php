<?php
	class SurveyQuestionTest extends CDbTestCase{
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
						
			//Access static member model(), get the AR instance of a specific row
			//Assert the row is not null
 			$this -> assertNotNull($surveyQuestion::model() -> findByAttributes(array(
 				'survey_ID' => $surveyQuestion -> survey_ID,
 				'order_number' => $surveyQuestion ->order_number,
 				'type' => $surveyQuestion -> type,
 				'text' => $surveyQuestion -> text)));
		}
		
		public function testUpdate(){
                    
 			$surveyCreator=new SurveyCreator();
 			$surveyCreator=$surveyCreator::model()->findByAttributes(array('email'=>'testCase@example.com','password'=>sha1('testpswd')));

			$survey = new Survey;
			$survey = $survey::model()->findByAttributes(array('survey_creator_ID'=>$surveyCreator->id, 'url'=>'testURL', 'title'=>'test title'));

			$surveyQuestion=new SurveyQuestion();
			$surveyQuestion = $surveyQuestion::model()->findByAttributes(array('survey_ID'=> $survey->id,'order_number'=> 3));
            
                        //change the type
			$surveyQuestion -> type = null;
                        //assert the update is unsuccess
			$this->assertFalse($surveyQuestion->save());
                        
                        //change the type
			$surveyQuestion -> type = 2;
                        //assert the update is success
			$this->assertTrue($surveyQuestion->save());

                        //change the order
			$surveyQuestion -> order_number = null;
                        //assert the update is unsuccess
			$this->assertFalse($surveyQuestion->save());                         
                  
                        //change the order
			$surveyQuestion -> order_number = 4;
                        //assert the update is success
			$this->assertTrue($surveyQuestion->save());                        

                        //change the survey_id
			$surveyQuestion ->survey_ID = null;
                        //assert the update is unsuccess
			$this->assertFalse($surveyQuestion->save());                         
                  
                        //change the order
			$surveyQuestion -> survey_ID = $survey -> id;
                        //assert the update is success
			$this->assertTrue($surveyQuestion->save());   
                        
                        
			$this->assertNotNull($surveyQuestion::model()->findByAttributes(array('survey_ID'=> $survey->id, 'text'=> 'test')));
      			$this->assertTrue(true);
		}
		
		public function testDelete(){
//// 			$this->assertSame($surveyResponse::model()->deleteAllByAttributes(array('hash'=>'TestUser')),1);
//// 			$this->assertSame($surveyAnswers::model()->deleteAllByAttributes(array('survey_answer_choice_letter'=>'test')),1);
//			$this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('survey_question_default_next_link'=>'test')),1);
//			$this->assertSame($survey::model()->deleteAllByAttributes(array('url'=>'testURL')),1);
//			$this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
                    	
                        $surveyQuestion=new SurveyQuestion();
                        $this->assertSame($surveyQuestion::model()->deleteAllByAttributes(array('text' => 'test')),1);
                    
                        $survey=new Survey();
                        $this->assertSame($survey::model()->deleteAllByAttributes(array('title'=>'test title')),1);
                        
                        $surveyCreator=new SurveyCreator();
                        $this->assertSame($surveyCreator::model()->deleteAllByAttributes(array('email'=>'testCase@example.com')),1);
		}
	}
?>