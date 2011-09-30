<?php

class DefaultController extends Controller {
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','settings'),
				'users'=>array('admin')
			),
			array('deny',  // deny all users
				'users'=>array('*'),
				'expression'=> '!Yii::app()->getModule("p3admin")->params["install"]',
			),
		);
	}
	
	public function beforeAction($action){
		parent::beforeAction($action);
		if (Yii::app()->getModule("p3admin")->params["install"]) {
			EUserFlash::setWarningMessage("P3AdminModule installation mode is <b>active</b>, access is NOT restricted!<br/>".
				"Update P3AdminModule config, when you've finished the setup of the user and rights modules.".
				"<pre>".
"'p3admin' => array(
	'params' => array('install' => false),			
),</pre>","install");
		}
		return true;
	}

	public function actionIndex() {
		$this->layout = "//layouts/column2";
		$this->render('index');
	}

	public function actionSettings() {
		#$this->layout = "//layouts/column2";
		$this->render('settings');
	}


	public function getModuleData() {
		$filesystem = P3AdminModule::findModules();
		$config = Yii::app()->modules;

		foreach($filesystem AS $module) {
			if (!isset($config[$module])) {
				$config[$module] = null;
			} else {
				#$config[$module]
			}
		}

		#var_dump($filesystem);
		#var_dump($config);

		return $config;
	}

}