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
			$id_publication = $args[ 'id_publication' ];
			$userLogged = $this->session->get('user');
			$publication = Publication::findOrFail($id_publication);
			$comment = new Comment();
			$comment->id_user = $userLogged->id_user;
			$comment->text = $text;
			$comment->id_publication = $id_publication;
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
			$id_comment = $args[ 'id_comment' ];
			$userLogged = $this->session->get('user');
			$comment = Comment::where([
				[ 'id_comment', '=', $id_comment ],
				[ 'id_user', '=', $userLogged->id_user ]
			])->firstOrFail();
			$comment->delete($comment->id_comment);
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
