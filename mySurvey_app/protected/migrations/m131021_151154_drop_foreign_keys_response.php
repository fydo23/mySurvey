<?php

class m131021_151154_drop_foreign_keys_response extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('survey_response_ibfk_1', 'survey_response');
		$this->dropIndex('survey_ID', 'survey_response');
		$this->dropColumn('survey_response', 'survey_ID');
		
		$this->dropForeignKey('survey_response_ibfk_2', 'survey_response');
		$this->dropIndex('survey_question_ID', 'survey_response');
		$this->dropColumn('survey_response', 'survey_question_ID');
	}

	public function down()
	{
		$this->addColumn('survey_response', 'survey_question_id', 'int(11) not null');
		$this->createIndex('survey_question_id', 'survey_response', 'survey_question_ID');
		$this->addForeignKey('survey_response_ibfk_2', 'survey_response', 'survey_question_id', 'survey_question', 'id','CASCADE','CASCADE');
		
		$this->addColumn('survey_response', 'survey_id', 'int(11) not null');
		$this->createIndex('survey_id', 'survey_response', 'survey_ID');
		$this->addForeignKey('survey_response_ibfk_1', 'survey_response', 'survey_id', 'survey', 'id','CASCADE','CASCADE');
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