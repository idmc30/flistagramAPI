<?php

namespace App\Controllers;

use App\Models\Follow;
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

        try {
            $id_to_follow = $args['idToFollow'];
            $userLogged = $this->session->get('user');
            $user = User::findOrFail($id_to_follow);

            $comment = new Follow();
            $comment->idFollowe = $userLogged->idUser;
            $comment->idToFollow = $id_to_follow;
            $comment->save();

            $result['item'] = $comment;
            $result['message'] = "Saved follow";
            $result['status'] = true;
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = "The follow was not saved";
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 500);
        }
    }


    public function delete_follow(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );
        try {
            $id_to_follow = $args['idToFollow'];
            $userLogged = $this->session->get('user');
            $follow = Follow::where([
                ['idToFollow', '=', $id_to_follow],
                ['idFollower', '=', $userLogged->idUser]
            ])->firstOrFail();
            $follow->delete($follow->idFollow);
            $result['status'] = true;
            $result['message'] = "Deleted follow";
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = "Follow was not deleted";
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 500);
        }
    }
}
