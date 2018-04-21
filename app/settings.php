<?php
return array(
	'app' => array(
		//Public dir, default = public
		'public_dir' => 'public',

		//Add your settings
		'new-key' => 'new-value',

		'key_jtw' => 'flisolAbril2018',

		'data_jwt' => [
			'iat' => time(),         // Issued at: time when the token was generated
			'jti' => 'flisolAbril2018',          // Json Token Id: an unique identifier for the token
			'iss' => 'http://localhost/flistagramApi/',       // Issuer
			'nbf' => time() + 0,        // Not before
			'exp' => time() + ( 43800 * 60 ),           // Expire un mes
			'data' => [                  // Data related to the signer user
			]
		],
		//Connections
		'connections' => array(
			'mysql' => array(
				'driver' => 'mysql',
				'host' => 'localhost',
				'database' => 'flistagram',
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix' => '',
			)
		),
	)
);
