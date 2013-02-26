<?php
/**
 * Metadata Helps to get metadata about models,controllers and actions in application*
 *
 * For using you need:
 * 1. Place this file to directory with components of your application (your_app_dir/protected/components)
 * 2. Add it to 'components' in your application config (your_app_dir/protected/config/main.php)
 * 'components'=>array(
 *   'metadata'=>array('class'=>'Metadata'),
 *    ...
 *  ),
 * 3. Use:
 *   $user_actions = Yii::app()->metadata->getActions('UserController');
 *   var_dump($user_actions);
 *
 * @author Vitaliy Stepanenko <mail@vitaliy.in>
 * @version 0.2
 * @license BSD
 * @link http://www.yiiframework.com/extension/metadata/
 */

class Metadata extends CApplicationComponent
{

    /**
     * Get all information about application
     * if modules of your application have controllers with same name, it will raise fatall error
     *
     */
    public function getAll()
    {

        $meta = array(
            'models' => $this->getModels(),
            'controllers' => $this->getControllers(),
            'modules' => $this->getModules(),
        );
        foreach ($meta['controllers'] as &$controller) {
            $controller = array(
                'name' => $controller,
                'actions' => $this->getActions($controller)
            );
        }

        foreach ($meta['modules'] as &$module) {

            $controllers = $this->getControllers($module);

            foreach ($controllers as &$controller) {
                $controller = array(
                    'name' => $controller,
                    'actions' => $this->getActions($controller, $module)
                );
            }


            $module = array(
                'name' => $module,
                'controllers' => $controllers,
                'models' => $this->getModels($module),
            );

        }

        return $meta;

    }

    /**
     * Get actions of controller
     *
     * @param mixed $controller
     * @param mixed $module
     * @return mixed
     */
    public function getActions($controller, $module = null)
    {
        if ($module != null) {
            $path = join(DIRECTORY_SEPARATOR, array(Yii::app()->getModule($module)->basePath, 'controllers'));
            $this->setModuleIncludePaths($module);
        }
        else {
            $path = Yii::getPathOfAlias('application.controllers');
        }

        $actions = array();
        $file = fopen($path . DIRECTORY_SEPARATOR . $controller . '.php', 'r');
        $lineNumber = 0;
        while (feof($file) === false) {
            ++$lineNumber;
            $line = fgets($file);
            preg_match('/public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/', $line, $matches);
            if ($matches !== array()) {
                $name = $matches[1];
                $actions[] = $matches[1];
            }
        }

        return $actions;

    }

    /**
     * Set php include paths for module
     *
     * @param mixed $module
     */
    private function setModuleIncludePaths($module)
    {
        set_include_path(join(PATH_SEPARATOR, array(
                                                   get_include_path(),
                                                   //join(DIRECTORY_SEPARATOR,array(Yii::app()->modulePath,$module,'controllers')),
                                                   join(DIRECTORY_SEPARATOR, array(Yii::app()->modulePath, $module,
                                                                                   'components')),
                                                   join(DIRECTORY_SEPARATOR, array(Yii::app()->modulePath, $module,
                                                                                   'models')),
                                                   join(DIRECTORY_SEPARATOR, array(Yii::app()->modulePath, $module,
                                                                                   'vendors')),
                                              )));
    }

    /**
     * Get list of controllers with actions
     *
     * @param mixed $module
     * @return array
     */
    function getControllersActions($module = null)
    {
        $c = $this->getControllers($module);
        foreach ($c as &$controller) {
            $controller = array(
                'name' => $controller,
                'actions' => $this->getActions($controller, $module)
            );
        }
        return $c;
    }

    /**
     * Scans controller directory & return array of MVC controllers
     *
     * @param mixed $module
     * @param mixed $include_classes
     * @return array
     */
    public function getControllers($module = null)
    {

        if ($module != null) {
            $path = join(DIRECTORY_SEPARATOR, array(Yii::app()->getModule($module)->basePath, 'controllers'));
        }
        else {
            $path = Yii::getPathOfAlias('application.controllers');
        }
        $controllers = array_filter(scandir($path), array($this, 'isController'));
        foreach ($controllers as &$c) {
            $c = str_ireplace('.php', '', $c);
        }
        return $controllers;
    }

    /**
     * Scans models directory & return array of MVC models
     *
     * @param mixed $module
     * @param mixed $include_classes
     * @return array
     */
    public function getModels($module = null, $include_classes = false)
    {

        if ($module != null) {
            $path = join(DIRECTORY_SEPARATOR, array(Yii::app()->getModule($module)->basePath, 'models'));
        }
        else {
            $path = Yii::getPathOfAlias('application.models');
        }

        $models = array();
        if (is_dir($path)) {
            $files = scandir($path);
            foreach ($files as $f) {
                if (stripos($f, '.php') !== false) {
                    $models[] = str_ireplace('.php', '', $f);
                    if ($include_classes) {
                        include_once($path . DIRECTORY_SEPARATOR . $f);
                    }

                }
            }
        }
        return $models;

    }

    /**
     * Used in getModules() to filter array of files & directories
     *
     * @param mixed $a
     */
    private function isController($a)
    {
        return stripos($a, 'Controller.php') !== false;
    }


    /**
     * Returns array of module names
     *
     */
    public function getModules()
    {
        return array_keys(Yii::app()->modules);
    }

    /**
     * Used in getModules() to filter array of files & directories
     *
     * @param mixed $a
     */
    private function isModule($a)
    {
        return $a != '.' and $a != '..' and is_dir(Yii::app()->modulePath . DIRECTORY_SEPARATOR . $a);
    }

}
