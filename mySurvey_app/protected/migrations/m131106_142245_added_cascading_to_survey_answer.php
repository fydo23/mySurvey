<?php

class m131106_142245_added_cascading_to_survey_answer extends CDbMigration
{
	public function up()
	{  
                $this->dropForeignKey('survey_answer_ibfk_2', 'survey_answer');
                $this->addForeignKey('survey_answer_ibfk_2', 'survey_answer', 'survey_question_ID', 'survey_question', 'id', 'CASCADE', 'CASCADE');
//                

	}

	public function down()
	{
                $this->dropForeignKey('survey_answer_ibfk_2', 'survey_answer');
                $this->addForeignKey('survey_answer_ibfk_2', 'survey_answer', 'survey_question_ID', 'survey_question', 'id');
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