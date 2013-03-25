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
 * @package p3admin.controllers
 * @since   3.0
 */
class DefaultController extends Controller
{
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
            array('allow', // allow all users to perform 'index' and 'view' actions
                  'actions' => array('index'),
                  'roles'   => array('P3admin.Default.Index'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                  'actions' => array('settings'),
                  'roles'   => array('P3admin.Default.Settings')
            ),
            array('deny', // deny all users
                  'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSettings()
    {
        #$this->layout = "//layouts/column2";
        $this->render('settings');
    }


    public function getModuleData()
    {
        $filesystem = P3AdminModule::findModules();
        $config     = Yii::app()->modules;

        foreach ($filesystem AS $module) {
            if (!isset($config[$module])) {
                $config[$module] = null;
            }
            else {
                #$config[$module]
            }
        }

        #var_dump($filesystem);
        #var_dump($config);
        ksort($config);

        return $config;
    }

}