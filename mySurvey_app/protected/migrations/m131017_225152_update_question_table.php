<?php

class m131017_225152_update_question_table extends CDbMigration
{
	public function up()
	{
                $this->renameColumn('survey_question', 'survey_question_number', 'order_number');
                $this->renameColumn('survey_question', 'survey_question_type', 'type');
                $this->dropColumn('survey_question', 'survey_question_answer_required');
                $this->dropColumn('survey_question', 'survey_question_default_next_link');
	}

	public function down()
	{
                $this->addColumn('survey_question', 'survey_question_default_next_link','varchar(80)');
                $this->addColumn('survey_question', 'survey_question_answer_required','varchar(1)');
                $this->renameColumn('survey_question', 'order_num', 'survey_question_number');
                $this->renameColumn('survey_question', 'type', 'survey_question_type');
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