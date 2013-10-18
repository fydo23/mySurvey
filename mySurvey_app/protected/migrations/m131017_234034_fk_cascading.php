<?php

class m131017_234034_fk_cascading extends CDbMigration
{
	public function up()
	{
                $this->dropForeignKey('survey_ibfk_1', 'survey');
                $this->addForeignKey('survey_ibfk_1', 'survey', 'survey_creator_ID', 'survey_creator', 'id', 'CASCADE', 'CASCADE');
//                
                $this->dropForeignKey('survey_question_ibfk_1', 'survey_question');
                $this->addForeignKey('survey_question_ibfk_1', 'survey_question', 'survey_ID', 'survey', 'id', 'CASCADE', 'CASCADE');
//                
                $this->dropForeignKey('survey_answer_ibfk_1', 'survey_answer');
                $this->addForeignKey('survey_answer_ibfk_1', 'survey_answer', 'survey_question_ID', 'survey_question', 'id', 'CASCADE', 'CASCADE');
//                
                $this->dropForeignKey('survey_response_ibfk_1', 'survey_response');
                $this->addForeignKey('survey_response_ibfk_1', 'survey_response', 'survey_answer_ID', 'survey_answer', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
                $this->dropForeignKey('survey_ibfk_1', 'survey');
                $this->addForeignKey('survey_ibfk_1', 'survey', 'survey_creator_ID', 'survey_creator', 'id');
//                
                $this->dropForeignKey('survey_question_ibfk_1', 'survey_question');
                $this->addForeignKey('survey_question_ibfk_1', 'survey_question', 'survey_ID', 'survey', 'id');
                
                $this->dropForeignKey('survey_answer_ibfk_1', 'survey_answer');
                $this->addForeignKey('survey_answer_ibfk_1', 'survey_answer', 'survey_question_ID', 'survey_question', 'id');
//                
                $this->dropForeignKey('survey_response_ibfk_1', 'survey_response');
                $this->addForeignKey('survey_response_ibfk_1', 'survey_response', 'survey_answer_ID', 'survey_answer', 'id');
                
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