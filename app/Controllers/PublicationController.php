<?php

namespace App\Controllers;

use App\Includes\Helpers;
use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use  \GuzzleHttp\Psr7\LazyOpenStream;

use App\Models\Publication;
use App\Models\Photo;


class PublicationController extends BaseController
{

	/*
	|---------------------------------------------------------------------------------------------------
	| Create Publication
	|---------------------------------------------------------------------------------------------------
	*/
	public function create ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);
		$body = $request->getParsedBody();

		$userLogged = $this->session->get('user');
		$description = trim($body[ 'description' ]);
		$location = trim($body[ 'location' ]);
		$base64Photo = trim($body[ 'dataBase64Photo' ]);

		try {
			$new_name_file = Helpers::makeHash($userLogged->idUser, true) . '.jpg';

			$base64Photo = str_replace('data:image/jpeg;base64,', '', $base64Photo);
			$base64Photo = str_replace(' ', '+', $base64Photo);
			$data = base64_decode($base64Photo);
			$file = Helpers::get_path_user($userLogged->idUser, $new_name_file);
			$path = Helpers::get_path_user($userLogged->idUser);

			if ( !file_exists($path) ) {
				mkdir($path, 0700);
				chmod($path, 0777);
			}
			$success = file_put_contents($file, $data);
			$publication = new Publication();
			$publication->idUser = $userLogged->idUser;
			$publication->description = strip_tags($description);
			$publication->location = strip_tags($location);
			$publication->save();

			$photo = new Photo();
			$photo->pathPhoto = $new_name_file;
			$photo->idPublication = $publication->idPublication;
			$photo->publicPath = "static/pub/$publication->idPublication/image.jpg";
			$photo->save();
			/* Get data of publication*/
			$publication->user;
			$publication->photo;
			foreach ( $publication->likes as $comment ) {
				$comment->user;
			}
			foreach ( $publication->comments as $comment ) {
				$comment->user;
			}

			$result[ 'status' ] = true;
			$result[ 'message' ] = "Created successful";
			$result[ 'publication' ] = $publication;
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = "Error when creating Publication";
			$result[ 'ex' ] = $ex->getMessage();
			return $response->withJson($result, 500);
		}
	}

	public function image ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		$result = array(
			'status' => false,
			'message' => '',
		);
		try {
			$publication = Publication::findOrFail($args[ 'idPublication' ]);
			$new_name_file = $publication->photo->pathPhoto;
			$file = Helpers::get_path_user($publication->idUser, $new_name_file);
			$newStream = new LazyOpenStream($file, 'r');
			$repoonse = $response->withBody($newStream);
			$repoonse = $repoonse->withHeader('Content-Type', 'image/jpg');
			$repoonse = $repoonse->withHeader('Content-Disposition', 'inline; filename="'.$new_name_file.'"');
			return $repoonse;
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = "Error when creating Publication";
			$result[ 'ex' ] = $ex->getMessage();
			return $response->withJson($result, 500);
		}
	}


	public function get_publication ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		/*
		 * Datos de la publicacion
		 * Photo
		 * El usuario que hizo la publicación
		 * */

		$idPublication = $args[ 'idPublication' ];
		$result = array(
			'status' => false,
			'message' => '',
		);
		try {
			$publication = Publication::findOrFail($idPublication);
			$publication->user;
			$publication->photo;
			foreach ( $publication->likes as $comment ) {
				$comment->user;
			}
			foreach ( $publication->comments as $comment ) {
				$comment->user;
			}

			$result[ 'item' ] = $publication;
			$result[ 'status' ] = true;
			$result[ 'message' ] = "Found publication";
			return $response->withJson($result, 200);
		} catch ( \Exception $ex ) {
			$result[ 'message' ] = "Publication not found";
			$result[ 'ex' ] = $ex->getMessage();
			return $response->withJson($result, 500);
		}
	}
}
