<?php
	require_once('includes/database.php');
	db_connect();
	
	$delete_id = $_POST['delete_id'];

	$delete_query = "DELETE FROM combinations WHERE id=" . $delete_id;
	$response = array();
	if(!mysql_query($delete_query)) {
		$response['code'] = "failure";
		$response['msg'] = mysql_error();
		$response['query'] = $delete_query;
	} else {
		$response['code'] = "success";
	}
	echo json_encode($response);
?>