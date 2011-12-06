<?php

return array(
	'import' => array(
		'application.modules.rights.*',
		'application.modules.rights.components.*', // Correct paths if necessary.
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
			'userIdColumn' => 'id',
			'userClass' => 'User',
		#'install' => true, // Enables the installer.
		#'superuserName' => 'admin'
		),
	),
	)
?>
