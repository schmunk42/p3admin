<?php

class m110402_195159_init extends CDbMigration {

	public function up() {

		$this->createTable("tbl_users", array(
			"id" => "pk",
			"username" => "varchar(20) NOT NULL",
			"password" => "varchar(128) NOT NULL",
			"email" => "varchar(128) NOT NULL",
			"activkey" => "varchar(128) NOT NULL",
			"createtime" => "int(10) NOT NULL",
			"lastvisit" => "int(10) NOT NULL",
			"superuser" => "int(1) NOT NULL",
			"status" => "int(1) NOT NULL",
			), "");

		$this->insert("tbl_users", array(
			"id" => "1",
			"username" => "admin",
			"password" => "21232f297a57a5a743894a0e4a801fc3",
			"email" => "webmaster@example.com",
			"activkey" => "21232f297a57a5a743894a0e4a801fc3",
			"createtime" => "1261146094",
			"lastvisit" => "0",
			"superuser" => "1",
			"status" => "1",
			));

		$this->insert("tbl_users", array(
			"id" => "2",
			"username" => "demo",
			"password" => "fe01ce2a7fbac8fafaed7c982a04e229",
			"email" => "demo@example.com",
			"activkey" => "fe01ce2a7fbac8fafaed7c982a04e229",
			"createtime" => "1261146096",
			"lastvisit" => "0",
			"superuser" => "0",
			"status" => "1",
			));

		$this->createTable("tbl_profiles", array(
			"user_id" => "pk",
			"lastname" => "varchar(50) NOT NULL",
			"firstname" => "varchar(50) NOT NULL",
			"birthday" => "date NOT NULL DEFAULT '0000-00-00'",
			), "");

		$this->insert("tbl_profiles", array(
			"user_id" => "1",
			"lastname" => "Admin",
			"firstname" => "Administrator",
			"birthday" => "0000-00-00",
			));

		$this->insert("tbl_profiles", array(
			"user_id" => "2",
			"lastname" => "Demo",
			"firstname" => "Demo",
			"birthday" => "0000-00-00",
			));

		$this->createTable("tbl_profiles_fields", array(
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

		$this->insert("tbl_profiles_fields", array(
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

		$this->insert("tbl_profiles_fields", array(
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

		$this->insert("tbl_profiles_fields", array(
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
		$this->dropTable('tbl_profiles');
		$this->dropTable('tbl_profiles_fields');
		$this->dropTable('tbl_users');
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