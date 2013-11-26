<?php

class m131125_133525_response_table_updates extends CDbMigration
{
	public function up()
	{
                $this->renameColumn('survey_response', 'survey_response_text', 'text');
                $this->renameColumn('survey_response', 'survey_response_responder', 'hash');
	}

	public function down()
	{
                $this->renameColumn('survey_response', 'text', 'survey_response_text');
                $this->renameColumn('survey_response', 'hash', 'survey_response_responder');
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