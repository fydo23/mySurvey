<?php

class m131106_142245_cascading_on_answer_and_response extends CDbMigration
{
	public function up()
	{  
                $this->dropForeignKey('survey_answer_ibfk_2', 'survey_answer');
                $this->addForeignKey('survey_answer_ibfk_2', 'survey_answer', 'survey_question_ID', 'survey_question', 'id', 'CASCADE', 'CASCADE');

                $this->dropForeignKey('survey_response_ibfk_3', 'survey_response');
                $this->addForeignKey('survey_response_ibfk_3', 'survey_response', 'survey_answer_ID', 'survey_answer', 'id', 'CASCADE', 'CASCADE');
//                

	}

	public function down()
	{
                $this->dropForeignKey('survey_answer_ibfk_2', 'survey_answer');
                $this->addForeignKey('survey_answer_ibfk_2', 'survey_answer', 'survey_question_ID', 'survey_question', 'id');

                $this->dropForeignKey('survey_response_ibfk_3', 'survey_response');
                $this->addForeignKey('survey_response_ibfk_3', 'survey_response', 'survey_answer_ID', 'survey_answer', 'id');
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