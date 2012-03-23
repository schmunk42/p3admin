<?php

return array(
	'import' => array(
		'ext.mishamx.yii-user.user.models.*',
	),
	'modules' => array(
		'user' => array(
			'class' => 'ext.mishamx.yii-user.user.UserModule',
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
