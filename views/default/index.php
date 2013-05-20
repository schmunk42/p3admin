<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>

<h1><?php echo Yii::t('P3AdminModule.crud', 'Application'); ?>
    <small><?php echo Yii::t('P3AdminModule.crud', 'Backend'); ?></small>
</h1>

<?php $this->widget('p3widgets.components.P3WidgetContainer', array('id'                 => 'backend',
                                                                    'varyByRequestParam' => P3Page::PAGE_ID_KEY,
                                                                    'checkAccess'        => 'Admin')) ?>


