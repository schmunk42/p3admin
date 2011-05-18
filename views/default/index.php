<?php
$this->breadcrumbs = array(
	$this->module->id,
);
?>
<h1>Phundament 3 Administration</h1>

<h2>Modules</h2>

<p>
	List of found modules
</p>

<table class="span-12 append-12 last">
	<?php foreach ($this->getModuleData() AS $name => $config): ?>
		<tr class="<?php echo ($config !== null) ? 'success' : 'error' ?>">
			<td>
			<?php echo CHtml::link($name, array('/' . $name)) ?>
		</td>
		<td>
			<?php echo ($config !== null) ? $config['class'] : '<em>Not configured yet</em>' ?>
		</td>
		<td>
			<?php echo CHtml::link('Manage', array('/p3admin/module', 'module' => $name)) ?>
		</td>
	</tr>
	<?php endforeach; ?>
		</table>
	