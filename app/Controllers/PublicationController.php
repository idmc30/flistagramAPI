<?php

namespace App\Controllers;

use App\Includes\Helpers;
use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use  \GuzzleHttp\Psr7\LazyOpenStream;
use App\Models\Publication;
use App\Models\Photo;
use App\Models\Like;


class PublicationController extends BaseController
{

    /*
    |---------------------------------------------------------------------------------------------------
    | Create Publication
    |---------------------------------------------------------------------------------------------------
    */
    public function create(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );
        $body = $request->getParsedBody();

        $userLogged = $this->session->get('user');
        $description = trim($body['description']);
        $location = trim($body['location']);
        $base64Photo = trim($body['dataBase64Photo']);

        try {
            $new_name_file = Helpers::makeHash($userLogged->id_user, true) . '.jpg';
            $base64Photo = str_replace('data:image/jpeg;base64,', '', $base64Photo);
            $base64Photo = str_replace(' ', '+', $base64Photo);
            $data = base64_decode($base64Photo);
            $file = Helpers::get_path_user($userLogged->id_user, $new_name_file);
            $path = Helpers::get_path_user($userLogged->id_user);
            if (!file_exists($path)) {
                mkdir($path, 0700);
                chmod($path, 0777);
            }
            $success = file_put_contents($file, $data);
            $publication = new Publication();
            $publication->id_user = $userLogged->id_user;
            $publication->description = strip_tags($description);
            $publication->location = strip_tags($location);
            $publication->save();

            $photo = new Photo();
            $photo->path_photo = $new_name_file;
            $photo->id_publication = $publication->id_publication;
            $photo->public_path = "/api/v1/storage/pub/$publication->id_publication/image.jpg";
            $photo->save();
            /* Get data of publication*/
            $publication->user;
            $publication->photo;
            foreach ($publication->likes as $comment) {
                $comment->user;
            }
            foreach ($publication->comments as $comment) {
                $comment->user;
            }
            $myLike = Like::where([
                ['id_publication', '=', $publication->id_publication],
                ['id_user', '=', $userLogged->id_user],
            ])->first();

            $result['i_like_it'] = false;

            if ($myLike) {
                $result['i_like_it'] = $myLike->state == 1;
            }

            $result['status'] = true;
            $result['message'] = "Created successful";
            $result['publication'] = $publication;
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = "Error when creating Publication";
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 500);
        }
    }

    /*
    |---------------------------------------------------------------------------------------------------
    | Get image of storage
    |---------------------------------------------------------------------------------------------------
    */
    public function image(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        try {
            $publication = Publication::findOrFail($args['id_publication']);
            $new_name_file = $publication->photo->path_photo;
            $file = Helpers::get_path_user($publication->id_user, $new_name_file);
            $newStream = new LazyOpenStream($file, 'r');
            $reponse = $response->withBody($newStream);
            $reponse = $reponse->withHeader('Content-Type', 'image/jpg');
            $reponse = $reponse->withHeader('Content-Disposition', 'inline; filename="' . $new_name_file . '"');
            return $reponse;
        } catch (\Exception $ex) {
            $result['message'] = "Image not found";
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 500);
        }
    }

    /*
    |---------------------------------------------------------------------------------------------------
    | Get publicatio by Id
    |---------------------------------------------------------------------------------------------------
    */
    public function get_publication(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        /*
         * Datos de la publicacion
         * Photo
         * El usuario que hizo la publicación
         * */

        $id_publication = $args['id_publication'];
        $result = array(
            'status' => false,
            'message' => '',
        );

        $user_logged = $this->session->get('user');


        try {
            $publication = Publication::findOrFail($id_publication);
            $publication->user;
            $publication->photo;
            $i_like_it = false;

            foreach ($publication->likes as $like) {
                $user = $like->user;
                if ($user_logged->id_user == $user->id_user) {
                    $i_like_it = true;
                }
            }

            $publication->i_like_it = $i_like_it;

            foreach ($publication->comments as $comment) {
                $comment->user;
            }

            $myLike = Like::where([
                ['id_publication', '=', $publication->id_publication],
                ['id_user', '=', $user_logged->id_user],
            ])->first();

            $result['i_like_it'] = false;


            if ($myLike) {
                $result['i_like_it'] = true;
            }

            $result['item'] = $publication;
            $result['status'] = true;
            $result['message'] = "Found publication";
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = "Publication not found";
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 500);
        }
    }


    /*
    |---------------------------------------------------------------------------------------------------
    | Get time line for User (id_user)
    |---------------------------------------------------------------------------------------------------
    */

    public function timeline(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        /*
         * Datos de la publicacion
         * Photo
         * El usuario que hizo la publicación
         * */

        $result = array(
            'status' => false,
            'message' => '',
        );

        $user_logged = $this->session->get('user');

        try {
            $publications = Publication::all();

            foreach ($publications as $publication) {
                $publication->user;
                $publication->photo;
                foreach ($publication->comments as $comment) {
                    $comment->user;
                }

                $i_like_it = false;

                foreach ($publication->likes as $like) {
                    $user = $like->user;
                    if ($user_logged->id_user == $user->id_user) {
                        $i_like_it = true;
                    }
                }

                $publication->i_like_it = $i_like_it;
            }

            $result['item'] = $publications->toArray();
            $result['status'] = true;
            $result['message'] = "Found publication";
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = "Publication not found";
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 500);
        }
    }

}
