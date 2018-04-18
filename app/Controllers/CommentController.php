<?php

namespace App\Controllers;

use App\Includes\Helpers;
use App\Models\Comment;
use App\Models\Publication;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use  \GuzzleHttp\Psr7\LazyOpenStream;

class CommentController extends BaseController
{

	/*
	|---------------------------------------------------------------------------------------------------
	| Home
	|---------------------------------------------------------------------------------------------------
	*/
	public function save_comment ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);

		$body = $request->getParsedBody();
		$text = trim($body[ 'text' ]);

		if ( $text == '' ) {
			$result[ 'message' ] = "The comment is empty";
			return $response->withJson($result, 500);
		}

		try {
			$idPublication = $args[ 'idPublication' ];
			$userLogged = $this->session->get('user');
			$publication = Publication::findOrFail($idPublication);
			$comment = new Comment();
			$comment->idUser = $userLogged->idUser;
			$comment->text = $text;
			$comment->idPublication = $idPublication;
			$comment->save();

			$result[ 'item' ] = $comment;
			$result[ 'message' ] = "Saved comment";
			$result[ 'status' ] = true;
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = "The comment was not saved";
			$result[ 'ex' ] = $ex->getMessage();
			return $response->withJson($result, 500);
		}
	}


	public function delete_comment ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);
		try {
			$idComment = $args[ 'idComment' ];
			$userLogged = $this->session->get('user');
			$comment = Comment::where([
				[ 'idComment', '=', $idComment ],
				[ 'idUser', '=', $userLogged->idUser ]
			])->firstOrFail();
			$comment->delete($comment->idComment);
			$result[ 'status' ] = true;
			$result[ 'message' ] = "Deleted comment";
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = "Comment was not deleted";
			$result[ 'ex' ] = $ex->getMessage();
			return $response->withJson($result, 500);
		}
	}
}
