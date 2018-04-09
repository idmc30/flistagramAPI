<?php

namespace App\Controllers;

use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Firebase\JWT\JWT;

class AuthController extends BaseController
{
	/*
	|---------------------------------------------------------------------------------------------------
	| User
	|---------------------------------------------------------------------------------------------------
	*/
	public function token ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);

		$body = $request->getParsedBody();
		$username = $body[ 'username' ];
		$password = $body[ 'password' ];

		if ( trim($username) != '' && trim($password) != '' ) {
			try {
				$password = hash('sha256', $body[ 'password' ]);
				$user = User::select('idUser', 'username', 'email')->where('username', '=', $username)
					->where('password', $password)->firstOrFail();
				$jwt_data = $this->container->get('settings')[ 'app' ][ 'data_jwt' ];
				$jwt_data[ 'data' ] = [
					'username' => $user->username,
					'email' => $user->email,
					'idUser' => $user->idUser
				];
				$jwt = JWT::encode($jwt_data, $this->container->get('settings')[ 'app' ][ 'key_jtw' ]);
				$result[ 'status' ] = true;
				$result[ 'token' ] = $jwt;
				$result[ 'message' ] = 'Token generated successful';
				return $response->withJson($result, 200);
			} catch ( \Exception $ex ) {
				$result[ 'message' ] = 'Not authorized';
				$result[ 'ex' ] = $ex->getMessage();
				return $response->withJson($result, 404);
			}
		} else {
			$result[ 'message' ] = 'Please send correct data';
			return $response->withJson($result, 500);
		}
	}

}
