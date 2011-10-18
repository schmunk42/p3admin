<?php

return array(
	'modules' => array(
		'webshell' => array(
			'class' => 'ext.yiiext.modules.webshell.WebShellModule',
			// when typing 'exit', user will be redirected to this URL
			'exitUrl' => '/',
			// custom wterm options
			'wtermOptions' => array(
				// linux-like command prompt
				'PS1' => '%',
			),
			// additional commands (see below)
			'commands' => array(
				'test' => array('js:function(){return "Hello, world!";}', 'Just a test.'),
			),
			// uncomment to disable yiic
			// 'useYiic' => false,
			// adding custom yiic commands not from protected/commands dir
			/*'yiicCommandMap' => array(
				'email' => array(
					'class' => 'ext.mailer.MailerCommand',
					'from' => 'sam@rmcreative.ru',
				),
			),*/
		),
	),
)
?>
