<?php
// +------------------------------------------------------------------------+
// | @author 		: Michael Arawole (HENT Technologies)
// | @author_url	: https://logad.net
// | @author_email	: henttech@gmail.com   
// +------------------------------------------------------------------------+
// | Copyright (c) 2021 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | PHPEGen Class
// +----------------------------+

class PHPEGen {
	public function __construct(){
		// require "\x63\x6f\x6e\146\151\x67\56\x70\x68\x70";
		// require "\x63\x68\145\143\x6b\x65\162\x2e\160\x68\x70";
	    $mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	    $this->con = $mysqli;
	    $this->siteurl = $siteurl;
	}

	## Site Settings ##
	public function settings($s = null){
		$stmt = $this->con->prepare("SELECT * FROM site_settings");
		$stmt->execute();
		$result = $stmt->get_result();
		while ($obj = $result->fetch_object()) {
		    $columns[] = $obj;
		}
		$obj = new stdClass();
		foreach ($columns as $column) {
			$obj->{$column->name} = $column->value;
		}
		if (!empty($s)) {
			$obj->columns = $columns;
		}
		$obj->siteurl = $this->siteurl;
		$obj->site_logo = $this->siteurl."/".$obj->site_logo;
		$obj->site_icon = $this->siteurl."/".$obj->site_icon;
		return $obj;
	}

	## Clean string ##
	public function clean($string){
	    $string = htmlentities($string);
	    return $string;
	}

	## Encrypt string ##
	public function encrypt($string){
		$simple_string = $string;
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0;

		$encryption_iv = 'Rhm2lRLbGwi5m(!!';
		$encryption_key = "5OZHVomiqK4e62RT1zaFWur0jAY3cEkf";

		$encryption = openssl_encrypt($simple_string, $ciphering, 
					$encryption_key, $options, $encryption_iv); 
		return $encryption;
	}

	## Decrypt string ##
	public function decrypt($string){
		$encryption = $string;
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 

		$decryption_iv = 'Rhm2lRLbGwi5m(!!';
		$decryption_key = "5OZHVomiqK4e62RT1zaFWur0jAY3cEkf";

		$decryption=openssl_decrypt ($encryption, $ciphering, 
				$decryption_key, $options, $decryption_iv);
		return $decryption;
	}

	## Allow only XHR ##
	public function onlyxhr(){
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
				http_response_code(404);
				exit;
			}
		} 
		else {
			http_response_code(404);
			exit;
		}
	}

	## Generate random string ##
	public function GenerateKey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false) {
		$charset = '';
		if ($uselower) {
			$charset .= "abcdefghijklmnopqrstuvwxyz";
		}
		if ($useupper) {
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		if ($usenumbers) {
			$charset .= "0123456789";
		}
		if ($usespecial) {
			$charset .= "~@#$%^*()_+-={}|][";
		}
		if ($minlength > $maxlength) {
			$length = mt_rand($maxlength, $minlength);
		} else {
			$length = mt_rand($minlength, $maxlength);
		}
		$key = '';
		for ($i = 0; $i < $length; $i++) {
			$key .= $charset[(mt_rand(0, strlen($charset) - 1))];
		}
		return $key;
	}

	// SEND EMAIL
	public function form_mail($type, $cus_vars = array()) {
		// Fetch email templae from database
		$email_template = $this->email_templates($type, "email_type");
		if (!empty($email_template)) {
			foreach ($email_template as $tkey => $tval) {
				$variables[$tkey] = html_entity_decode($tval);
			}
			if (!empty($cus_vars)) {
				foreach ($cus_vars as $key => $value) {
					$variables[$key] = $value;
				}
			}
			$variables['sitename'] = $this->settings()->site_name;
			$variables['siteaddress'] = $this->settings()->site_address;
			$variables['siteurl'] = $this->settings()->siteurl;
			$variables['sitelogo'] = $this->settings()->site_logo;
			$variables['siteicon'] = $this->settings()->site_icon;
			$variables['date'] = date("Y");
			$variables['date_full'] = date("d, M, Y");
			$variables['unsubscribe_link'] = $this->settings()->siteurl;
			$variables['facebook_link'] = $this->settings()->facebook_link;
			$variables['instagram_link'] = $this->settings()->instagram_link;
			$variables['twitter_link'] = $this->settings()->twitter_link;

			$theme = $this->email_themes($this->settings()->email_theme);
			$template = html_entity_decode($theme->theme_header.$theme->theme_body.$theme->theme_footer);
			foreach($variables as $key => $value) {
			    $template = str_replace('{{ '.$key.' }}', $value, $template);
			    $template = str_replace('{{'.$key.'}}', $value, $template);
			}
			$ret['subject'] = $email_template->email_subject;
			$ret['content'] = $template;
			return $ret;
		}
		return false;
	}

	// Custom Mail
	public function mail($to,$subject,$message, $files = null){
		$to = $this->clean($to);
		$subject = $this->clean($subject);
		// $message = $this->clean($message);
		if ($this->settings()->mail_method == "mail") {
			$headers = "From: " . $this->settings()->site_name . "\r\n";
			$headers .= "Reply-To: ". $this->settings()->site_email ."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			if(mail($to, $subject, $message, $headers) === true){
				$this->log_mail($to, $subject, $message);
				return true;
			}
		}
		if ($this->settings()->mail_method == "smtp") {

			$post = [
			    'to' => $to,
			    'subject' => $subject,
			    'message' => $message,
			    'from' => $this->settings()->site_name,
			    'attachments' => $files
			];

			$url = $this->siteurl."/sources/email/index.php";
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_POSTFIELDS => $post
			));
			// execute!
			$response = curl_exec($curl);
			$this->log_mail($to, $subject, $message);
			return true;
			curl_close($curl);
		}

		return false;
	}

	## Log emails sent ##
	private function log_mail($to, $subject, $message) {
		$stmt = $this->db("insert", "mailings", array("subject" => $subject, "send_to" => $to, "message" => $message, "date" => time()));
		if ($stmt->affected_rows == 1) {
			return true;
		}
		return false;
	}

	## Upload image ##
	public function upload_image($file,$path = "default"){
		$response['status'] = false;
		$response['msg'] = "Some error occurred while uploading the document";
		$_FILES = (array) $file;
		if (empty($_FILES['name'])) {
			$response['msg'] = "File not found";
			return $response;
		}

		switch ($path) {
			case "default":
				$folder = "../../uploads/images/".date("Y")."/".date("m")."/";
				if (!is_dir($folder)) mkdir($folder, 0777, true);
				$target_dir = $folder;
				$temp = explode(".", $_FILES["name"]);
				$rand = $this->GenerateKey();
				$oldfilename = "image-".time()."-".$rand."." .end($temp);
				break;
		}

		$target_file = $target_dir.basename($_FILES["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["tmp_name"]);
		if (!empty($check)) {
			$uploadOk = 1;
		} else {
			$response['msg'] = "File is not an image.";
			return $response;
		}

		// Check file size
		if ($_FILES["size"] > 5000000) {
			$response['msg'] = "Sorry, your file is too large.";
			return $response;
		}
		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$response['msg'] = "Sorry, only JPG, JPEG & PNG files are allowed.";
			return $response;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 1) {
			// if everything is ok, try to upload file
			$newfilename = $target_dir.$oldfilename;
			if (move_uploaded_file($_FILES["tmp_name"], $newfilename)) {
				$path = str_replace("../", null, $target_dir.$oldfilename);
				$response['status'] = true;
				$response['msg'] = "Thumb Uploaded";
				$response['path'] = $path;
				return $response;
			}
		}

		return $response;
	}


	// +----------------------------+
	// | Admin Functions
	// +----------------------------+
	## Allow only admin ##
	public function onlyadmin($redirect = false){
		if($this->admin_logged_in() === false){
			if ($redirect === true) {
				header("Location: $this->siteurl/admin/login");
				exit;
			}
			else{
				http_response_code(404);
				exit;
			}
		}
	}

	public function admin_logged_in(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			session_write_close();
		}
		if (isset($_SESSION['admin_auth'])) {
			$token = $_SESSION['admin_auth'];
			if ($this->decrypt($this->decrypt($token)) == "allow_admin") {
				return true;
			}
		} else {
			if(isset($_COOKIE['admin_auth'])) {
				$token = $_COOKIE['admin_auth'];
				if ($this->decrypt($this->decrypt($token)) == "allow_admin") {
					return true;
				}
			}
		}
		return false;
	}

	## DB ##
	protected function db ($type = "select", $query = null, $values = array()) {
		$type = strtolower($type);
		if ($type == "select") {
			$query = "SELECT ".$query;
		}
		if ($type == "insert") {
			$query = "INSERT INTO $query (";
			$pvalues = $values;
			$values = array();
			foreach ($pvalues as $key => $val) {
				$query .= "$key, ";
				$values[] = $val;
			}
			$query = rtrim($query, ", ");
			$commas = rtrim(str_repeat("?,", count($values)), ",");
			$query .= ") VALUES ($commas)";
		}

		$stmt = $this->con->prepare($query);
		if (!empty($values)) {
			$data_types = str_repeat('s', count($values));
			$stmt->bind_param($data_types, ...$values);
		}
		$stmt->execute();
		if ($type == "insert") {
			return $stmt;
		}
		$result = $stmt->get_result();
		return $result;
	}

	## Email Templates ##
	public function email_templates($t_id = false, $field = "id"){
		if (!empty($t_id)) {
			$stmt = $this->con->prepare("SELECT * FROM email_templates WHERE $field = ?");
			$stmt->bind_param("s", $t_id);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows == 0) return false;
			$data = $result->fetch_object();
			return $data;
		}
		else{
			$data = array();
			$stmt = $this->con->prepare("SELECT * FROM email_templates ORDER BY id DESC");
			$stmt->execute();
			$result = $stmt->get_result();
			while ($obj = $result->fetch_object()) {
				$data[] = $obj;
			}
		}

		return $data;
	}

	## Email Template actions ##
	public function email_templates_actions($post,$action){
		$response['msg'] = "Some error occurred";
		$response['status'] = false;

		$date = time();
		if ($action == "add") {
			$stmt = $this->con->prepare("INSERT INTO email_templates (email_type, email_subject, email_header, email_summary, email_body, date, mod_date) VALUES (?,?,?,?,?,?,?)");
			$stmt->bind_param("sssssii", $post->email_type, $post->email_subject, $post->email_header, $post->email_summary, $post->email_body, $date, $date);
			$stmt->execute();
		}
		if ($action == "edit"){
			$stmt = $this->con->prepare("UPDATE email_templates SET email_type = ?, email_subject = ?, email_header = ?, email_summary = ?, email_body = ?, mod_date = ? WHERE id = ?");
			$stmt->bind_param("sssssii", $post->email_type, $post->email_subject, $post->email_header, $post->email_summary, $post->email_body, $date, $post->template_id);
			$stmt->execute();
		}
		if ($action == "delete"){
			$post->item_id = $this->decrypt($post->item_id);
			$stmt = $this->con->prepare("DELETE FROM email_templates WHERE id = ?");
			$stmt->bind_param("i", $post->item_id);
			$stmt->execute();
		}
		if ($stmt->affected_rows == 1) {
			$response['status'] = true;
			$response['msg'] = "Action successful";
		}

		return $response;
	}

	## Email Themes ##
	public function email_themes($t_id = false, $field = "id"){
		if (!empty($t_id)) {
			$stmt = $this->con->prepare("SELECT * FROM email_themes WHERE $field = ?");
			$stmt->bind_param("s", $t_id);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows == 0) return false;
			$data = $result->fetch_object();
			return $data;
		}
		else{
			$data = array();
			$fetch = $this->db("select", "* FROM email_themes ORDER BY id DESC");
			while ($obj = $fetch->fetch_object()) {
				$data[] = $obj;
			}
		}

		return $data;
	}

	## Email Themes actions ##
	public function email_themes_actions($post,$action){
		$response['msg'] = "Some error occurred";
		$response['status'] = false;

		$date = time();
		if ($action == "add") {
			$stmt = $this->con->prepare("INSERT INTO email_themes (theme_name, theme_header, theme_body, theme_footer, date, mod_date) VALUES (?,?,?,?,?,?)");
			$stmt->bind_param("ssssii", $post->theme_name, $post->theme_header, $post->theme_body, $post->theme_footer, $date, $date);
			$stmt->execute();
		}
		if ($action == "edit"){
			$stmt = $this->con->prepare("UPDATE email_themes SET theme_name = ?, theme_header = ?, theme_body = ?, theme_footer = ?, mod_date = ? WHERE id = ?");
			$stmt->bind_param("sssssi", $post->theme_name, $post->theme_header, $post->theme_body, $post->theme_footer, $date, $post->theme_id);
			$stmt->execute();
		}
		if ($action == "delete"){
			$post->item_id = $this->decrypt($post->item_id);
			$stmt = $this->con->prepare("DELETE FROM email_themes WHERE id = ?");
			$stmt->bind_param("i", $post->item_id);
			$stmt->execute();
		}
		if ($stmt->affected_rows == 1) {
			$response['status'] = true;
			$response['msg'] = "Action successful";
		}

		return $response;
	}

	public function all_emails($mail_id = false){
		if (empty($mail_id)) {
			$data = array();
			$fetch = $this->db("select", "* FROM mailings ORDER BY id DESC");
			while ($obj = $fetch->fetch_object()) {
			    $data[] = $obj;
			}
		}
		else {
			$fetch = $this->db("select", "* FROM mailings where id='$mail_id'");
			if (empty($fetch)) {
				return false;
			}
			$data = $fetch->fetch_object();
		}
		return $data;
	}

	// Coming soon
	public function email_variables(){
		$data = array();
		$fetch = $this->db("select", "* FROM email_variables ORDER BY id DESC");
		while ($obj = $fetch->fetch_object()) {
		    $data[] = $obj;
		}
		return $data;
	}

	## Save Site Settings ##
	public function admin_save_site_settings($post){
		$response['status'] = false;
		$response['msg'] = "Some error occurred";
		$errors = "";

		// Columns
		$get = $this->settings(true)->columns;
		foreach ($get as $col) {
			$columns[] = $col->name;
		}
		$query = "UPDATE `site_settings` SET `value` = CASE `name` ";
		foreach ($post as $pkey => $val) {
			if (in_array($pkey, $columns)) {
				$query .= "WHEN '$pkey' THEN '$val' ";
			}
		}
		foreach ($post->files as $fkey => $fval) {
			if (in_array($fkey, $columns)) {
				if (empty($fval['name'])) {
					continue;
				}
				$try = $this->upload_document($fval);
				if ($try['status'] !== true) {
					$response['msg'] = "$fkey - ".$try['msg'];
					return $response;
				}
				else {
					$path = $try['path'];
					$query .= "WHEN '$fkey' THEN '$path' ";
				}
			}
		}
		$query .= "ELSE `value`
				END";
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		if($stmt->affected_rows == 0) {
			$errors .= "Some fields were not saved";
		}
		if (!empty($errors)) {
			$response['msg'] = $errors;
		}
		else{
			$response['status'] = true;
			$response['msg'] = "Changes saved successfully";
		}

		return $response;
	}

	
	public function send_mass_email(){
		$emails = $this->all_emails(false, 0);
		foreach ($emails as $email) {
			// Send email
			$variables['message'] = $email->message;
			$data  = new stdClass();
			$data['variables'] = $variables;
			$content = $this->form_mail("mailing");
			if (!empty($content)) {
				foreach ($this->all_subscribers() as $sub_email) {
					$this->mail($sub_email->email, $email->subject, $content['content']);
				}
			}
		}
	}
}

$phpEGen = new PHPEGen();
$site = $phpEGen->settings();
$sitename = $site->site_name;
$siteurl = $site->siteurl;
