<?php
// Set variables
$name = "Michael";
$variables['name'] = "$name";
$data = new stdClass();
$data->variables = (object) $variables;

// Call function to form email into template
$content = $phpEGen->form_mail($data,"email-type");
// echo $content['content'];

if (!empty($content)) {

	// Send the formed email content
	$this->mail("test@test.com", $content['subject'], $content['content']);
}
?>