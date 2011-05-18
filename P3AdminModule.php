<?php

class P3AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'p3admin.models.*',
			'p3admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
Yii::app()->controller->menu=array(
	array('label'=>'Show Settings', 'url'=>array('settings')),
);
			return true;
		}
		else
			return false;
	}

    public static function findModules() {

		$dir = Yii::app()->basePath;

        foreach (scandir($dir . DIRECTORY_SEPARATOR . "modules") AS $module) {
            if ((($module != ".") && ($module != "..")) && (is_dir($dir . DIRECTORY_SEPARATOR . "modules" . DIRECTORY_SEPARATOR . $module) && strstr($module, ".") === false)) {
                #Yii::import("application.modules." . $module . ".controllers.*");
                $return[] = $module;
            }
        }
        return $return;
    }

}
