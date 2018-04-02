<?php

namespace App\Controllers;

use App\Models\User;


class UserController extends BaseController
{

	/*
|---------------------------------------------------------------------------------------------------
| All users
|---------------------------------------------------------------------------------------------------
*/
	public function all_users ( $request, $response, $args )
	{
		$result = array(
			'status' => false,
			'items' => array(),
			'message' => '',
		);

		$users = User::all();

		if ( !empty($users) ) {
			$result[ 'status' ] = true;
			$result[ 'items' ] = $users->toArray();
			return $response->withJson($result, 200);
		} else {
			$result[ 'message' ] = 'Users not found';
			return $response->withJson($result, 404);
		}
	}


	/*
	|---------------------------------------------------------------------------------------------------
	| User
	|---------------------------------------------------------------------------------------------------
	*/
	public function user ( $request, $response, $args )
	{
		$result = array(
			'status' => false,
			'item' => array(),
			'message' => '',
		);

		$user = User::find($args[ 'id' ]);

		if ( !empty($user) ) {
			$result[ 'status' ] = true;
			$result[ 'item' ] = $user->toArray();
			return $response->withJson($result, 200);
		} else {
			$result[ 'message' ] = 'User not found';
			return $response->withJson($result, 404);
		}
	}


}
