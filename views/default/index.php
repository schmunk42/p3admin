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
		<tr>
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
		<hr/>
		<div class="span-24 last">
			<h2>Current User</h2>
			<h3>Information</h3>
			<div class="span-4">
				<h4>Name</h4>
				<p><?php echo Yii::app()->user->name ?></p>
			</div>
			<div class="span-4">
				<h4>Id</h4>
				<p><?php echo Yii::app()->user->id ?></p>
			</div>
		</div>


		<div class="span-24">
			<h3>Assigned Auth Items</h3>

			<div class="span-8">
				<h4>Roles</h4>
				<p>
			<?php foreach (Yii::app()->authManager->getAuthItems(2, Yii::app()->user->id) AS $key => $value)
				echo $key . ", " ?>
			</p>
		</div>
		<div class="span-8">
			<h4>Operations</h4>
			<p><?php
				foreach (Yii::app()->authManager->getAuthItems(1, Yii::app()->user->id) AS $key => $value)
					echo $key . ", "
			?></p>
			</div>
			<div class="span-8 last">
				<h4>Tasks</h4>
				<p><?php
					foreach (Yii::app()->authManager->getAuthItems(0, Yii::app()->user->id) AS $key => $value)
						echo $key . ", "
			?></p>
				</div>


			</div>

			<hr/>

			<div class="span-18 last">
				<h2>Configuration</h2>

				<h3>
																				Parameters
				</h3>
				<p>
<?php
						echo CVarDumper::dumpAsString(Yii::app()->params, 10, true);
?></p>
					<h3>
																									Modules
					</h3>
					<p>
<?php
						echo CVarDumper::dumpAsString(Yii::app()->getModules(), 10, true);
?></p>
					<h3>
																									Components
					</h3>
					<p>
<?php
						echo CVarDumper::dumpAsString(Yii::app()->getComponents(), 10, true);
?></p>

</div>