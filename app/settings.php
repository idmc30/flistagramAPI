<?php
return array(
    'app' => array(
        //Public dir, default = public
        'public_dir' => 'public',

        //Add your settings
        'new-key' => 'new-value',

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
