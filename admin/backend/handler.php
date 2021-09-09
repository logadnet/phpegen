<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Backend Handler
// +----------------------------+
require '../../core/phpEGen.class.php';

$phpEGen->onlyxhr();

// Check if handler is present
if(empty($_GET['handler'])){
    http_response_code(400);
	exit;
}
// Check which file to load
$handler = $phpEGen->clean($_GET['handler']);

$response['code'] = 400;
$response['msg'] = "There was an error. Sorry";
$errors = "";

// Load the handler file
if(file_exists("./$handler.php")){
	require "./$handler.php";
} else {
	$response['msg'] = "Backend handler not found";
}

if (!empty($errors)) {
	$response['msg'] = $errors;
}

echo json_encode($response);
exit;
