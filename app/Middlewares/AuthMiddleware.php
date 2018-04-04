<?php

namespace App\Middlewares;
use App\Models\User;

class AuthMiddleware extends BaseMiddleware
{

	public function __invoke ( $request, $response, $next )
	{
		$result = array(
			'status' => false,
			'item' => array(),
			'message' => '',
		);

		$username = $_SERVER[ 'PHP_AUTH_USER' ];
		$password = $_SERVER[ 'PHP_AUTH_PW' ];

		try {
			$user = User::where('username', $username)->firstOrFail();
			$response = $next($request, $response);
			return $response;
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'No autorizado';
			return $response->withJson($result, 404);
		}
	}
}