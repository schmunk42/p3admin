<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>

<h1>Application</h1>

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
<?php
$metadata = Yii::app()->getModule('p3admin')->metadata->getAll();
var_dump($metadata);
?>
<?php $this->endClip() ?>

<?php $this->beginClip('__pkg') ?>
<ul>
    <?php
    $json = CJSON::decode(file_get_contents(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'composer.lock'));
    foreach ($json['packages'] AS $package) {
        echo "<li><span class='label'>" . $package['name'] . "</span><span class='label label-inverse'>" . $package['version'] . "</span></li>";
    };
    ?>
</ul>
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
                       array('label' => 'User',
                             'content' => $this->renderPartial('_user', array(), true)),
                       array('label' => 'Configuration',
                             'content' => $this->renderPartial('_config', array(), true),
                       ),
                       array('label' => 'Packages',
                             'content' => $this->clips['__pkg']),
                       array('label' => 'Models',
                             'content' => $this->clips['__md']),

                   )
              )
);
?>



