<?php
	require_once('includes/database.php');
	db_connect();
	session_start();
	
	$check_colors = array(
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
	
	$user_id = $_SESSION['user_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email']; 
	$month = $_POST['month']; 
	$day = $_POST['day'];
	$year = $_POST['year'];
	$clothing_type = $_POST['clothing_type'];
	$updates = $_POST['updates'];
	$combinations = json_decode($_POST['combinations'], true);
	
	$update_user = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email',";
	if($month != '') {
		$update_user .= "month=$month,";
	}
	if($day != '') {
		$update_user .= "day=$day,";
	}
	if($year != '') {
		$update_user .= " year=$year,";
	}
	$update_user .= " clothing_type='$clothing_type',";
	if($updates == "true") {
		$update_user .= " updates=1";
	} else {
		$update_user .= " updates=0";
	}
	$update_user .= " WHERE user_id=$user_id";
	$response = array();
	if(!mysql_query($update_user)) {
		$response['code'] = "failure";
		$response['query'] = $update_user;
		$response['msg'] = mysql_error();
	} else {
		$failure = false;
		foreach($combinations as $comb_name => $comb_colors) {
			$insert_comb_query = "INSERT INTO combinations (user_id, name";
			foreach($check_colors as $color) {
				$insert_comb_query .= ", " . $color;
			}
			$insert_comb_query .= ") VALUES ($user_id, '$comb_name'";
			foreach(array_keys($check_colors) as $color) {
				if(in_array($color, $comb_colors)) {
					$insert_comb_query .= ",1";
				} else {
					$insert_comb_query .= ",0";
				}
			}
			$insert_comb_query .= ")";
			if(!mysql_query($insert_comb_query)) {
				$failure = true;
				break;
			}
		}
		if(!$failure) {
			if($clothing_type == "men") {
				$response['gender'] = "male";
			} else {
				$response['gender'] = "female";
			}
			$_SESSION['login'] = true;
			$_SESSION['first_name'] = $first_name;
			$response['code'] = "success";
		} else {
			$response['code'] = "failure";
			$response['query'] = $insert_comb_query;
			$response['msg'] = mysql_error();
		}
	}
	echo json_encode($response);

?>