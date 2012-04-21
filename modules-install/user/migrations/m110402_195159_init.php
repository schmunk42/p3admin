<?php

class m110402_195159_init extends CDbMigration {

	public function up() {

		$this->createTable("usr_users", array(
			"id" => "pk",
			"username" => "varchar(20) NOT NULL",
			"password" => "varchar(128) NOT NULL",
			"email" => "varchar(128) NOT NULL",
			"activkey" => "varchar(128) NOT NULL DEFAULT ''",
			"create_at" => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
			"lastvisit_at" => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
			"superuser" => "int(1) NOT NULL",
			"status" => "int(1) NOT NULL",
			), "");

		$this->insert("usr_users", array(
			"id" => "1",
			"username" => "admin",
			"password" => crypt("admin"),
			"email" => "webmaster@localhost",
			"superuser" => "1",
			"status" => "1",
			));

		$this->insert("usr_users", array(
			"id" => "2",
			"username" => "demo",
			"password" => crypt("demo"),
			"email" => "demo@localhost",
			"superuser" => "0",
			"status" => "1",
			));

		$this->createTable("usr_profiles", array(
			"user_id" => "pk",
			"lastname" => "varchar(50) NOT NULL",
			"firstname" => "varchar(50) NOT NULL",
			"birthday" => "DATE DEFAULT '0000-00-00'",
			), "");

		$this->insert("usr_profiles", array(
			"user_id" => "1",
			"lastname" => "Admin",
			"firstname" => "Administrator",
			));

		$this->insert("usr_profiles", array(
			"user_id" => "2",
			"lastname" => "Demo",
			"firstname" => "Demo",
			));

		$this->createTable("usr_profiles_fields", array(
			"id" => "pk",
			"varname" => "varchar(50) NOT NULL",
			"title" => "varchar(255) NOT NULL",
			"field_type" => "varchar(50) NOT NULL",
			"field_size" => "int(3) NOT NULL",
			"field_size_min" => "int(3) NOT NULL",
			"required" => "int(1) NOT NULL",
			"match" => "varchar(255) NOT NULL",
			"range" => "varchar(255) NOT NULL",
			"error_message" => "varchar(255) NOT NULL",
			"other_validator" => "text NOT NULL",
			"default" => "varchar(255) NOT NULL",
			"widget" => "varchar(255) NOT NULL",
			"widgetparams" => "text NOT NULL",
			"position" => "int(3) NOT NULL",
			"visible" => "int(1) NOT NULL",
			), "");

		$this->insert("usr_profiles_fields", array(
			"id" => "1",
			"varname" => "lastname",
			"title" => "Last Name",
			"field_type" => "VARCHAR",
			"field_size" => "50",
			"field_size_min" => "3",
			"required" => "1",
			"match" => "",
			"range" => "",
			"error_message" => "Incorrect Last Name (length between 3 and 50 characters).",
			"other_validator" => "",
			"default" => "",
			"widget" => "",
			"widgetparams" => "",
			"position" => "1",
			"visible" => "3",
			));

		$this->insert("usr_profiles_fields", array(
			"id" => "2",
			"varname" => "firstname",
			"title" => "First Name",
			"field_type" => "VARCHAR",
			"field_size" => "50",
			"field_size_min" => "3",
			"required" => "1",
			"match" => "",
			"range" => "",
			"error_message" => "Incorrect First Name (length between 3 and 50 characters).",
			"other_validator" => "",
			"default" => "",
			"widget" => "",
			"widgetparams" => "",
			"position" => "0",
			"visible" => "3",
			));

		$this->insert("usr_profiles_fields", array(
			"id" => "3",
			"varname" => "birthday",
			"title" => "Birthday",
			"field_type" => "DATE",
			"field_size" => "0",
			"field_size_min" => "0",
			"required" => "2",
			"match" => "",
			"range" => "",
			"error_message" => "",
			"other_validator" => "",
			"default" => "0000-00-00",
			"widget" => "UWjuidate",
			"widgetparams" => "{\"ui-theme\":\"redmond\"}",
			"position" => "3",
			"visible" => "2",
			));
	}

	public function down() {
		$this->dropTable('usr_profiles');
		$this->dropTable('usr_profiles_fields');
		$this->dropTable('usr_users');
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
