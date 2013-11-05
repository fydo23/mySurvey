<?php

class m131031_040732_add_answer_text_and_order_number extends CDbMigration
{
	public function up()
	{
		$this->addColumn('survey_answer', 'text', 'varchar(1000)');
		$this->addColumn('survey_answer', 'order_number', '	INT NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('survey_answer', 'text');
		$this->dropColumn('survey_answer', 'order_number');
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