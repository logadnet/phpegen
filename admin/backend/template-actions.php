<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Email actions Handler
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
	$request = $phpEGen->email_templates_actions($post, $action);
	if($request['status'] === true){
		$response['code'] = 200;
		$response['msg'] = $request['msg'];
	}
	else{
		$response['msg'] = $request['msg'];
	}
}