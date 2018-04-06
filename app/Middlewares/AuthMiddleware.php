<?php

namespace App\Middlewares;

use App\Models\User;
use Firebase\JWT\JWT;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthMiddleware extends BaseMiddleware
{

	public function __invoke ( ServerRequestInterface $request, ResponseInterface $response, $next )
	{
		$result = array(
			'status' => false,
			'item' => array(),
			'message' => '',
		);
		try {

			$authHeader = $request->getHeaderLine('Authorization');
			list($jwt) = sscanf($authHeader, 'Bearer %s');
			$data_decode = JWT::decode($jwt, $this->container->get('settings')[ 'app' ][ 'key_jtw' ], array( 'HS256' ));
			/*
						$username = $_SERVER[ 'PHP_AUTH_USER' ];
						$password = hash('sha256', $_SERVER[ 'PHP_AUTH_PW' ]);


						$user = User::select('username', 'email')->where('username', '=', $username)
							->where('password', $password)->firstOrFail();
						$data = $user->toArray();*/

			//$response['newData'] = json_encode($data_decode);

			$response = $next($request, $response);
			return $response;
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'No autorizado';
			$result[ 'Ex' ] = $ex->getMessage();
			return $response->withJson($result, 404);
		}
	}
}