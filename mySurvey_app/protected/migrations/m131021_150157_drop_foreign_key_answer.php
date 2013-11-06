<?php

class m131021_150157_drop_foreign_key_answer extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('survey_answer_ibfk_1', 'survey_answer');
		$this->dropIndex('survey_ID', 'survey_answer');
		$this->dropColumn('survey_answer', 'survey_ID');
	}

	public function down()
	{
		$this->addColumn('survey_answer', 'survey_id', 'int(11) not null');
		$this->createIndex('survey_id', 'survey_answer', 'survey_ID');
		$this->addForeignKey('survey_answer_ibfk_1', 'survey_answer', 'survey_id', 'survey', 'id','CASCADE','CASCADE');

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