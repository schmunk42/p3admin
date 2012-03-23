<?php

return array(
	'import' => array(
		'ext.mishamx.user.models.*',
	),
	'modules' => array(
		'user' => array(
			'class' => 'ext.mishamx.user.UserModule',
			'activeAfterRegister' => false,
		),
	),
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => array('/user/login'),
		),
		'db' => array(
			'tablePrefix' => 'usr_'
		),
	),
)
?>
