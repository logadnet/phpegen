<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Site settings module
// +----------------------------+

$post = new stdClass();
foreach ($_POST as $key => $value) {
	$post->$key = $phpEGen->clean($value);
}

if (empty($post->save_type)) {
	$errors .= "Save Type not specified\n";
}

if (empty($errors)) {
	$post->files = $_FILES;
	$request = $phpEGen->admin_save_site_settings($post);
	if($request['status'] === true){
		$response['code'] = 200;
		$response['msg'] = $request['msg'];
	}
	else{
		$response['msg'] = $request['msg'];
	}
}