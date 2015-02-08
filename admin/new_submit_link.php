<?php
	session_start();
	if(!$_SESSION['admin']) {
		header("Location: index.php");
	}

	require_once('../includes/database.php');
	db_connect();
	
	$brands = array();
	$stores = array();
	
	$brand_fp = fopen('../logs/brands.txt', 'r');
	$store_fp = fopen('../logs/stores.txt', 'r');
		
	while(!feof($brand_fp)) {
		$brand_v = trim(fgets($brand_fp, 1024));
		$brand_h = trim(fgets($brand_fp, 1024));
		if(($brand_v != '') && ($brand_h != '')) {
			$brands[$brand_v] = $brand_h;
		}
	}
	fclose($brand_fp);
	while(!feof($store_fp)) {
		$store_v = trim(fgets($store_fp, 1024));
		$store_h = trim(fgets($store_fp, 1024));
		if(($store_v != '') && ($store_h != '')) {
			$stores[$store_v] = $store_h;
		}
	}
	fclose($store_fp);
	
	
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
								
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$link = $_POST['link'];
		$item_name = $_POST['item_name'];
		$gender = $_POST['gender'];
		$kind = $_POST['kind'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$brand = $_POST['brand'];
		$store = $_POST['store'];
		
		$images = json_decode($_POST['images']);
		$colors = json_decode($_POST['colors']);
				
		if(!in_array($brand, array_keys($brands))) {
			$brand_fp = fopen('../logs/brands.txt', 'a');
			$brand_v = strtolower($brand);
			$brand_v = str_replace(" ", "_", $brand_v);
			$brand = $brand_v;
			fwrite($brand_fp, $brand_v . "\n");
			fwrite($brand_fp, $brand . "\n");
		}
		if(!in_array($store, array_keys($stores))) {
			$store_fp = fopen('../logs/stores.txt', 'a');
			$store_v = strtolower($store);
			$store_v = str_replace(" ", "_", $store_v);
			$store = $store_v;
			fwrite($store_fp, $store_v . "\n");
			fwrite($store_fp, $store . "\n");
		}
		
		$response = array();
		
		$check_duplicate = "SELECT * FROM product WHERE link='" . $link . "';";
		if(!($check_duplicate_result = mysql_query($check_duplicate))) {
			// return mysql error
			$response['success'] = "false";
			$response['error'] = mysql_error();
			echo json_encode($response);
			die();
		}
		
		if(mysql_num_rows($check_duplicate_result) != 0) {
			// don't enter into product table, only color entry
			$product = mysql_fetch_assoc($check_duplicate_result);
			$product_id = $product['product_id'];
			
			$i = 0;
			foreach($images as $image_link) {
				$insert_color_query = "INSERT INTO color(product_id, image_url, color_count";
				foreach($check_colors as $color) {
					$insert_color_query .= "," . $color;
				}
				$insert_color_query .= ") VALUES ($product_id, '$image_link', " . count($colors[$i]);
				foreach(array_keys($check_colors) as $color) {
					if(in_array($color, $colors[$i])) {
						$insert_color_query .= ",1";
					} else {
						$insert_color_query .= ",0";
					}
				}
				$insert_color_query .= ");";
				if(!mysql_query($insert_color_query)) {
					// return mysql error
					$response['success'] = "false";
					$response['error'] = mysql_error();
					echo json_encode($response);
					die();
				}
				$i++;
			}
			
			$response['success'] = "true";
			echo json_encode($response);
		} else { // not an entry in the product table already
			$insert_product_query = "INSERT INTO product (item_name, gender, kind, price, link, brand, merchant, description) VALUES ";
			$insert_product_query .= "('" . mysql_real_escape_string($item_name) . "','$gender','$kind',";
			$insert_product_query .= "$price,'" . mysql_real_escape_string($link) . "','" . mysql_real_escape_string($brand) . "', '" . mysql_real_escape_string($store) . "', '" . mysql_real_escape_string($description) . "');";
			
			if(!mysql_query($insert_product_query)) {
				// return mysql error
				$response['success'] = "false";
				$response['error'] = mysql_error();
				echo json_encode($response);
				die();
			}
			
			$product_id_query = "SELECT * FROM product WHERE link='" . $link . "';";
			if(!($product_id_result = mysql_query($product_id_query))) {
				// return mysql error
				$response['success'] = "false";
				$response['error'] = mysql_error();
				echo json_encode($response);
				die();
			}
			$product = mysql_fetch_assoc($product_id_result);
			$product_id = $product['product_id'];
			
			$i = 0;
			foreach($images as $image_link) {
				$insert_color_query = "INSERT INTO color(product_id, image_url, color_count";
				foreach($check_colors as $color) {
					$insert_color_query .= "," . $color;
				}
				$insert_color_query .= ") VALUES ($product_id, '$image_link', " . count($colors[$i]);
				foreach(array_keys($check_colors) as $color) {
					if(in_array($color, $colors[$i])) {
						$insert_color_query .= ",1";
					} else {
						$insert_color_query .= ",0";
					}
				}
				$insert_color_query .= ");";
				if(!mysql_query($insert_color_query)) {
					// return mysql error
					$response['success'] = "false";
					$response['error'] = mysql_error();
					echo json_encode($response);
					die();
				}
				$i++;
			}
			
			$fp = fopen("../logs/link_file.txt", "a");		
			fwrite($fp, "product" . "\n");
			fwrite($fp, $product_id . "\n");
			fwrite($fp, $item_name . "\n");
			fwrite($fp, $gender . "\n");
			fwrite($fp, $kind . "\n");
			fwrite($fp, $price . "\n");
			fwrite($fp, "@@\n");
			fwrite($fp, $description . "\n");
			fwrite($fp, "@@\n");
			fwrite($fp, $link . "\n");
			fwrite($fp, $brand . "\n");
			fwrite($fp, $store . "\n");
			fwrite($fp, "image" . "\n");
			$i = 0;
			foreach($images as $image_link) {
				fwrite($fp, $image_link . "\n");
				fwrite($fp, "color" . "\n");
				foreach($colors[$i] as $color) {
					fwrite($fp, $color . "\n");
				}
				$i++;
			}
			fwrite($fp, "*" . "\n");
			fclose($fp);
			
			// return success
			$response['success'] = "true";
			echo json_encode($response);
		} // end else for check for duplicate product
	}
	
?>