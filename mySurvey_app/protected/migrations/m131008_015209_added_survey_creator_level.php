<?php

class m131008_015209_added_survey_creator_level extends CDbMigration
{
	public function up()
	{
            $this->addColumn('survey_creator', 'level', 'INT default 0');
	}

	public function down()
	{
            $this->dropColumn('survey_creator', 'level');
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