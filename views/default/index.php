<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>

<h1>Application <small>Backend</small></h1>

<?php $this->widget('p3widgets.components.P3WidgetContainer', array('id' => 'backend', 'varyByRequestParam' => P3Page::PAGE_ID_KEY, 'checkAccess' => 'Admin')) ?>


