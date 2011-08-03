<?php

class ModuleController extends Controller {

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow', // allow all users to perform 'index' and 'view' actions
				'users' => array('*'),
			),
			array('deny', // deny all users
				'users' => array('*'),
				'expression' => '!Yii::app()->getModule("p3admin")->params["install"]',
			),
		);
	}

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
		$info = $this->fileInfo('migrations', null);

		chdir(Yii::getPathOfAlias('application'));
		$command = $this->module->yiicCommand.' migrate up 1 ' .
			'--interactive=0 ' .
			'--migrationPath='.$info['alias'].' ' .
			'--migrationTable=tbl_migration_module_' . $this->_moduleName;
		exec($command, $output, $return);
		$echo = "";
		foreach ($output AS $line) {
			$echo .= $line . "\n";
		}
		echo $echo;
	}

	private function prepareModuleMigrationData() {
		$info = $this->fileInfo('migrations', null);

		if ($info !== false) {
			$this->_data['command'] = $this->module->yiicCommand.' migrate ' .
				'--migrationPath=' . $info['alias'] . ' ' .
				'--migrationTable=tbl_migration_module_' . $this->_moduleName;
			$this->_data['hasMigration'] = false;

			
			chdir(Yii::getPathOfAlias('application'));
			exec($this->_data['command'], $output, $return);
			
			if (count($output) === 0) {
				throw new CHttpException(500, 'Yiic command not found ('.$this->module->yiicCommand.')');
			}
			
			if (!strstr($output[3], 'up-to-date')) {
				$this->_data['hasMigration'] = true;
			}

			$this->_data['output'] = "";
			foreach ($output AS $line) {
				$this->_data['output'] .= $line . "\n";
			}
			$this->_data['migration'] = null;
		} else {
			$this->_data['migration'] = "This module has no migration directory.";
			$this->_data['output'] = null;
		}
	}

	private function prepareModuleReadmeData() {
		$info = $this->fileInfo('README', null);
		if ($info !== false) {
			$this->_data['readme'] = "<pre>" . file_get_contents(Yii::getPathOfAlias('application.modules.' . $this->_moduleName . '.README')) . "</pre>";
		} else {
			$this->_data['readme'] = "This module has no README file.";
		}
	}

	private function prepareModuleConfigurationData() {
		$info = $this->fileInfo('config.main');
		if ($info !== false) {
			$configArray = require($info['path']);
			$this->_data['configuration'] = CVarDumper::dumpAsString($configArray, 10, true);
		} else {
			$this->_data['configuration'] = "This module has no default configuration file.";
		}
	}

	/**
	 * Looks for files in the module or in p3admin.info as a fallback
	 *
	 * @param <type> $relativeAlias
	 * @param <type> $ext
	 * @return <type>
	 */
	private function fileInfo($relativeAlias, $ext = '.php') {
		$defaultAlias = 'application.modules.' . $this->_moduleName . '.' . $relativeAlias;
		$defaultFile = Yii::getPathOfAlias($defaultAlias) . $ext;

		$fallbackAlias = 'application.modules.p3admin.modules-install.' . $this->_moduleName . '.' . $relativeAlias;
		$fallbackFile = Yii::getPathOfAlias($fallbackAlias) . $ext;

		if (is_readable($defaultFile))
			return array('path' => $defaultFile, 'alias' => $defaultAlias);
		elseif (is_readable($fallbackFile))
			return array('path' => $fallbackFile, 'alias' => $fallbackAlias);
		else
			return false;
	}

}