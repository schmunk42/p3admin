<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>

<h1>Application <small>Settings</small></h1>

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
<ul>
    <?php foreach ($this->module->findApplicationControllers() AS $name): ?>
    <li><?php echo CHtml::link($name, array('/' . $name)) ?></li>
    <?php endforeach; ?>
</ul>
<?php $this->endClip() ?>


<?php $this->beginClip('__md') ?>
disabled
<?php
// TODO: disabled - incompatiblity with Yii 1.1.13(?) - Yii::app()->user == 'Guest' ?!
#$metadata = Yii::app()->getModule('p3admin')->metadata->getAll();
#var_dump($metadata);
?>
<?php $this->endClip() ?>

<?php $this->beginClip('__pkg') ?>
<ul>
    <?php
    $json = CJSON::decode(file_get_contents(Yii::getPathOfAlias('root') . DIRECTORY_SEPARATOR . 'composer.lock'));
    if (isset($json['packages'])) foreach ($json['packages'] AS $package) {
        echo "<li><span class=''>" . CHtml::link($package['name'], (isset($package['homepage']))?$package['homepage']:'') . "</span> <span class='label'>" . $package['version'] . "</span></li>";
    };
    ?>
</ul>
<h3>Dev Packages</h3>
<ul>
    <?php
    $json = CJSON::decode(file_get_contents(Yii::getPathOfAlias('root') . DIRECTORY_SEPARATOR . 'composer.lock'));
    if (isset($json['packages-dev'])) foreach ($json['packages-dev'] AS $package) {
        echo "<li><span class=''>" . CHtml::link($package['name'], (isset($package['homepage']))?$package['homepage']:'') . "</span> <span class='label'>" . $package['version'] . "</span></li>";
    };
    ?>
</ul>

<?php $this->endClip() ?>


<?php $this->beginClip('__set') ?>
<h3>Language</h3>
<p>
    <?php echo Yii::app()->language ?>
</p>
<?php $this->endClip() ?>


<?php
$this->widget('bootstrap.widgets.TbTabs',
              array(
                   'type' => 'tabs',
                   'placement' => 'above', // 'above', 'right', 'below' or 'left'
                   'tabs' => array(
                       array('label' => 'Modules',
                             'content' => $this->clips['modules'],
                             'active' => true),
                       array('label' => 'Controllers',
                             'content' => $this->clips['controllers']),
                       array('label' => 'Packages',
                             'content' => $this->clips['__pkg']),
                       array('label' => 'User',
                             'content' => $this->renderPartial('_user', array(), true)),
                       array('label' => 'Configuration',
                             'content' => $this->renderPartial('_config', array(), true),
                       ),
                       array('label' => 'Settings',
                             'content' => $this->clips['__set'],
                       ),
                       array('label' => 'Models',
                             'content' => $this->clips['__md']),

                   )
              )
);
?>



