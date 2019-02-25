<?php

return [
	'app' => [
		'url' => 'http:/localhost',
		'option' => [
			'cost' => 12,
		],
		'algo' => PASSWORD_BCRYPT,
	], 

	'db' => [
		'driver'=>'mysql',
		'host'=>'localhost',
		'name'=>'todobase',
		'username'=>'root',
		'password'=>'root',
		'charest'=>'utf8',
		'collation'=>'utf8_unicode_ci',
		'prefix'=>'',
	],
];