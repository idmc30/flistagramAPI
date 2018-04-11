<?php namespace App\Includes;

class Helpers
{

	public static function isAjaxRequest ()
	{
		if ( !empty($_SERVER[ 'HTTP_X_REQUESTED_WITH' ]) && strtolower($_SERVER[ 'HTTP_X_REQUESTED_WITH' ]) == 'xmlhttprequest' ) {
			return true;
		}

		return false;
	}

	public static function get_url_photo_profile ( $idUser, $path_photo = '' )
	{
		if ( empty($path_photo) ) {
			$path = URL::to('public/img/profile-default.jpg');
		} else {
			$path = URL::to('public/img/users/' . $idUser . '/' . $path_photo);
		}
		return $path;
	}

	public static function get_thumbnail ( $filename, $max_width, $max_height )
	{
		$image = imagecreatefromjpeg($filename);
		$width = imagesx($image);
		$height = imagesy($image);
		$image_type = imagetypes() & IMG_JPG; //IMG_GIF |  | IMG_PNG | IMG_WBMP | IMG_XPM

		if ( $width == $height ) {

			$thumb_width = $width;
			$thumb_height = $height;

		} elseif ( $width < $height ) {

			$thumb_width = $width;
			$thumb_height = $width;

		} elseif ( $width > $height ) {

			$thumb_width = $height;
			$thumb_height = $height;

		} else {
			$thumb_width = 150;
			$thumb_height = 150;
		}

		$original_aspect = $width / $height;
		$thumb_aspect = $thumb_width / $thumb_height;

		if ( $original_aspect >= $thumb_aspect ) {

			// If image is wider than thumbnail (in aspect ratio sense)
			$new_height = $thumb_height;
			$new_width = $width / ( $height / $thumb_height );

		} else {
			// If the thumbnail is wider than the image
			$new_width = $thumb_width;
			$new_height = $height / ( $width / $thumb_width );
		}

		$thumb = imagecreatetruecolor($thumb_width, $thumb_height);

		// Resize and crop
		imagecopyresampled($thumb,
			$image,
			0 - ( $new_width - $thumb_width ) / 2, // Center the image horizontally
			0 - ( $new_height - $thumb_height ) / 2, // Center the image vertically
			0, 0,
			$new_width, $new_height,
			$width, $height);
		imagejpeg($thumb, $filename, 80);

		imagedestroy($thumb);
		imagedestroy($image);

		self::resizeImage($filename, $max_width, $max_height);
	}

	public static function resizeImage ( $filename, $max_width, $max_height )
	{
		list($orig_width, $orig_height) = getimagesize($filename);
		$width = $orig_width;
		$height = $orig_height;
		# taller
		if ( $height > $max_height ) {
			$width = ( $max_height / $height ) * $width;
			$height = $max_height;
		}
		# wider
		if ( $width > $max_width ) {
			$height = ( $max_width / $width ) * $height;
			$width = $max_width;
		}
		$image_p = imagecreatetruecolor($width, $height);
		$image = imagecreatefromjpeg($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0,
			$width, $height, $orig_width, $orig_height);

		imagejpeg($image_p, $filename, 100);

		imagedestroy($image);
		imagedestroy($image_p);
	}

	public static function get_path_user ( $idUser, $path = '' )
	{
		return PUBLIC__PATH . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . $idUser . ( $path == '' ? '' : DIRECTORY_SEPARATOR . $path );
	}

	public static function generate_random_string ( $length = 10 )
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ( $i = 0; $i < $length; $i++ ) {
			$randomString .= $characters[ rand(0, $charactersLength - 1) ];
		}
		return $randomString;
	}

	public static function makeHash ( $text, $random = false )
	{
		$hash = hash('sha256', $text);

		if ( $random ) {
			$hash .= self::generate_random_string(6);
		}

		return $hash;
	}

	public static function seeder ()
	{


		for ( $i = 0; $i < 150; $i++ ) {
			$user = Faker\Factory::create();
			$id_user = User::create([
				'name' => $user->name,
				'dateRegistration' => $user->dateTimeThisMonth()->format('Y/m/d h:i:s'),
				'dateUpdate' => $user->dateTimeThisMonth()->format('Y/m/d h:i:s'),
				'password' => Hash::makePassword('123'),
				'email' => $user->email,
				'username' => $user->username,
				'phone' => $user->phoneNumber
			]);
			Profile::create([
				'idUser' => $id_user,
			]);

			/*  Se crea una carpetas para las fotos de usuario */
			$path = Helpers::get_path_user($id_user);
			mkdir($path, 0700);
			chmod($path, 0777);
		}

	}

	public static function validateUsername ( $username )
	{
		return preg_match('/^(?=[a-z]{2})(?=.{4,26})(?=[^.]*\.?[^.]*$)(?=[^_]*_?[^_]*$)[\w.]+$/iD', $username);
	}

	public static function validateEmail ( $email )
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public static function html_to_text ( $html )
	{
		return strip_tags($html);
	}


}