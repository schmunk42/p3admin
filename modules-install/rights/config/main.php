<?php

return array(
	'import' => array(
		'ext.crisu83.yii-rights.*',
		'ext.crisu83.yii-rights.components.*', // Correct paths if necessary.
	),
	'components' => array(
		'user' => array(
			'class' => 'RWebUser', // Allows super users access implicitly.
		),
		'authManager' => array(
			'class' => 'RDbAuthManager', // Provides support authorization item sorting.
			'defaultRoles' => array('Authenticated', 'Guest'), // see correspoing business rules, note: superusers always get checkAcess == true
		),
	),
	'modules' => array(
		
		'rights' => array(
			'class' => 'ext.crisu83.yii-rights.RightsModule',
			'userIdColumn' => 'id',
			'userClass' => 'User',
		#'install' => true, // Enables the installer.
		#'superuserName' => 'admin'
		),
	),
	)
?>
