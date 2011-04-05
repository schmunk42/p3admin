<?php

class DefaultController extends Controller {
	
	public function actionIndex() {
		$modules = P3AdminModule::findModules();
		foreach ($modules as $module) {
			$moduleItems[] = array(
				'label' => $module,
					'url' => array('/p3admin/module','module'=>$module)
			);
		}

		$this->menu = array(
			array(
				'label' => 'Application',
				'items' => array(
					array(
						'label' => 'Home',
						'url' => array('/')
					),
				),
			),
			array(
				'label' => 'Modules',
				'items' => $moduleItems
			),
		);
		$this->layout = "//layouts/column2";
		$this->render('index');
	}


}