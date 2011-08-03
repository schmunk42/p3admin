<?php

return array(
	'modules' => array(
		'p3admin' => array(
			'class' => 'application.modules.p3admin.P3AdminModule',
			'params' =>
			array(
				'install' => true, // true disables access control(!!!)
			),			
		),
	),
)
?>
