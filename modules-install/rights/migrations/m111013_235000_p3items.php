<?php

class m111013_235000_p3items extends CDbMigration {

	public function up() {
		$this->insert("AuthAssignment", array(
			"itemname" => "Editor",
			"userid" => "3",
			"bizrule" => null,
			"data" => "N;",
		));

		
		$this->insert("AuthItem", array(
			"name" => "Editor",
			"type" => "2",
			"description" => "Content Editor (Widgets, Media Files)",
			"bizrule" => null,
			"data" => "N;",
		));


		$this->insert("AuthItem", array(
			"name" => "P3admin.Default.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3admin.Module.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3media.Ckeditor.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3media.Default.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3media.File.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3media.Import.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3media.P3Media.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3media.P3MediaMeta.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3widgets.Default.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));

		$this->insert("AuthItem", array(
			"name" => "P3widgets.Widget.*",
			"type" => "1",
			"description" => null,
			"bizrule" => null,
			"data" => "N;",
		));


// Data for table 'AuthItemChild'

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "P3media.Ckeditor.*",
		));

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "P3media.Default.*",
		));

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "P3media.Import.*",
		));

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "P3media.P3Media.*",
		));

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "P3media.P3MediaMeta.*",
		));

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "P3widgets.Default.*",
		));

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "P3widgets.Widget.*",
		));

		$this->insert("AuthItemChild", array(
			"parent" => "Editor",
			"child" => "Authenticated",
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