<?php

class m131011_125208_remove_username_from_survey_creator extends CDbMigration
{
	public function up()
	{
            $this->dropColumn('survey_creator', 'username');
            return true;
	}

	public function down()
	{
            $this->addColumn('survey_creator', 'username','varchar(45)');
            return true;
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