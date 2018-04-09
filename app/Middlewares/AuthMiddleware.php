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
			'message' => '',
		);
		try {
			$authHeader = $request->getHeaderLine('Authorization');
			list($jwt) = sscanf($authHeader, 'Bearer %s');
			$data_decode = JWT::decode($jwt, $this->container->get('settings')[ 'app' ][ 'key_jtw' ], array( 'HS256' ));
			$data_decode = $data_decode->data;
			$this->session->set('user', $data_decode);
			$response = $next($request, $response);
			return $response;
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = 'Not authorized';
			$result[ 'Ex' ] = $ex->getMessage();
			return $response->withJson($result, 404);
		}
	}
}