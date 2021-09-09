<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com   
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Admin dashboard
// +----------------------------+
require '../core/phpEGen.class.php';

//ADMIN PANEL
$phpEGen->onlyadmin(true);

if(!empty($_GET['page']) && $_GET['page'] != "admin") {
	$pager = strtolower($phpEGen->clean($_GET['page']));
	switch ($pager) {

		case "emails":
			$page = "All Emails";
			$file = "emails";
			break;
		case "email-themes":
			$page = "Email Themes";
			$file = "email-themes";
			break;
		case "add-theme":
			$page = "Add Email Theme";
			$file = "add-theme";
			if (!empty($_GET['subpage'])) {
				// $item_id = $phpEGen->decrypt($phpEGen->clean($_GET['subpage']));
				$item_id = $phpEGen->clean($_GET['subpage']);
				$theme = $phpEGen->email_themes($item_id);
				if (empty($theme)) {
					header("Location: ./email-themes");
					exit;
				}
				$page = "Edit Template : $theme->theme_name";
			}
			break;
		case "email-templates":
			$page = "Email Templates";
			$file = "email-templates";
			break;
		case "add-template":
			$page = "Add Email Template";
			$file = "add-template";
			if (!empty($_GET['subpage'])) {
				// $item_id = $phpEGen->decrypt($phpEGen->clean($_GET['subpage']));
				$item_id = $phpEGen->clean($_GET['subpage']);
				$template = $phpEGen->email_templates($item_id);
				if (empty($template)) {
					header("Location: ./email-templates");
					exit;
				}
				$page = "Edit Template : $template->email_type";
			}
			break;
		case "settings":
			$page = "Site Settings";
			$file = "settings";
			break;

		case "generate":
			$page = "Generate Code";
			$file = "generate";
			break;
		case "send":
			$page = "Send Email";
			$file = "send";
			break;
	}
}
else{
	$page = "Home";
	$file = "index";
}
if(empty($page) || empty($file) || !file_exists("layout/$file.php")){
	$page = "404 - Page not found";
	$file = "404";
}

$req_headers = apache_request_headers();
if (!empty($req_headers['X-PJAX'])) {
	?>
	<title><?=$page?> - <?=$sitename?></title>
	<?php
	include 'layout/'.$file.".php";
}
else{
	include 'layout/head.phtml';
	include 'layout/nav.phtml';
	include 'layout/top.phtml';
	include 'layout/'.$file.".php";
	include 'layout/footer.phtml';
}