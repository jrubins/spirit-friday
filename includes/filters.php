<?php	
	ini_set('session.bug_compat_warn', 0);
	ini_set('session.bug_compat_42', 0);
	
	
	function filter_string($gender, $product_id, $kinds, $accessories, $brands, $stores, $prices) {
		$product_query = "SELECT * FROM product";
		
		if((count($_SESSION['filter']) != 0) || (count($_SESSION['brand']) != 0) || (count($_SESSION['store']) != 0) || (count($_SESSION['price']) != 0)) {
			if($gender != "both") {
				$product_query .= " WHERE gender='$gender'";
				if($product_id) {
					$product_query .= " AND product_id=$product_id";
				} else {
					$product_query .= "";
				}
			} else {
				$product_query .= " WHERE ";
				if($product_id) {
					$product_query .= "product_id=$product_id";
				} else {
					$product_query .= "";
				}
			}
			
			if(count($_SESSION['filter']) != 0) {
				$product_query .= " AND (";
				$product_query .= add_filters($kinds, $accessories);
			}
			if(count($_SESSION['brand']) != 0) {
				$product_query .= " AND (";
				$product_query .= add_brands($brands);
			}
			if(count($_SESSION['store']) != 0) {
				$product_query .= " AND (";
				$product_query .= add_stores($stores);
			}
			if(count($_SESSION['price']) != 0) {
				$product_query .= " AND (";
				$product_query .= add_prices($prices);
			}
		} else {
			if($gender != "both") {
				$product_query .= " WHERE gender='$gender'";
				if($product_id) {
					$product_query .= " AND product_id=$product_id";
				}
			} else {
				if($product_id) {
					$product_query .= " WHERE product_id=$product_id";
				}
			}
		}
		
		return $product_query;
	}
	
	function add_filters($kinds, $accessories) {
		$filters_query = "";
		if(count($_SESSION['filter']) != 0) {
			/*echo "<br />";
			echo "in filters";
			echo count($_SESSION['filter']);*/
			$i = 1;
			foreach($_SESSION['filter'] as $filter) {
				//echo $filter;
				if($i != count($_SESSION['filter'])) {
					//echo "h2";
					//echo count($_SESSION['filter']);
					/*foreach($_SESSION['filter'] as $filter) {
						echo "<p>" . $filter . "</p>";
					}*/
					if(in_array($filter, array_keys($kinds))) {
						if($filter == "bottoms") {
							$filters_query .= "kind='" . $kinds[$filter][0] . "' OR kind='" . $kinds[$filter][1] . "' OR ";
						} else {
							$filters_query .= "kind='" . $kinds[$filter] . "' OR ";
						}
					} else if(in_array($filter, array_keys($accessories))) {
						if($filter == "headwear") {
							$filters_query .= "kind='" . $accessories[$filter][0] . "' OR kind='" . $accessories[$filter][1] . "' OR ";
						} else {
							$filters_query .= "kind='" . $accessories[$filter] . "' OR ";
						}
					}
				} else {
					//echo "here";
					if(in_array($filter, array_keys($kinds))) {
						if($filter == "bottoms") {
							$filters_query .= "kind='" . $kinds[$filter][0] . "' OR kind='" . $kinds[$filter][1] . "') ";
						} else {
							$filters_query .= "kind='" . $kinds[$filter] . "') ";
						}
					} else if(in_array($filter, array_keys($accessories))) {
						if($filter == "headwear") {
							$filters_query .= "kind='" . $accessories[$filter][0] . "' OR kind='" . $accessories[$filter][1] . "') ";
						} else {
							$filters_query .= "kind='" . $accessories[$filter] . "') ";
						}
					}
				}
				$i++;
			}
		}
		return $filters_query;
	}
	
	function add_brands($brands) {
		$brand_query = "";
		if(isset($_SESSION['brand']) && count($_SESSION['brand']) != 0) {
			//echo "in brands";
			$i = 1;
			foreach($_SESSION['brand'] as $brand) {
				//echo $brand;
				if($i != count($_SESSION['brand'])) {
					if(in_array($brand, $brands)) {
						$brand_query .= "brand='" . array_search($brand, $brands) . "' OR ";
					} 
				} else {
					if(in_array($brand, $brands)) {
						//echo "also in brands";
						$brand_query .= "brand='" . array_search($brand, $brands) . "') ";
					} 
				}
				$i++;
			}
		}
		return $brand_query;
	}
	
	function add_stores($stores) {
		$store_query = "";
		if(count($_SESSION['store']) != 0) {
			//echo "in stores";
			$i = 1;
			foreach($_SESSION['store'] as $store) {
				//echo $store;
				if($i != count($_SESSION['store'])) {
					if(in_array($store, $stores)) {
						$store_query .= "merchant='" . array_search($store, $stores) . "' OR ";
					} 
				} else {
					if(in_array($store, $stores)) {
						//echo "also in stores";
						$store_query .= "merchant='" . array_search($store, $stores) . "') ";
					} 
				}
				$i++;
			}
		}
		return $store_query;
	}
	
	function add_prices($prices) {
		$price_query = "";
		if(count($_SESSION['price']) != 0) {
			//echo "in prices";
			$i = 1;
			foreach($_SESSION['price'] as $price) {
				//echo $price;
				if($i != count($_SESSION['price'])) {
					if(in_array($price, array_keys($prices))) {
						if($price == "$0-$25") {
							$price_query .= "(price >= " . $prices[$price] . " AND price <= 25) OR ";
						} else if($price == "$25-$50") {
							$price_query .= "(price >= " . $prices[$price] . " AND price <= 50) OR ";
						} else if($price == "$50-$100") {
							$price_query .= "(price >= " . $prices[$price] . " AND price <= 100) OR ";
						} else if($price == "$100-$175") {
							$price_query .= "(price >= " . $prices[$price] . " AND price <= 175) OR ";
						} else if($price == "$175-$250") {
							$price_query .= "(price >= " . $prices[$price] . " AND price <= 249) OR ";
						} else if($price == "$250+") {
							$price_query .= "(price >= " . $prices[$price] . ") OR ";
						}
					}
				} else {
					if($price == "$0-$25") {
						$price_query .= "(price >= " . $prices[$price] . " AND price <= 25)) ";
					} else if($price == "$25-$50") {
						$price_query .= "(price >= " . $prices[$price] . " AND price <= 50)) ";
					} else if($price == "$50-$100") {
						$price_query .= "(price >= " . $prices[$price] . " AND price <= 100)) ";
					} else if($price == "$100-$175") {
						$price_query .= "(price >= " . $prices[$price] . " AND price <= 175)) ";
					} else if($price == "$175-$250") {
						$price_query .= "(price >= " . $prices[$price] . " AND price <= 249)) ";
					} else if($price == "$250+") {
						$price_query .= "(price >= " . $prices[$price] . ")) ";
					}
				}
				$i++;
			}
		}
		return $price_query;
	}


?>