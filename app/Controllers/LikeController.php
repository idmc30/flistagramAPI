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
			$id_publication = $args[ 'id_publication' ];
			$state = ( $args[ 'state' ] == 1 ) ? 1 : 0;
			$userLogged = $this->session->get('user');

			$publication = Publication::findOrFail($id_publication);

			$comment = Like::where([
				[ "id_user", '=', $userLogged->id_user ],
				[ "id_publication", '=', $id_publication ]
			])->first();

			if ( !$comment ) {
				$comment = new Like();
				$comment->id_user = $userLogged->id_user;
				$comment->id_publication = $id_publication;
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
