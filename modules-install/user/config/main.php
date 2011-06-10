<?php

return array(
	'import' => array(
		'application.modules.user.models.*',
	),
	'modules' => array(
		'user'
	),
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => array('/user/login'),
		),
		'db' => array(
			'tablePrefix' => 'tbl_'
		),
	),
)
?>
