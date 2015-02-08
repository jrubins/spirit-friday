<?php
	require_once('includes/database.php');
	db_connect();
	
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
	
	$user_id = $_POST['user_id'];
	$comb_name = $_POST['name'];
	$add_colors = json_decode($_POST['add_colors']);

	$add_comb_query = "INSERT INTO combinations (user_id, name";
	foreach($check_colors as $color) {
		$add_comb_query .= ", " . $color;
	}
	$add_comb_query .= ") VALUES ($user_id, '$comb_name'";
	foreach(array_keys($check_colors) as $color) {
		if(in_array($color, $add_colors)) {
			$add_comb_query .= ",1";
		} else {
			$add_comb_query .= ",0";
		}
	}
	$add_comb_query .= ")";
	$response = array();
	if(!mysql_query($add_comb_query)) {
		$response['code'] = "failure";
		$response['msg'] = mysql_error();
		$response['query'] = $add_comb_query;
	} else {
		$response['query'] = $add_comb_query;
		$response['code'] = "success";
	}
	echo json_encode($response);
?>







