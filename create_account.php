<?php
	require_once('includes/database.php');
	require_once('PasswordHash.php');
	db_connect();
	session_start();
	
	$beta_emails = array(
		"christylarsen@sbcglobal.net",
		"dlindow1@comcast.net",
		"gguslani5@yahoo.com",
		"vocej9@wfu.edu",
		"hitcmj9@wfu.edu",
		"sueramans@gmail.com",
		"alissa@qltd.com",
		"christine@qltd.com",
		"joerenton@yahoo.com",
		"zigkahuna@yahoo.com",
		"kcraw@umich.edu",
		"claudia0454@aol.com",
		"jboulaha@umich.edu",
		"julie.harness@bankofamerica.com",
		"jonrubins@gmail.com",
		"natalie@spiritfriday.com",
		"katy@spiritfriday.com"
	);
	
	$email = $_POST['email']; 
	if(!in_array($email, $beta_emails)) {
		header("Location: index.php");
	}
	
	$password = $_POST['password'];
	
	$t_hasher = new PasswordHash(8, FALSE);
	$pass_hash = $t_hasher->HashPassword($password);
	
	$create_user = "INSERT INTO user (email, password) VALUES('$email', '$pass_hash')";
	$response = array();
	if(!mysql_query($create_user)) {
		$response['code'] = "failure";
		$response['query'] = $create_user;
		$response['msg'] = mysql_error();
	} else {
		$user_id_query = "SELECT * FROM user WHERE email='$email'";
		if(!($user_id_result = mysql_query($user_id_query))) {
			$response['code'] = "failure";
			$response['query'] = $user_id_query;
			$response['msg'] = mysql_error();
		} else {
			$_SESSION['login'] = true;
			$user_id = mysql_fetch_assoc($user_id_result);
			$response['email'] = $email;
			$_SESSION['user_id'] = $user_id['user_id'];
			$response['user_id'] = $user_id['user_id'];
			$response['code'] = "success";
		}
	}
	echo json_encode($response);

?>