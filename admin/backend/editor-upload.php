<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Editor actions Handler
// +----------------------------+

$post = new stdClass();
foreach ($_POST as $key => $value) {
	$post->$key = $phpEGen->clean($value);
}

if (empty($_FILES['file']['name'])) {
	$errors .= "No file was uploaded";
}

if (empty($errors)) {
	$file = $_FILES['file'];
	$request = $phpEGen->upload_image($file);
	if($request['status'] === true){
		$response['code'] = 200;
		$response['url'] = $siteurl."/".$request['path'];
		$response['msg'] = $request['msg'];
	}
	else{
		$response['msg'] = $request['msg'];
	}
}