<?php
	session_start();
	require_once('includes/database.php');
	db_connect();
	
	$user_id = $_SESSION['user_id'];
	$product_id = $_POST['product_id'];
	
	$remove_droom_query = "DELETE FROM dress_room WHERE user_id=$user_id AND product_id=$product_id";
	
	$response = array();
	if(!mysql_query($remove_droom_query)) {
		$response['code'] = "failure";
		$response['msg'] = mysql_error();
		$response['query'] = $remove_droom_query;
	} else {
		$response['query'] = $remove_droom_query;
		$response['code'] = "success";
	}
	echo json_encode($response);
?>







