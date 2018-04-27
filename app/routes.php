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
        $this->post('/token', 'AuthController:token');//*
        $this->post('/create', 'UserController:store');//*
    });

    /* Routes for User */
    $this->group('/user', function () {
        $this->get('/all', 'UserController:all_users');
        /* Group*/
        $this->get('/profile/{username}', 'UserController:user_profile')->add(new AuthMiddleware());//*
        $this->get('/profile', 'UserController:my_profile')->add(new AuthMiddleware());//*
        $this->post('/profile/photo', 'UserController:upload_photo_profile')->add(new AuthMiddleware());//*
      /*  $this->get('/data/{id}', 'UserController:user_id');*/

        $this->get('/data', 'UserController:user')->add(new AuthMiddleware());//*
        $this->post('/data/update', 'UserController:update')->add(new AuthMiddleware());//*
        $this->post('/data/update/password', 'UserController:update_password')->add(new AuthMiddleware());//*

        $this->get('/find/{text}', 'UserController:find_users');
    });

    /* Routes for Publication */
    $this->group('/publication', function () {
        $this->post('/create', 'PublicationController:create')->add(new AuthMiddleware());//*
        $this->get('/data/{id_publication}', 'PublicationController:get_publication')->add(new AuthMiddleware());//*
        $this->get('/timeline', 'PublicationController:timeline')->add(new AuthMiddleware());
    });

    /* Routes for Comments */
    $this->group('/comment', function () {
        $this->post('/pub/{id_publication}', 'CommentController:save_comment');//*
        //$this->post('/delete/{id_comment}', 'CommentController:delete_comment');
    })->add(new AuthMiddleware());

    /* Routes for Likes */
    $this->post('/like/pub/{id_publication}/{state}', 'LikeController:set_like')->add(new AuthMiddleware());//*


    /* Routes for Follow */
    $this->group('/follow', function () {
        $this->post('/add/{id_to_follow}', 'FollowController:save_follow');
        $this->post('/remove/{id_to_follow}', 'FollowController:delete_follow');
    })->add(new AuthMiddleware());


    /* Routes for Storage */
    $this->group('/storage', function () {
        $this->get('/pub/{id_publication}/image.jpg', 'PublicationController:image');//*
        $this->get('/u/{id_user}/profile.jpg', 'UserController:get_profile_image');//*
    });
});