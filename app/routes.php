<?php
/*
|---------------------------------------------------------------------------------------------------
| Routes
|---------------------------------------------------------------------------------------------------
*/

$app->get('/image', 'PageController:home');

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

	$this->group('/publication', function () {
		$this->post('/create', 'PublicationController:create')->add(new AuthMiddleware());
		$this->get('/data/{idPublication}', 'PublicationController:get_publication');
	});

	$this->group('/comment', function () {
		$this->post('/pub/{idPublication}', 'CommentController:save_comment');
		$this->post('/delete/{idComment}', 'CommentController:delete_comment');
	})->add(new AuthMiddleware());

	$this->group('/like', function () {
		$this->post('/pub/{idPublication}/{state}', 'LikeController:set_like');
	})->add(new AuthMiddleware());

	$this->group('/static', function () {
		$this->get('/pub/{idPublication}/image.jpg', 'PublicationController:image');
	});
});