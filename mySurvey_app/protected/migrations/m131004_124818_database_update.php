<?php

class m131004_124818_database_update extends CDbMigration
{
	public function up()
	{
	$this->createTable('survey', array(
                        'id' => 'pk',
                        'survey_URL'=> 'VARCHAR(80) NOT NULL',
                        'survey_date_time_created' => 'DATETIME NOT NULL', 
                        'survey_creator_ID' => 'INT NOT NULL',
                        'survey_publish_status'=> 'VARCHAR(1) NULL',
                        'survey_publish_date_time'=> 'DATETIME NULL',
						'foreign key (survey_creator_ID) references survey_creator(id)'	
                ));
				$this->createTable('survey_question', array(
                        'id' => 'pk',
                        'survey_ID'=> 'INT NOT NULL',
                        'survey_question_number' => 'INT NOT NULL', 
                        'survey_question_type' => 'INT NOT NULL',
                        'survey_question_answer_required'=> 'VARCHAR(1) NULL',
                        'survey_question_default_next_link'=> 'VARCHAR(80) NULL',
						'foreign key (survey_ID) references survey(id)'						
                ));
				$this->createTable('survey_answer', array(
                        'id' => 'pk',
						'survey_ID'=> 'INT NOT NULL',
						'survey_question_ID' => 'INT NOT NULL',                        
                        'survey_answer_choice_letter' => 'VARCHAR(5) NOT NULL', 
                        'survey_answer_response_time' => 'TIME NULL',
                        'survey_answer_next_link'=> 'VARCHAR(80) NULL',
						'foreign key (survey_ID) references survey(id)',
						'foreign key (survey_question_ID) references survey_question(id)'						
                ));
				$this->createTable('survey_response', array(
                        'id' => 'pk',
                        'survey_ID'=> 'INT NOT NULL',
						'survey_question_ID' => 'INT NOT NULL',
						'survey_answer_ID'=> 'INT NOT NULL',
                        'survey_answer_choice_letter' => 'VARCHAR(5) NULL',
                        'survey_response_time' => 'TIME NULL',
						'survey_response_responder'=> 'VARCHAR(45) NULL',
                        'survey_response_text'=> 'BLOB NULL',
						'foreign key (survey_ID) references survey(id)',
						'foreign key (survey_question_ID) references survey_question(id)',
						'foreign key (survey_answer_ID) references survey_answer(id)',					
                ));
	}

	public function down()
	{
		$this->dropTable('survey_response');
                
		$this->dropTable('survey_answer');
               
		$this->dropTable('survey_question');
				
		$this->dropTable('survey');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}