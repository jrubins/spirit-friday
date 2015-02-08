<?php
	session_start();
	require_once('includes/database.php');
	db_connect();
	
	$user_id = $_SESSION['user_id'];
	$product_id = $_POST['product_id'];
	$product_kind = $_POST['kind'];
	$image_url = $_POST['image_url'];
	
	$check_duplicate = "SELECT * FROM dress_room WHERE product_id=$product_id";
	if(!($check_duplicate_result = mysql_query($check_duplicate))) {
		$response['code'] = "failure";
		$response['msg'] = mysql_error();
		$response['query'] = $check_duplicate;
	} else {
		if(mysql_num_rows($check_duplicate_result) > 0) {
			$response['code'] = "success";
		} else {
			$add_droom_query = "INSERT INTO dress_room (user_id, product_id, kind, image_url) VALUES ($user_id, $product_id, '$product_kind', '$image_url')";
			
			$response = array();
			if(!mysql_query($add_droom_query)) {
				$response['code'] = "failure";
				$response['msg'] = mysql_error();
				$response['query'] = $add_droom_query;
			} else {
				$response['query'] = $add_droom_query;
				$response['code'] = "success";
			}
		}
	}
	echo json_encode($response);
?>







