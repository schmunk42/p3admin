<?php

class m110402_195159_init extends CDbMigration {

	public function up() {

		echo "*** WARNING ***\nJust for debugging - Primary Key definitions missing!\n\n";

		$this->createTable("AuthAssignment", array(
			"itemname" => "varchar(64)  NOT NULL",
			"userid" => "varchar(64)  NOT NULL",
			"bizrule" => "text",
			"data" => "text",
			"primary key (itemname,userid)",
			"foreign key (itemname) references AuthItem (name) on delete cascade on update cascade"
		));

		$this->insert("AuthAssignment", array(
			"itemname" => "Admin",
			"userid" => "1",
			"bizrule" => null,
			"data" => "N;",
			));

		$this->createTable("AuthItem", array(
			"name" => "varchar(64)  NOT NULL",
			"type" => "integer NOT NULL",
			"description" => "text",
			"bizrule" => "text",
			"data" => "text",
			"primary key (name)"
			), "");

		$this->insert("AuthItem", array(
			"name" => "Admin",
			"type" => "2",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
			));

		$this->insert("AuthItem", array(
			"name" => "Authenticated",
			"type" => "2",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
			));

		$this->insert("AuthItem", array(
			"name" => "Guest",
			"type" => "2",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
			));

		$this->createTable("AuthItemChild", array(
			"parent" => "varchar(64)  NOT NULL",
			"child" => "varchar(64)  NOT NULL",
			"primary key (parent,child)",
			"foreign key (parent) references AuthItem (name) on delete cascade on update cascade",
			"foreign key (child) references AuthItem (name) on delete cascade on update cascade"
			), "");

		$this->createTable("Rights", array(
			"itemname" => "varchar(64)  NOT NULL",
			"type" => "integer NOT NULL",
			"weight" => "integer NOT NULL",
			"primary key (itemname)",
			"foreign key (itemname) references AuthItem (name) on delete cascade on update cascade"
			), "");
	}

	public function down() {
		$this->dropTable('AuthAssignment');
		$this->dropTable('AuthItem');
		$this->dropTable('AuthItemChild');
		$this->dropTable('Rights');
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