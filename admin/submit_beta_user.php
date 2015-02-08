<?php
	require_once('../PasswordHash.php');

	$dbh = new PDO('mysql:host=localhost;dbname=jrubins_sf', 'jrubins_sf', 'spirit_friday');

	$response = array();
	$email = $_POST['email'];
	$password = $_POST['password'];

	$t_hasher = new PasswordHash(8, FALSE);
		
	$pass_hash = $t_hasher->HashPassword($password);
	$create_user = "INSERT INTO user (email, password, first_time) VALUES (:email, :password, :first_time)";
	$create_user_stmt = $dbh->prepare($create_user);
	$create_user_stmt->bindParam(":email", $email);
	$create_user_stmt->bindParam(":password", $pass_hash);
	$create_user_stmt->bindValue(":first_time", 1);

	if(!$create_user_stmt->execute()) {
		$response['code'] = "failure";
		$response['err'] = $create_user_stmt->errorInfo();
	} else {
		$response['code'] = "success";
	}

	echo json_encode($response);

?>