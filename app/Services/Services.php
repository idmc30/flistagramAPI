<?php
/*
|---------------------------------------------------------------------------------------------------
| Services
|---------------------------------------------------------------------------------------------------
*/
$container['functions'] = function ($container) {
    return new Slimer\Functions\SlimerFunctions();
};

//How to use
// $functions = $app->getContainer()->get( 'functions' );
// $random = $functions::random_string( 5, 'numbers' );
// d($random);


/*
|---------------------------------------------------------------------------------------------------
| DB using Eloquent
|---------------------------------------------------------------------------------------------------
*/
$container['db'] = function ($container) {
    $capsule = $container->get('eloquent');
    if (!$capsule) {
        return null;
    }
    $settings = $container->get('settings');
    $connections = $settings['app']['connections'];
//
    //Add connections
    $capsule->addConnection($connections['mysql']);
    //$capsule->addConnection( $connections['pgsql'] );//PostgreSQL
    //$capsule->addConnection( $connections['sqlsrv'] );//SQL Server
    //$capsule->addConnection( $connections['sqlite'] );//SQLite
//
    return $capsule;
};


//Override the default Not Found Handler
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(
                [
                    'status' => false,
                    'message' => 'Url not found'
                ]
            ));
    };
};
