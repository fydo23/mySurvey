<?php

class m131105_173834_rename_survey_answer_choice_letter extends CDbMigration
{
	public function up()
	{
		$this->renameColumn('survey_answer','survey_answer_choice_letter', 'choice_letter');
	}

	public function down()
	{
		$this->renameColumn('survey_answer','choice_letter', 'survey_answer_choice_letter');
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