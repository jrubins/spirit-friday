<?php
	session_start();
	require_once('../includes/database.php');
	db_connect();
	if(!$_SESSION['admin']) {
		header("Location: ../index.php");
	}
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
	
	foreach(array_keys($brands) as $brand_key) {
		$fix_brands_query = "UPDATE product SET brand='$brand_key' WHERE brand='" . mysql_real_escape_string($brands[$brand_key]) . "'";
		echo "<p>" . $fix_brands_query . "</p>";
		if(!mysql_query($fix_brands_query)) {
			die(mysql_error());
		}
		echo "<p>Num rows affected: " . mysql_affected_rows() . "</p>";
	}
	
	while(!feof($store_fp)) {
		$store_v = trim(fgets($store_fp, 1024));
		$store_h = trim(fgets($store_fp, 1024));
		if(($store_v != '') && ($store_h != '')) {
			$stores[$store_v] = $store_h;
		}
	}
	fclose($store_fp);
	
	foreach(array_keys($stores) as $store_key) {
		$fix_stores_query = "UPDATE product SET merchant='$store_key' WHERE merchant='" . mysql_real_escape_string($stores[$store_key]) . "'";
		echo "<p>" . $fix_stores_query . "</p>";
		if(!mysql_query($fix_stores_query)) {
			die(mysql_error());
		}
		echo "<p>Num rows affected: " . mysql_affected_rows() . "</p>";
	}
	
?>