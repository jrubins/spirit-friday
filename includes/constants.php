<?php

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
	
	$prices = array(
		"$0-$25" => "0",
		"$25-$50" => "25",
		"$50-$100" => "50",
		"$100-$175" => "100",
		"$175-$250" => "175",
		"$250+" => "250");

	$women_kinds = array(
			"dresses" => "dress",
			"skirts" => "skirt",
			"tops" => "top",
			"sweaters" => "sweater",
			"jackets" => "jacket",
			"bottoms" => array("pants", "shorts"));
	$women_accessories = array(
			"shoes" => "shoes",
			"handbags" => "handbag",
			"jewelry" => "jewelry",
			"hair" => "hair",
			"belts" => "belt",
			"miscellaneous" => "miscellaneous");
		
	$men_kinds = array(
			"polos" => "polo",
			"dress shirts" => "dress shirt",
			"t-shirts" => "t-shirt",
			"sweaters" => "sweater",
			"jackets" => "jacket",
			"pants" => "pants",
			"shorts" => "shorts");
	$men_accessories = array(
			"shoes" => "shoes",
			"ties" => "tie",
			"belts" => "belt",
			"headwear" => array("sunglasses", "hat"),
			"miscellaneous" => "miscellaneous");
	
	$brands = array();
	$stores = array();
	
	$brand_fp = fopen('logs/brands.txt', 'r');
	$store_fp = fopen('logs/stores.txt', 'r');
		
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

?>