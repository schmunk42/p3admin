<?php
$this->breadcrumbs = array(
	$this->module->id => array("/" . $this->module->id),
	'Manage Module '.$this->getModuleName()
);
?>
<h1>Manage Module '<?php echo CHtml::link($this->getModuleName(),array('/'.$this->getModuleName())); ?>'</h1>

<h2>Migration</h2>
<h3>Command</h3>
<p>
	<?php echo $command; ?>
</p>
<h3>Output</h3>
<pre id="output">
<?php echo $output; ?>
</pre>
<p>
	<?php
	if ($hasMigration) {
		echo CHtml::ajaxSubmitButton(
			'Migrate Up 1 Step',
			array('applyMigration', 'module' => $this->getModuleName()),
			array('update' => '#output'),
			array('onsubmit' => 'return confirm("Are you sure?")')
		);
	}
	?>

</p>


<h2>Configuration</h2>
<p>
	<?php echo $configuration ?>
</p>

<h2>Readme</h2>
<p>
	<?php echo $readme ?>
</p>

