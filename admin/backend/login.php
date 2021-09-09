<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Login Handler
// +----------------------------+

$post = new stdClass();
foreach ($_POST as $key => $value) {
	$post->$key = $phpEGen->clean($value);
}

## Email ##
if(empty($post->email)){
	$errors .= "Email is required";
}
else{
	// Validate email
	if(!filter_var($post->email, FILTER_VALIDATE_EMAIL)) {
	    $errors .= "Invalid email format\n";
	}
}

## Password ##
if (empty($post->password)) {
	$errors .= "Password is required\n";
}

if(empty($errors)){
	$expected_password = '$2y$10$dJh2keDovaFODgwDngkia.frnxK62r5u5D0VvNaCOdPSj7cUv1lEG';
	if($post->email == "admin@admin.com" && password_verify($post->password, $expected_password)){

		session_start();
		$token = $phpEGen->encrypt($phpEGen->encrypt("allow_admin"));
		$_SESSION['admin_auth'] = $token;
		if (empty($_COOKIE['admin_auth'])) {
			setcookie("admin_auth", $token, time() + (60*60*24*10), "/", "", false, true);
		}

		$response['code'] = 200;
		$response['url'] = "./";
		$response['msg'] = "Login successful";
	}
	else{
		$response['msg'] = "Invalid Login";
	}
}