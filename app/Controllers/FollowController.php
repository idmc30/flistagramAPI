<?php

namespace App\Controllers;

use App\Models\Follow;
use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class FollowController extends BaseController
{

    /*
    |---------------------------------------------------------------------------------------------------
    | Home
    |---------------------------------------------------------------------------------------------------
    */
    public function save_follow(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        $id_to_follow = $args['id_to_follow'];


        if ($id_to_follow != '') {
            try {
                $user_logged = $this->session->get('user');
                $user = User::findOrFail($id_to_follow);
                $follow = new Follow();
                $follow->id_follower = $user_logged->id_user;
                $follow->id_to_follow = $id_to_follow;
                $follow->save();
                $result['message'] = "Saved follow";
                $result['status'] = true;
                return $response->withJson($result, 200);
            } catch (\Exception $ex) {
                $result['message'] = "The follow was not saved";
                $result['ex'] = $ex->getMessage();
                return $response->withJson($result, 500);
            }
        } else {
            $result['message'] = 'Please send id to follow field.';
            return $response->withJson($result, 404);
        }
    }


    public function delete_follow(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );
        $id_to_follow = $args['id_to_follow'];
        if ($id_to_follow != '') {
            try {
                $id_to_follow = $args['id_to_follow'];
                $userLogged = $this->session->get('user');
                $follow = Follow::where([
                    ['id_to_follow', '=', $id_to_follow],
                    ['id_follower', '=', $userLogged->id_user]
                ])->firstOrFail();
                $follow->delete($follow->id_connection);
                $result['status'] = true;
                $result['message'] = "Deleted follow";
                return $response->withJson($result, 200);
            } catch (\Exception $ex) {
                $result['message'] = "Follow was not deleted";
                $result['ex'] = $ex->getMessage();
                return $response->withJson($result, 500);
            }
        } else {
            $result['message'] = 'Please send id to follow field.';
            return $response->withJson($result, 404);
        }
    }
}
