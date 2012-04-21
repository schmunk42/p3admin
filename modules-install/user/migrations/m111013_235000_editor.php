<?php

class m111013_235000_editor extends CDbMigration {

	public function up() {

		$this->insert("usr_users", array(
			"id" => "3",
			"username" => "editor",
			"password" => crypt("editor"),
			"email" => "editor@localhost",
			"superuser" => "0",
			"status" => "1",
			));


		$this->insert("usr_profiles", array(
			"user_id" => "3",
			"lastname" => "Editor",
			"firstname" => "Phundament 3",
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
