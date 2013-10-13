<div id="p3admin-settings-view">
    <?php
    $this->breadcrumbs = array(
        $this->module->id,
    );
    ?>

    <?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>

    <h1>
        <?php echo Yii::t('P3AdminModule.module', 'Application'); ?>
        <small><?php echo Yii::t('P3AdminModule.module', 'Overview'); ?></small>
    </h1>

    <?php $this->beginClip('modules') ?>
    <ul class="thumbnails">
        <?php foreach ($this->getModuleData() AS $name => $config): ?>
            <li class="span4">
                <div class="thumbnail">
                    <h3><?php echo CHtml::link($name, array('/' . $name)) ?></h3>
                    <small><?php echo ($config !== null) ? str_replace(".", "<wbr>.", $config['class']) :
                            '<em>Not configured yet</em>' ?></small>
                </div>
            </li>
        <?php endforeach; ?>
        </table>
    </ul>
    <?php $this->endClip() ?>


    <?php $this->beginClip('controllers') ?>
    <h3>App</h3>
    <ul>
        <?php foreach ($this->module->findApplicationControllers() AS $name): ?>
            <li><?php echo CHtml::link($name, array('/' . $name)) ?></li>
        <?php endforeach; ?>
    </ul>

    <?php foreach ($this->getModuleData() AS $name => $config): ?>
        <h3><?php echo CHtml::link($name, array('/' . $name)) ?></h3>
        <ul>
            <?php foreach ($this->module->findApplicationControllers($config['class']) AS $controller_name): ?>
                <li><?php echo CHtml::link($controller_name, array('/' . $name . '/' . $controller_name,)) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    <?php $this->endClip() ?>

    <?php $this->beginClip('__pkg') ?>
    <div class="span6">
        <h3>Standard Packages</h3>
        <ul>
            <?php
            $json = CJSON::decode(
                file_get_contents(Yii::getPathOfAlias('root') . DIRECTORY_SEPARATOR . 'composer.lock')
            );
            if (isset($json['packages'])) {
                foreach ($json['packages'] AS $package) {
                    echo "<li><span class=''>" . CHtml::link(
                            $package['name'],
                            (isset($package['homepage'])) ?
                                $package['homepage'] : ''
                        ) . "</span> <span class='label'>" . $package['version'] . "</span> <small>" . $package['source']['reference'] . "</small></li>";
                }
            };
            ?>
        </ul>
    </div>
    <div class="span6">
        <h3>Dev Packages</h3>
        <ul>
            <?php
            $json = CJSON::decode(
                file_get_contents(Yii::getPathOfAlias('root') . DIRECTORY_SEPARATOR . 'composer.lock')
            );
            if (isset($json['packages-dev'])) {
                foreach ($json['packages-dev'] AS $package) {
                    echo "<li><span class=''>" . CHtml::link(
                            $package['name'],
                            (isset($package['homepage'])) ?
                                $package['homepage'] : ''
                        ) . "</span> <span class='label'>" . $package['version'] . "</span> <small>" . $package['source']['reference'] . "</small></li>";
                }
            };
            ?>
        </ul>
    </div>
    <?php $this->endClip() ?>


    <?php $this->beginClip('__set') ?>
    <h3><?php echo Yii::t('P3AdminModule.module', 'Language'); ?></h3>

    <p>
        <?php echo Yii::app()->language ?>
    </p>
    <?php $this->endClip() ?>


    <?php
    $this->widget(
        'bootstrap.widgets.TbTabs',
        array(
             'type'      => 'tabs',
             'placement' => 'above', // 'above', 'right', 'below' or 'left'
             'tabs'      => array(
                 array(
                     'label'   => Yii::t('P3AdminModule.module', 'Modules'),
                     'content' => $this->clips['modules'],
                     'active'  => true
                 ),
                 array(
                     'label'   => Yii::t('P3AdminModule.module', 'Controllers'),
                     'content' => $this->clips['controllers']
                 ),
                 array(
                     'label'   => Yii::t('P3AdminModule.module', 'Packages'),
                     'content' => $this->clips['__pkg']
                 ),
                 array(
                     'label'   => Yii::t('P3AdminModule.module', 'User'),
                     'content' => $this->renderPartial('_user', array(), true)
                 ),
                 array(
                     'label'   => Yii::t('P3AdminModule.module', 'Configuration'),
                     'content' => $this->renderPartial('_config', array(), true),
                 ),
                 array(
                     'label'   => Yii::t('P3AdminModule.module', 'Settings'),
                     'content' => $this->clips['__set'],
                 ),
                 array(
                     'label'   => Yii::t('P3AdminModule.module', 'Log'),
                     'content' => $this->renderPartial('_log', array(), true)
                 ),

             )
        )
    );
    ?>
</div>