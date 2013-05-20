<?php
/**
 * Class File
 * @author    Tobias Munk <schmunk@usrbin.de>
 * @link      http://www.phundament.com/
 * @copyright Copyright &copy; 2005-2010 diemeisterei GmbH
 * @license   http://www.phundament.com/license/
 */
/**
 * Description ...
 * Detailed info
 * <pre>
 * <?php
 *     $this->widget(
 *         'p3widgets.components.P3WidgetContainer',
 *         array(
 *             'id'=>'main',
 *             #'checkAccess'=>false //disables checkAccess feature
 *             )
 *     );
 * ?>
 * </pre>
 * {@link DefaultController}
 * @author  Tobias Munk <schmunk@usrbin.de>
 * @version $Id$
 * @package p3admin
 * @since   3.0
 */
class P3AdminModule extends CWebModule
{

    public $yiicCommand = "./yiic";

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
                              'p3admin.models.*',
                              'p3admin.components.*',
                         ));

        // register metadata component
        $metadata = Yii::createComponent(array('class' => 'vendor.phundament.p3admin.components.Metadata'));
        $this->setComponent('metadata', $metadata);
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            Yii::app()->controller->menu = array(
                array('label' => 'Show Settings', 'url' => array('settings')),
            );
            if (Yii::app()->getModule("p3admin")->params["install"]) {
                EUserFlash::setWarningMessage("P3AdminModule installation mode is active, access is NOT restricted!<br/>" .
                                              "Update P3AdminModule config, when you've finished the setup of the application." .
                                              "<pre>" .
                                              "'p3admin' => array(<br/>" .
                                              "	'params' => array('install' => false),<br/>" .
                                              "),</pre>", "install");
            }

            return true;
        }
        else {
            return false;
        }
    }

    public static function findModules()
    {

        $dir = Yii::app()->basePath;

        $return = array();
        if (is_dir($dir . DIRECTORY_SEPARATOR . "extensions")) {
            foreach (scandir($dir . DIRECTORY_SEPARATOR . "extensions") AS $module) {
                if ((($module != ".") && ($module != "..")) && (is_dir($dir . DIRECTORY_SEPARATOR . "modules" . DIRECTORY_SEPARATOR . $module) && strstr($module, ".") === false)) {
                    #Yii::import("application.modules." . $module . ".controllers.*");
                    $return[] = $module;
                }
            }
        }

        return $return;
    }

    public static function findApplicationControllers($sModuleAlias = false)
    {

        if (!$sModuleAlias) {
            //APP controliers
            $dir      = Yii::app()->basePath;
            $sScanDir = $dir . DIRECTORY_SEPARATOR . "controllers";
        }
        else {
            //Module controlliers
            $aModuleAlias = explode('.', $sModuleAlias);
            array_pop($aModuleAlias);
            $dir      = Yii::getPathOfAlias(implode('.', $aModuleAlias));
            $sScanDir = $dir . DIRECTORY_SEPARATOR . "controllers";
        }

        $return = array();
        foreach (scandir($dir . DIRECTORY_SEPARATOR . "controllers") AS $controller) {
            if (substr($controller, 0, 1) != "." && (is_file($dir . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . $controller))) {
                #Yii::import("application.modules." . $module . ".controllers.*");
                $return[] = str_replace('Controller.php', '', strtolower($controller[0]) . substr($controller, 1));
            }
        }

        return $return;
    }

}
