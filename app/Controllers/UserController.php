<?php

namespace App\Controllers;

use App\Includes\Helpers;
use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use  \GuzzleHttp\Psr7\LazyOpenStream;

class UserController extends BaseController
{

    /*
    |---------------------------------------------------------------------------------------------------
    | All users
    |---------------------------------------------------------------------------------------------------
    */
    public function all_users(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'items' => array(),
            'message' => '',
        );

        $users = User::all();

        if (!empty($users)) {
            $result['status'] = true;
            $result['items'] = $users->toArray();
            $result['message'] = 'All users';
            return $response->withJson($result, 200);
        } else {
            $result['message'] = 'Users not found';
            return $response->withJson($result, 404);
        }
    }


    /*
    |---------------------------------------------------------------------------------------------------
    | User
    |---------------------------------------------------------------------------------------------------
    */
    public function user_id(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );
        try {
            $user = User::findOrFail($args['id']);
            $result['status'] = true;
            $result['item'] = $user->toArray();
            $result['message'] = 'User finding successful';
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = 'User not found';
            return $response->withJson($result, 404);
        }
    }

    /*
    |---------------------------------------------------------------------------------------------------
    | User
    |---------------------------------------------------------------------------------------------------
    */
    public function user(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );
        try {
            $userSession = $this->session->get('user');
            $user = User::findOrFail($userSession->id_user);
            $result['status'] = true;
            $result['item'] = $user->toArray();
            $result['message'] = 'User finding successful';
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = 'User not found';
            return $response->withJson($result, 404);
        }
    }


    /*
    |---------------------------------------------------------------------------------------------------
    | User Save
    |---------------------------------------------------------------------------------------------------
    */
    public function store(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        $body = $request->getParsedBody();
        $username = $body['username'];
        $name = $body['name'];
        $password = $body['password'];
        $email = $body['email'];

        if (trim($username) != '' && trim($name) != '' && trim($password) != '' && trim($email) != '') {
            try {
                /*Verificar si es un username valido*/
                $password = Helpers::makeHash($body['password']);
                $userExist = User::where('username', '=', $username)->first();
                if (!$userExist) {
                    $user = new User();
                    $user->username = $username;
                    $user->name = $name;
                    $user->password = $password;
                    $user->email = $email;
                    $user->save();
                    $result['status'] = true;
                    $result['item'] = $user->toArray();
                    $result['message'] = 'User created successful';
                    return $response->withJson($result, 200);
                } else {
                    $result['message'] = 'Field username is not unique';
                    return $response->withJson($result, 500);
                }
            } catch (\Exception $ex) {
                $result['message'] = 'Error when creating User';
                return $response->withJson($result, 500);
            }
        } else {
            $result['message'] = 'Please send correct data';
            return $response->withJson($result, 500);
        }
    }

    /*
    |---------------------------------------------------------------------------------------------------
    | User Update
    |---------------------------------------------------------------------------------------------------
    */
    public function update(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'item' => array(),
            'message' => '',
        );

        $body = $request->getParsedBody();
        $username = $body['username'];
        $name = $body['name'];
        $email = $body['email'];

        try {
            $userSession = $this->session->get('user');
            $userExist = User::where('username', '=', $username)->first();
            if (!$userExist) {
                $user = User::findOrFail($userSession->id_user);
                $user->username = $username;
                $user->name = $name;
                $user->email = $email;
                $user->save();
                $result['status'] = true;
                $result['item'] = $user->toArray();
                $result['message'] = 'User updated success';
                return $response->withJson($result, 200);
            } else {
                $result['message'] = 'Field username is not unique';
                return $response->withJson($result, 500);
            }
        } catch (\Exception $ex) {
            $result['message'] = 'Error updating User';
            return $response->withJson($result, 500);
        }
    }

    /*
    |---------------------------------------------------------------------------------------------------
    | User Update Password
    |---------------------------------------------------------------------------------------------------
    */
    public function update_password(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        $body = $request->getParsedBody();
        $last_password = $body['last_password'];
        $new_password_1 = $body['new_password_1'];
        $new_password_2 = $body['new_password_2'];
        if (trim($last_password) != "" && trim($new_password_1) != "" && trim($new_password_2) != '') {
            if ($new_password_1 == $new_password_2) {
                try {
                    $password = Helpers::makeHash($last_password);
                    $userSession = $this->session->get('user');
                    $user = User::where('id_user', '=', $userSession->id_user)->where('password', '=', $password)->first();
                    if ($user) {
                        $user->password = User::makePassword($new_password_1);
                        $user->save();
                        $result['status'] = true;
                        $result['message'] = 'Password updated success';
                        return $response->withJson($result, 200);
                    } else {
                        $result['message'] = 'The last password is not correct';
                        return $response->withJson($result, 500);
                    }
                } catch (\Exception $ex) {
                    $result['message'] = 'Error updating User';
                    $result['Ex'] = $ex->getMessage();
                    return $response->withJson($result, 500);
                }
            } else {
                $result['message'] = 'Passwords do not match';
                return $response->withJson($result, 500);
            }
        } else {
            $result['message'] = 'Please send correct data';
            return $response->withJson($result, 500);
        }
    }

    /*
    |---------------------------------------------------------------------------------------------------
    | User Profile by Username
    |---------------------------------------------------------------------------------------------------
    */

    public function user_profile(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        $username = trim($args['username']);

        if ($username != '') {
            try {
                $user = User::where('username', '=', $username)->firstOrFail();
                foreach ($user->publications as $publication) {
                    $publication->photo;
                    $publication->likes;
                }
                foreach ($user->followers as $user_follow) {
                    $user_follow->follower;
                }
                foreach ($user->followed as $user_followed) {
                    $user_followed->followed;
                }
                $result['status'] = true;
                $result['item'] = $user->toArray();
                $result['message'] = 'User finding successful';
                return $response->withJson($result, 200);
            } catch (\Exception $ex) {
                $result['message'] = 'User not found';
                $result['ex'] = $ex->getMessage();
                return $response->withJson($result, 404);
            }
        } else {
            $result['message'] = 'Please send username field.';
            return $response->withJson($result, 404);
        }
    }

    /*
     * My profile
     * */

    public function my_profile(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );
        $userSession = $this->session->get('user');
        try {
            $user = User::findOrFail($userSession->id_user);
            foreach ($user->publications as $publication) {
                $publication->photo;
                $publication->likes;
            }
            foreach ($user->followers as $user_follow) {
                $user_follow->follower;
            }
            foreach ($user->followed as $user_followed) {
                $user_followed->followed;
            }
            $result['status'] = true;
            $result['item'] = $user->toArray();
            $result['message'] = 'User finding successful';
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = 'User not found';
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 404);
        }
    }


    /*
     |---------------------------------------------------------------------------------------------------
     | Find users
     |---------------------------------------------------------------------------------------------------
     */
    public function find_users(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        $body = $request->getParsedBody();
        $text = trim($body['text']);

        if ($text != '') {
            try {
                $userSession = $this->session->get('user');
                $users = User::where('name', 'LIKE', "%$text%")
                    ->orWhere('username', 'LIKE', "%$text%")->get();
                $result['status'] = true;
                $result['item'] = $users->toArray();
                $result['count'] = count($users->toArray());
                $result['message'] = 'Found users';
                return $response->withJson($result, 200);
            } catch (\Exception $ex) {
                $result['message'] = 'Users not found';
                return $response->withJson($result, 500);
            }
        } else {
            $result['message'] = 'Please send text field.';
            return $response->withJson($result, 404);
        }
    }

    /*
    |---------------------------------------------------------------------------------------------------
    | Upload photo profile
    |---------------------------------------------------------------------------------------------------
    */
    public function upload_photo_profile(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        $body = $request->getParsedBody();
        $userLogged = $this->session->get('user');
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

            $user = User::findOrFail($userLogged->id_user);
            $user->name_file_photo = $new_name_file;
            $user->path_photo = "/api/v1/storage/u/$userLogged->username/profile.jpg";
            $user->save();

            $result['status'] = true;
            $result['message'] = "Photo profile created successful";
            $result['publication'] = $user;
            return $response->withJson($result, 200);
        } catch (\Exception $ex) {
            $result['message'] = "Error when creating Photo profile";
            $result['ex'] = $ex->getMessage();
            return $response->withJson($result, 500);
        }
    }

    public function get_profile_image(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $result = array(
            'status' => false,
            'message' => '',
        );

        try {
            $user = User::where('username', '=', $args['username'])->firstOrFail();
            $new_name_file = $user->name_file_photo;
            $file = Helpers::get_path_user($user->id_user, $new_name_file);

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

}
