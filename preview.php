<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Preview demo
// +----------------------------+
require 'core/phpEGen.class.php';
if (empty($_GET['type'])) {
	exit('type is not defined');
}
$type = $phpEGen->clean($_GET['type']);
if ($type == "template") {
	if (!empty($_GET['t_id'])) {
		$temp = $phpEGen->email_templates($phpEGen->clean($_GET['t_id']));
		if (empty($temp)){
			echo 'Template not found';
			exit;
		}
		$content = $phpEGen->form_mail($temp->email_type);
		echo $content['content'];
	}
}
if ($type == "email") {
	if (!empty($_GET['mail_id'])) {
		$email = $phpEGen->all_emails($phpEGen->clean($_GET['mail_id']));
		if (empty($email)){
			echo "Couldn't find email";
			exit;
		}
		?>
		<h1><?=$email->subject?> <<?=$email->send_to?>></h1>
		<hr>
		<?=$email->message?>
		<?php
	}
}

?>