<?php
	
	$id = $_GET['id'];
	$update_link = $_GET['update_link'];
	
	$update_product = "UPDATE color SET image_url='" . $update_link . "' WHERE id=" . $id;
	
	$response = array();
	if(!mysql_query($update_product)) {
		$response['code'] = "failure";
		$response['query'] = $update_product;
		$response['msg'] = mysql_error();
	} else {
		$response['code'] = "success";
	}
	echo json_encode($response);

?>