<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Theme actions Handler
// +----------------------------+

$post = new stdClass();
foreach ($_POST as $key => $value) {
	if (empty($value)) {
		$errors .= "$key is empty";
	}
	else{
		$post->$key = $phpEGen->clean($value);
	}
}

$action = $phpEGen->clean($_GET['action']);

if (empty($errors)) {
	$request = $phpEGen->email_themes_actions($post, $action);
	if($request['status'] === true){
		$response['code'] = 200;
		$response['msg'] = $request['msg'];
	}
	else{
		$response['msg'] = $request['msg'];
	}
}