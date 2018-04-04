<?php

namespace App\Controllers;

use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends BaseController
{

	/*
|---------------------------------------------------------------------------------------------------
| All users
|---------------------------------------------------------------------------------------------------
*/
	public function all_users ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'items' => array(),
			'message' => '',
		);

		$users = User::all();

		if ( !empty($users) ) {
			$result[ 'status' ] = true;
			$result[ 'items' ] = $users->toArray();
			return $response->withJson($result, 200);
		} else {
			$result[ 'message' ] = 'Users not found';
			return $response->withJson($result, 404);
		}
	}


	/*
	|---------------------------------------------------------------------------------------------------
	| User
	|---------------------------------------------------------------------------------------------------
	*/
	public function user ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'item' => array(),
			'message' => '',
		);

		$user = User::find($args[ 'id' ]);

		if ( !empty($user) ) {
			$result[ 'status' ] = true;
			$result[ 'item' ] = $user->toArray();
			return $response->withJson($result, 200);
		} else {
			$result[ 'message' ] = 'User not found';
			return $response->withJson($result, 404);
		}
	}


	/*
	|---------------------------------------------------------------------------------------------------
	| User
	|---------------------------------------------------------------------------------------------------
	*/
	public function store ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'item' => array(),
			'message' => '',
		);
		$body = $request->getParsedBody();
		$username = $body[ 'username' ];
		$name = $body[ 'name' ];
		$password = hash('sha256', $body[ 'password' ]);
		$email = $body[ 'email' ];
		if ( trim($username) != '' && trim($name) != '' && trim($password) != '' && trim($email) != '' ) {
			try {
				$user = new User();
				$user->username = $username;
				$user->name = $name;
				$user->password = $password;
				$user->email = $email;
				$user->save();
				$result[ 'status' ] = true;
				$result[ 'message' ] = 'Usuario creado';
				$result[ 'item' ] = $user->toArray();
				return $response->withJson($result, 200);
			} catch ( \Exception $ex ) {
				$result[ 'message' ] = 'Error al crear usuario';
				return $response->withJson($result, 500);
			}
		} else {
			$result[ 'message' ] = 'Por favor, envie los campos requeridos.';
			return $response->withJson($result, 500);
		}
	}

}
