<?php

class m111013_235000_editor extends CDbMigration {

	public function up() {

		$this->insert("usr_users", array(
			"id" => "3",
			"username" => "editor",
			"password" => "5aee9dbd2a188839105073571bee1b1f",
			"email" => "editor.com",
			"activkey" => "32ae2c5f8da0baaf8af20fedcb75d1a7",
			"createtime" => "0",
			"lastvisit" => "0",
			"superuser" => "0",
			"status" => "1",
			));


		$this->insert("usr_profiles", array(
			"user_id" => "3",
			"lastname" => "Editor",
			"firstname" => "Phundament 3",
			"birthday" => "0000-00-00",
			));


	}

	public function down() {
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