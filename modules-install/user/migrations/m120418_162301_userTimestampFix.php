<?php

class m120418_162301_userTimestampFix extends CDbMigration
{
	public function safeUp()
	{
        /*if (!Yii::app()->getModule('user')) {
            echo "\n\nAdd to console.php :\n"
                 ."'modules'=>array(\n"
                 ."...\n"
                 ."    'user'=>array(\n"
                 ."        ... # copy settings from main config\n"
                 ."    ),\n"
                 ."...\n"
                 ."),\n"
                 ."\n";
            return false;
        }*/
        $tableUsers = "usr_users"; // hotfix - can't get a real console.php when installing via composer :/

        switch ($this->dbType()) {
            case "mysql":
                    $this->addColumn($tableUsers,'create_at',"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
                    $this->addColumn($tableUsers,'lastvisit_at',"TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'");
                    $this->execute("UPDATE ".$tableUsers." SET create_at = FROM_UNIXTIME(createtime), lastvisit_at = FROM_UNIXTIME(lastvisit)");
                    $this->dropColumn($tableUsers,'createtime');
                    $this->dropColumn($tableUsers,'lastvisit');
                break;
            case "sqlite":
            default:
                    $this->addColumn($tableUsers,'create_at',"TIMESTAMP");
                    $this->addColumn($tableUsers,'lastvisit_at',"TIMESTAMP");
                    $this->execute("UPDATE ".$tableUsers." SET create_at = datetime(createtime, 'unixepoch'), lastvisit_at = datetime(lastvisit, 'unixepoch')");
                    $this->execute('ALTER TABLE "'.$tableUsers.'" RENAME TO "'.__CLASS__.'_'.$tableUsers.'"');
                    $this->createTable($tableUsers, array(
                        "id" => "pk",
                        "username" => "varchar(20) NOT NULL",
                        "password" => "varchar(128) NOT NULL",
                        "email" => "varchar(128) NOT NULL",
                        "activkey" => "varchar(128) NOT NULL",
                        "superuser" => "int(1) NOT NULL",
                        "status" => "int(1) NOT NULL",
                        "create_at" => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
                        "lastvisit_at" => "TIMESTAMP",
                    ));
                    $this->execute('INSERT INTO "'.$tableUsers.'" SELECT "id","username","password","email","activkey","superuser","status","create_at","lastvisit_at" FROM "'.__CLASS__.'_'.$tableUsers.'"');
                    $this->dropTable(__CLASS__.'_'.$tableUsers);
                break;
        }
	}

	public function safeDown()
	{

        switch ($this->dbType()) {
            case "mysql":
                $this->addColumn($tableUsers,'createtime',"int(10) NOT NULL");
                $this->addColumn($tableUsers,'lastvisit',"int(10) NOT NULL");
                $this->execute("UPDATE ".$tableUsers." SET createtime = UNIX_TIMESTAMP(create_at), lastvisit = UNIX_TIMESTAMP(lastvisit_at)");
                $this->dropColumn($tableUsers,'create_at');
                $this->dropColumn($tableUsers,'lastvisit_at');
                break;
            case "sqlite":
            default:
                $this->addColumn($tableUsers,'createtime',"int(10)");
                $this->addColumn($tableUsers,'lastvisit',"int(10)");
                $this->execute("UPDATE ".$tableUsers." SET createtime = strftime('%s',create_at), lastvisit = strftime('%s',lastvisit_at)");
                $this->execute('ALTER TABLE "'.$tableUsers.'" RENAME TO "'.__CLASS__.'_'.$tableUsers.'"');
                $this->createTable($tableUsers, array(
                    "id" => "pk",
                    "username" => "varchar(20) NOT NULL",
                    "password" => "varchar(128) NOT NULL",
                    "email" => "varchar(128) NOT NULL",
                    "activkey" => "varchar(128) NOT NULL",
                    "createtime" => "int(10) NOT NULL",
                    "lastvisit" => "int(10) NOT NULL",
                    "superuser" => "int(1) NOT NULL",
                    "status" => "int(1) NOT NULL",
                ));
                $this->execute('INSERT INTO "'.$tableUsers.'" SELECT "id","username","password","email","activkey","createtime","lastvisit","superuser","status" FROM "'.__CLASS__.'_'.$tableUsers.'"');
                $this->execute('DROP TABLE "'.__CLASS__.'_'.$tableUsers.'"');
                break;
        }
	}

    public function dbType()
    {
        list($type) = explode(':',Yii::app()->db->connectionString);
        echo "type db: ".$type."\n";
        return $type;
    }
}