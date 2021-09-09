<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Email actions Handler
// +----------------------------+

$post = new stdClass();
foreach ($_POST as $key => $value) {
	if (empty($value)) {
		$errors .= "$key is empty";
	}
	else {
		if (!is_array($value)) {
			$post->$key = $phpEGen->clean($value);
		}
		else {
			$post->$key = $value;
		}
	}
}

$action = $phpEGen->clean($_GET['action']);

if (empty($errors)) {
	if ($action == "generate") {

		if (!empty($post->var_keys)) {
			$variables = "";
			foreach ($post->var_keys as $var => $var_key) {
				if (empty($post->var_values[$var])) {
					continue;
				}
		$variables .= '$variables["'.$var_key.'"] = "'.$post->var_values[$var].'";
				';
			}
		}
		$code = '
		<?php
		// require class file
		require "phpEGen/core/phpEGen.class.php";

		// Initialize phpEGen class
		$phpEGen = new PHPEGen();
		';

		if (!empty($variables)) {
		$code .= "
		// Custom variables
		$variables";
		$code .= '
		// fetch template html
		$content = $phpEGen->form_mail("'.$post->email_template.'", $variables);';
		}
		else {
		$code .= '
		// fetch template html
		$content = $phpEGen->form_mail("'.$post->email_template.'");';
		}
		
		$code .= '
		if (!empty($content)) {
			// Send email
			$phpEGen->mail("'.$post->send_to.'", $content["subject"], $content["content"]);
		}
		else {
			// Template not found
		}
		';

		$response['html'] = highlight_string($code, true);
		$response['msg'] = "success";
		$response['code'] = 200;

	}
	if ($action == "send") {
		if (!empty($post->var_keys)) {
			foreach ($post->var_keys as $var => $var_key) {
				if (empty($post->var_values[$var])) {
					continue;
				}
				$variables[$var_key] = $post->var_values[$var];
				$phpEGen = new PHPEGen();
				$content = $phpEGen->form_mail($post->email_template, $variables);
				if (!empty($content)) {
		            // Send email
		            if ( $phpEGen->mail($post->send_to, $content['subject'], $content["content"]) ){
		            	$response['code'] = 200;
		            	$response['msg'] = "Email sent successfully!";
		            }
		        }
			}
		}
	}
}