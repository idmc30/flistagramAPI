<?php

namespace App\Controllers;

use App\Models\Like;
use App\Models\Publication;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class LikeController extends BaseController
{

	/*
	|---------------------------------------------------------------------------------------------------
	| Home
	|---------------------------------------------------------------------------------------------------
	*/
	public function set_like ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);

		try {
			$idPublication = $args[ 'idPublication' ];
			$state = ( $args[ 'state' ] == 1 ) ? 1 : 0;
			$userLogged = $this->session->get('user');

			$publication = Publication::findOrFail($idPublication);

			$comment = Like::where([
				[ "idUser", '=', $userLogged->idUser ],
				[ "idPublication", '=', $idPublication ]
			])->first();

			if ( !$comment ) {
				$comment = new Like();
				$comment->idUser = $userLogged->idUser;
				$comment->idPublication = $idPublication;
			}

			$comment->state = $state;
			$comment->save();

			$result[ 'item' ] = $comment;
			$result[ 'message' ] = "Saved like action";
			$result[ 'status' ] = true;
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = "The like action was not saved";
			$result[ 'ex' ] = $ex->getMessage();
			return $response->withJson($result, 500);
		}
	}
}
