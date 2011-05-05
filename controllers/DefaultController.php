<?php

class DefaultController extends Controller {
	
	public function actionIndex() {
		#$this->layout = "//layouts/column2";
		$this->render('index');
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