<?php

class m130928_183847_initial extends CDbMigration
{
	public function up()
	{
                $this->createTable('survey_creator', array(
                        'id' => 'pk',
                        'username'=> 'VARCHAR(45) NOT NULL',
                        'email' => 'VARCHAR(45) NOT NULL', 
                        'password' => 'VARCHAR(45) NOT NULL',
                        'first_name'=> 'VARCHAR(45) NULL',
                        'last_name'=> 'VARCHAR(45) NULL',
                ));
                $this->insert('survey_creator', array(
                    'username'=>'test1',
                    'email'=>'test1@example.com',
                    'password'=>'pass1',
                    'first_name'=>'test',
                    'last_name'=>'one'
                ));
	}

	public function down()
	{
		$this->dropTable('survey_creator');
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