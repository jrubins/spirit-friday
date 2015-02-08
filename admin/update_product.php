<?php
	require_once('../includes/database.php');
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
	
	$product_id = $_POST['id'];
	$item_name = $_POST['item_name'];
	$gender = strtolower($_POST['gender']);
	$kind = $_POST['kind'];
	$price = $_POST['price'];
	$brand = $_POST['brand'];
	$store = $_POST['store'];
	$description = $_POST['description'];
	$link = $_POST['link'];
	$images = json_decode($_POST['images']);
	$colors = json_decode($_POST['edit_colors'], true);
	
	$update_product_query = "UPDATE product SET item_name='$item_name', gender='$gender', kind='$kind', price='$price', link='$link', brand='$brand', merchant='$store', description='$description' WHERE product_id=" . $product_id;
	mysql_query($update_product_query);

	foreach($images as $color_entry => $image_link) {
		$update_color_query = "UPDATE color SET ";
		foreach(array_keys($check_colors) as $color) {
			if(in_array($color, $colors[$color_entry])) {
				$update_color_query .= $check_colors[$color] . "=1, ";
			} else {
				$update_color_query .= $check_colors[$color] . "=0, ";
			}
		}
		$update_color_query .= "image_url='$image_link', color_count=" . count($colors[$color_entry]) . " WHERE id=$color_entry";
		
		mysql_query($update_color_query);
	}
	
	
	$response = array();
	$response['id'] = $product_id;
	$response['item_name'] = $item_name;
	$response['gender'] = $gender;
	$response['kind'] = $kind;
	$response['price'] = $price;
	$response['brand'] = $brand;
	$response['store'] = $store;
	$response['description'] = $description;
	$response['link'] = $link;
	$response['images'] = $images;
	$response['colors'] = $colors;
	echo json_encode($response);


?>