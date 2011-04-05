<?php

class ModuleController extends Controller {

	private $_moduleName = null;
	/*
	 * Template data
	 */
	private $_data = array();

	public function getModuleName() {
		return $this->_moduleName;
	}

	public function beforeAction($action) {

		if (isset($_GET['module']) && is_dir(Yii::getPathOfAlias('application.modules.' . $_GET['module']))) {
			$this->_moduleName = $_GET['module'];
		} else {
			
		}

		#if ()
		return true;
		#else
		#	return false;
	}

	public function actionIndex() {
		$this->prepareModuleMigrationData();
		$this->prepareModuleConfigurationData();
		$this->prepareModuleReadmeData();
		$this->render('index', $this->_data);
	}

	public function actionApplyMigration() {
		chdir(Yii::getPathOfAlias('application'));
		$command = './yiic migrate up 1 ' .
			'--interactive=0 ' .
			'--migrationPath=application.modules.' . $this->_moduleName . '.migrations ' .
			'--migrationTable=tbl_migration_module_' . $this->_moduleName;
		exec($command, $output, $return);
		$echo = "";
		foreach ($output AS $line) {
			$echo .= $line . "\n";
		}
		echo $echo;
	}

	private function prepareModuleMigrationData() {
			$this->_data['command'] = './yiic migrate ' .
				'--migrationPath=application.modules.' . $this->_moduleName . '.migrations ' .
				'--migrationTable=tbl_migration_module_' . $this->_moduleName;
				$this->_data['hasMigration'] = false;

		if (is_dir(Yii::getPathOfAlias('application.modules.' . $this->_moduleName . '.migrations'))) {
			chdir(Yii::getPathOfAlias('application'));
			exec($this->_data['command'], $output, $return);

			if (!strstr($output[3], 'up-to-date')) {
				$this->_data['hasMigration'] = true;
			}

			$this->_data['output'] = "";
			foreach ($output AS $line) {
				$this->_data['output'] .= $line . "\n";
			}
		} else {
			$this->_data['output'] = "This module has no migration directory.";
		}
	}

	private function prepareModuleReadmeData() {
		if (is_file(Yii::getPathOfAlias('application.modules.' . $this->_moduleName . '.README'))) {
			$this->_data['readme'] = "<pre>" . file_get_contents(Yii::getPathOfAlias('application.modules.' . $this->_moduleName . '.README')) . "</pre>";
		} else {
			$this->_data['readme'] = "This module has no README file.";
		}
	}

	private function prepareModuleConfigurationData() {
		$configFile = Yii::getPathOfAlias('application.modules.' . $this->_moduleName . '.config') . DIRECTORY_SEPARATOR . 'main.php';
		if (is_file($configFile)) {
			$configArray = require($configFile);
			$this->_data['configuration'] = CVarDumper::dumpAsString($configArray,10,true);
		} else {
			$this->_data['configuration'] = "This module has no default configuration file.";
		}
	}

}