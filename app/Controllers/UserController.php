<?php

namespace App\Controllers;

use App\Includes\Helpers;
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
			$result[ 'message' ] = 'All users';
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
	public function user_id ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);
		try {
			$user = User::findOrFail($args[ 'id' ]);
			$result[ 'status' ] = true;
			$result[ 'item' ] = $user->toArray();
			$result[ 'message' ] = 'User finding successful';
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'User not found';
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
			'message' => '',
		);
		try {
			$userSession = $this->session->get('user');
			$user = User::findOrFail($userSession->idUser);
			$result[ 'status' ] = true;
			$result[ 'item' ] = $user->toArray();
			$result[ 'message' ] = 'User finding successful';
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'User not found';
			return $response->withJson($result, 404);
		}
	}


	/*
	|---------------------------------------------------------------------------------------------------
	| User Save
	|---------------------------------------------------------------------------------------------------
	*/
	public function store ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);

		$body = $request->getParsedBody();
		$username = $body[ 'username' ];
		$name = $body[ 'name' ];
		$password = $body[ 'password' ];
		$email = $body[ 'email' ];

		if ( trim($username) != '' && trim($name) != '' && trim($password) != '' && trim($email) != '' ) {
			try {
				/*Verificar si es un username valido*/
				$password = Helpers::makeHash($body[ 'password' ]);
				$userExist = User::where('username', '=', $username)->first();
				if ( !$userExist ) {
					$user = new User();
					$user->username = $username;
					$user->name = $name;
					$user->password = $password;
					$user->email = $email;
					$user->save();
					$result[ 'status' ] = true;
					$result[ 'item' ] = $user->toArray();
					$result[ 'message' ] = 'User created successful';
					return $response->withJson($result, 200);
				} else {
					$result[ 'message' ] = 'Field username is not unique';
					return $response->withJson($result, 500);
				}
			} catch ( \Exception $ex ) {
				$result[ 'message' ] = 'Error when creating User';
				return $response->withJson($result, 500);
			}
		} else {
			$result[ 'message' ] = 'Please send correct data';
			return $response->withJson($result, 500);
		}
	}

	/*
	|---------------------------------------------------------------------------------------------------
	| User Update
	|---------------------------------------------------------------------------------------------------
	*/
	public function update ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'item' => array(),
			'message' => '',
		);

		$body = $request->getParsedBody();
		$username = $body[ 'username' ];
		$name = $body[ 'name' ];
		$email = $body[ 'email' ];

		try {
			$userSession = $this->session->get('user');
			$user = User::findOrFail($userSession->idUser);
			$user->username = $username;
			$user->name = $name;
			$user->email = $email;
			$user->save();
			$result[ 'status' ] = true;
			$result[ 'item' ] = $user->toArray();
			$result[ 'message' ] = 'User updated success';
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'Error updating User';
			return $response->withJson($result, 500);
		}
	}

	/*
			|---------------------------------------------------------------------------------------------------
			| User Update Password
			|---------------------------------------------------------------------------------------------------
			*/
	public function update_password ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);

		$body = $request->getParsedBody();
		$last_password = $body[ 'last_password' ];
		$new_password_1 = $body[ 'new_password_1' ];
		$new_password_2 = $body[ 'new_password_2' ];
		if ( trim($last_password) != "" && trim($new_password_1) != "" && trim($new_password_2) != '' ) {
			if ( $new_password_1 == $new_password_2 ) {
				try {
					$password = Helpers::makeHash($last_password);
					$userSession = $this->session->get('user');
					$user = User::where('idUser', '=', $userSession->idUser)->where('password', '=', $password)->first();
					if ( $user ) {
						$user->password = User::makePassword($new_password_1);
						$user->save();
						$result[ 'status' ] = true;
						$result[ 'message' ] = 'Password updated success';
						return $response->withJson($result, 200);
					} else {
						$result[ 'message' ] = 'The last password is not correct';
						return $response->withJson($result, 500);
					}
				} catch ( \Exception $ex ) {
					$result[ 'message' ] = 'Error updating User';
					$result[ 'Ex' ] = $ex->getMessage();
					return $response->withJson($result, 500);
				}
			} else {
				$result[ 'message' ] = 'Passwords do not match';
				return $response->withJson($result, 500);
			}
		} else {
			$result[ 'message' ] = 'Please send correct data';
			return $response->withJson($result, 500);
		}
	}

	/*
			|---------------------------------------------------------------------------------------------------
			| User Upload profile image
			|---------------------------------------------------------------------------------------------------
			*/

	public function create_photo_profile ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);
		try {
			$userSession = $this->session->get('user');
			$user = User::findOrFail($userSession->idUser);
			$result[ 'status' ] = true;
			$result[ 'item' ] = $user->toArray();
			$result[ 'message' ] = 'User finding successful';
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'User not found';
			return $response->withJson($result, 404);
		}
	}

	/*
|---------------------------------------------------------------------------------------------------
| User
|---------------------------------------------------------------------------------------------------
*/
	public function user_profile ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);
		try {
			$userSession = $this->session->get('user');
			$user = User::findOrFail($userSession->idUser);
			$user->publications;
			$result[ 'status' ] = true;
			$result[ 'item' ] = $user->toArray();
			$result[ 'message' ] = 'User finding successful';
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'User not found';
			return $response->withJson($result, 404);
		}
	}
}
