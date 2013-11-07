<?php

class m131013_212226_survey_modification extends CDbMigration
{
	public function up()
	{
                
                $this->dropColumn('survey', 'survey_publish_date_time');
                $this->dropColumn('survey', 'survey_publish_status');

                $this->addColumn('survey', 'is_published', 'boolean DEFAULT 0');
                $this->addColumn('survey', 'title', 'varchar(100)');
                
                $this->renameColumn('survey', 'survey_date_time_created', 'created');
                $this->renameColumn('survey', 'survey_URL', 'url');
                
	}

	public function down()
	{
                
                $this->renameColumn('survey', 'url', 'survey_URL');
                $this->renameColumn('survey', 'created', 'survey_date_time_created');
                
                $this->dropColumn('survey', 'title');
                $this->dropColumn('survey', 'is_published');
                
                $this->addColumn('survey', 'survey_publish_status', 'varchar(1)');
                $this->addColumn('survey', 'survey_publish_date_time', 'datetime');

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