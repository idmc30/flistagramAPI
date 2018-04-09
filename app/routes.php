<?php
/*
|---------------------------------------------------------------------------------------------------
| Routes
|---------------------------------------------------------------------------------------------------
*/

//Route groups
use App\Middlewares\AuthMiddleware;

$app->group('/api/v1', function () {
	/* Group Account*/
	$this->group('/account', function () {
		$this->post('/token', 'AuthController:token');
		$this->post('/create', 'UserController:store');
	});

	$this->group('/user', function () {
		$this->get('/all', 'UserController:all_users');
		/* Group*/
		$this->get('/data', 'UserController:user');
		$this->get('/data/{id}', 'UserController:user_id');

		$this->post('/data/update', 'UserController:update');
		$this->post('/data/update/password', 'UserController:update_password');
	})->add(new AuthMiddleware());

	$this->group('/user', function () {
	})->add(new AuthMiddleware());

});

