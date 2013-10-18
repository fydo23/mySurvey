<?php

class m131015_171535_added_question_text_field extends CDbMigration
{
	public function up()
	{
            $this->addColumn('survey_question', 'text', 'varchar(1000)');
	}

	public function down()
	{
		$this->dropColumn('survey_question', 'text');
		return false;
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