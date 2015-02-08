<?php
	require_once('includes/database.php');
	require_once('PasswordHash.php');
	db_connect();
	session_start();
	
	$colors = array(
		"rgb(204, 51, 51)" => "red",
		"rgb(102, 153, 204)" => "sky_blue",
		"rgb(0, 204, 51)" => "lime_green",
		"rgb(0, 102, 0)" => "dark_green",
		"rgb(153, 0, 0)" => "burgandy", 
		"rgb(255, 102, 51)" => "orange", 
		"rgb(255, 102, 102)" => "coral", 
		"rgb(204, 102, 51)" => "burnt_orange", 
		"rgb(255, 255, 0)" => "yellow", 
		"rgb(204, 153, 0)" => "gold", 
		"rgb(0, 0, 204)" => "blue", 
		"rgb(0, 0, 102)" => "navy", 
		"rgb(51, 204, 255)" => "turquoise", 
		"rgb(102, 0, 102)" => "purple", 
		"rgb(255, 153, 204)" => "light_pink",
		"rgb(255, 0, 153)" => "dark_pink", 
		"rgb(0, 0, 0)" => "black", 
		"rgb(255, 255, 204)" => "beige", 
		"rgb(102, 51, 0)" => "brown", 
		"rgb(102, 102, 102)" => "grey", 
		"rgb(255, 255, 255)" => "white");
	
	
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
	
	if($email == "admin" && $password == "78451254986534278lkght%#@") {
		$_SESSION['admin'] = true;
		header("Location: index.php");
	}
	
	$t_hasher = new PasswordHash(8, FALSE);
	
	$login_query = "SELECT * FROM user WHERE email='$email'";// AND password='$password'";
	
	$response = array();
	if(!($login_result = mysql_query($login_query))) {
		$response['code'] = "failure";
		$response['query'] = $login_query;
		$response['msg'] = mysql_error();
	} else {
		$response['code'] = "success";
		$user_info = mysql_fetch_assoc($login_result);
		$check = $t_hasher->CheckPassword($password, $user_info['password']);
		if(!$check) {
			$response['login'] = "false";
		} else {
			$_SESSION['user_id'] = $user_info['user_id'];
			if($user_info['first_name'] != '') {
				$_SESSION['first_name'] = $user_info['first_name'];
			}
			
			// set the colors for most popular combination
			$get_comb_query = "SELECT * FROM combinations WHERE user_id=" . $user_info['user_id'] . " LIMIT 1";
			if(!($get_comb_result = mysql_query($get_comb_query))) {
				die(mysql_error());
			}
			$set_comb = mysql_fetch_assoc($get_comb_result);
			$set_colors = array();
			foreach($colors as $color) {
				if($set_comb[$color] == 1) {
					$set_colors[] = array_search($color, $colors);
				}
			}
			
			if(count($set_colors) > 0) {
				$_SESSION['cur_comb'] = $set_comb['name'];
				$_SESSION['color'] = $set_colors;
			}
			$_SESSION['login'] = true;
			if($user_info['clothing_type'] == "men") {
				$_SESSION['gender'] = "male";
				$response['gender'] = "male";
			} else {
				$_SESSION['gender'] = "female";
				$response['gender'] = "female";
			}
			$response['login'] = "true";
		}
	}
	echo json_encode($response);
?>