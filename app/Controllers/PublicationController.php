<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use  \GuzzleHttp\Psr7\LazyOpenStream;

class PublicationController extends BaseController
{

	/*
	|---------------------------------------------------------------------------------------------------
	| Create Publication
	|---------------------------------------------------------------------------------------------------
	*/
	public function create ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		/*	$response = array( 'success' => false );
			$userLogged = Helpers::get_user_logged();
			$description = trim(Helpers::html_to_text(Input::get('description')));
			$location = trim(Helpers::html_to_text(Input::get('location')));
			$base64Photo = Input::get('dataBase64Photo');

			$new_name_file = uniqid($userLogged->idUser, true) . '.jpg';

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


			$idPublication = Publication::create([
				'location' => trim(Helpers::html_to_text($location)),
				'idUser' => $userLogged->idUser
			]);

			Photo::create([
				'pathPhoto' => $new_name_file,
				'idPublication' => $idPublication
			]);

			if ( $description != '' ) {
				Comment::create([
					'text' => $description,
					'idPublication' => $idPublication,
					'idUser' => $userLogged->idUser
				]);
			}

			$response[ 'success' ] = true;

			Response::json($response);*/
	}

	public function image ( ServerRequestInterface $request, ResponseInterface $response, $args )
	{
		/*		$newResponse = $response->withHeader('Content-type', 'image/jpg');
				$body = $response->getBody();
				$body->write('Hello');*/

		$dir = dirname(dirname(__DIR__));
		$imagePath = $dir . "\public\assets\images\baron.jpg";
		header('Content-type: image/jpeg');
		echo file_get_contents($imagePath);
	}
}
