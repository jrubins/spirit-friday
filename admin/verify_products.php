<?php
	session_start();
	require_once('../includes/database.php');
	db_connect();
	if(!$_SESSION['admin']) {
		header("Location: ../index.php");
	}
	$colors = array(
		"red" => "rgb(204, 51, 51)",
		"yellow" => "rgb(255, 255, 0)",
		"light_pink" => "rgb(255, 153, 204)",
		"sky_blue" => "rgb(102, 153, 204)",
		"turquoise" => "rgb(51, 204, 255)",
		"beige" => "rgb(255, 255, 204)",
		"white" => "rgb(255, 255, 255)",
		"burgandy" => "rgb(153, 0, 0)",
		"coral" => "rgb(255, 102, 102)",
		"dark_pink" => "rgb(255, 0, 153)",
		"blue" => "rgb(0, 0, 204)",
		"lime_green" => "rgb(0, 204, 51)",
		"gold" => "rgb(204, 153, 0)",
		"grey" => "rgb(102, 102, 102)",
		"burnt_orange" => "rgb(204, 102, 51)",
		"orange" => "rgb(255, 102, 51)",
		"purple" => "rgb(102, 0, 102)",
		"navy" => "rgb(0, 0, 102)",
		"dark_green" => "rgb(0, 102, 0)",
		"brown" => "rgb(102, 51, 0)",
		"black" => "rgb(0, 0, 0)"
	);
	
	$female_kinds = array(
				"dresses" => "dress",
				"skirts" => "skirt",
				"tops" => "top",
				"sweaters" => "sweater",
				"jackets" => "jacket",
				"pants" => "pants", 
				"shorts" => "shorts",
				"shoes" => "shoes",
				"handbags" => "handbag",
				"jewelry" => "jewelry",
				"hair" => "hair",
				"belts" => "belt",
				"miscellaneous" => "miscellaneous");
	
	$male_kinds = array(
				"polos" => "polo",
				"dress shirts" => "dress shirt",
				"t-shirts" => "t-shirt",
				"sweaters" => "sweater",
				"jackets" => "jacket",
				"pants" => "pants",
				"shorts" => "shorts",
				"shoes" => "shoes",
				"ties" => "tie",
				"belts" => "belt",
				"sunglasses" => "sunglasses",
				"hat" => "hat",
				"miscellaneous" => "miscellaneous");
	
	$brands = array();
	$brands_fp = fopen("../logs/brands.txt", "r");
	while(!feof($brands_fp)) {
		$brands_value = trim(fgets($brands_fp, 1024));
		if($brands_value != "") {
			$brands_key = trim(fgets($brands_fp, 1024));
			$brands[$brands_key] = $brands_value;
		}
	}
	
	$stores = array();
	$stores_fp = fopen("../logs/stores.txt", "r");
	while(!feof($stores_fp)) {
		$stores_value = trim(fgets($stores_fp, 1024));
		if($stores_value != "") {
			$stores_key = trim(fgets($stores_fp, 1024));
			$stores[$stores_key] = $stores_value;
		}
	}
?>
<link href="../css/verify.css" type="text/css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {	
		$(".delete_image").on('click', function() {
			var color_entry = $(this).siblings("input[name='edit_image']").attr("class");
			var parent_p = $(this).parent("p"),
				prev_p = $(this).parent("p").prev("p"),
				next_p = $(this).parent("p").next("div.colors");
			//alert(color_entry);
			$.post(
				"delete_color.php",
				{ id: color_entry },
				function(data) { 
					var response = jQuery.parseJSON(data);
					alert("Color Entry: " + response.id + " successfully deleted.");
					parent_p.remove();
					prev_p.remove();
					next_p.remove();
					$(".product").find("img." + color_entry).parent("p").remove();
					$(".product").find("div.colors." + color_entry).remove();
				}
			);
		});
		
		$(".product_delete").on('click', function() {
			$(this).hide();
			$(this).siblings(".confirm_delete").show();
		});
		
		$(".yes_delete").on('click', function() {
			var product_wrapper = $(this).parents(".product_wrapper");
			var product_id = product_wrapper.find('input[name="product_id"]').val();
			$.post(
				"delete_product.php",
				{ id: product_id },
				function(data) { 
					var response = jQuery.parseJSON(data);
					alert("Product ID: " + response.id + " successfully deleted.");
					product_wrapper.remove();
				}
			);
		});
		
		$(".no_delete").on('click', function() {
			$(this).parents(".product").find(".product_delete").show();
			$(this).parent().hide();
		});
		
		$(".edit_form .img_color a").on('click', function() {
			if(!$(this).hasClass("selected")) {
				$(this).css("width", "28px");
				$(this).css("height", "28px");
				$(this).css("border", "2px solid #000");
				$(this).parent().addClass("selected");
				$(this).addClass("selected");
			} else {
				$(this).css("width", "30px");
				$(this).css("height", "30px");
				$(this).css("border", "none");
				$(this).parent().removeClass("selected");
				$(this).removeClass("selected");
			}
		});
	
		$(".product_edit").on('click', function() {
			$(this).parents(".product").siblings(".edit_product").show();
			$(this).parents(".product").hide();
		});
		
		$(".edit_form select[name='gender']").change(function() {
			if($(this).val() == "male") {
				var male_kinds = <?php echo json_encode($male_kinds); ?>;
				var kinds_input = $(".edit_form select[name='kind']");
				kinds_input.empty();
				kinds_input.append("<option value='blank'></option>");
				$.each(male_kinds, function(index, item) {
					kinds_input.append("<option value='" + item + "'>" + item + "</option>");
				});
			} else {
				var female_kinds = <?php echo json_encode($female_kinds); ?>;
				var kinds_input = $(".edit_form select[name='kind']");
				kinds_input.empty();
				kinds_input.append("<option value='blank'></option>");
				$.each(female_kinds, function(index, item) {
					kinds_input.append("<option value='" + item + "'>" + item + "</option>");
				});
			}
		});
		
		$(".edit_form").submit(function(event) {
			event.preventDefault();
			
			var edit_product = $(this).parent();			
			var product = edit_product.siblings(".product");
			
			
			var product_id = $(this).find('input[name="product_id"]').val(),
				edit_name = $(this).find('input[name="item_name"]').val(),
				edit_gender = $(this).find('select[name="gender"]').val(),
				edit_kind = $(this).find('select[name="kind"]').val(),
				edit_price = $(this).find('input[name="price"]').val(),
				edit_brand = $(this).find('select[name="brand"]').val(),
				edit_store = $(this).find('select[name="store"]').val(),
				edit_description = $(this).find('textarea[name="description"]').val(),
				edit_link = $(this).find('input[name="link"]').val();
		
			/*alert(edit_gender);
			alert(edit_kind);
			alert(edit_price);
			alert(edit_brand);
			alert(edit_store);
			alert(edit_description);
			alert(edit_link);
			*/
			
			var num_color_entries = $(this).find('input[name="color_entries"]').val();
			
			var image_links = {};
			var colors = {};
			$(this).find('input[name="color_id"]').each(function() {
				//alert($(this).val());
				var color_entry_id = $(this).val();
				var image_link = $(this).parent().find('input[name="edit_image"].' + color_entry_id).val();
				//alert(image_link);
				image_links[color_entry_id] = image_link;
				//alert(image_links[color_entry_id]);
				colors[color_entry_id] = jQuery.makeArray($(this).siblings(".colors." + $(this).val()).find(".img_color a.selected").map(function() {
					return $(this).css("background-color");
				}));
				//alert(colors[color_entry_id]);
			});
			
			//alert(JSON.stringify(colors));
			//alert(JSON.stringify(image_links));
			/*$.each(image_links, function(index, item) {
				alert(item);
			});*/
			/*$.each(colors, function(index, item) {
				alert(item);
				$.each(item, function(index2, item2) {
					alert(item2);
				});
			});*/
			
			$.post(
				"update_product.php",
				{ id: product_id, item_name: edit_name, gender: edit_gender, kind: edit_kind, price: edit_price, brand: edit_brand, store: edit_store, description: edit_description, link: edit_link, "images": JSON.stringify(image_links), "edit_colors": JSON.stringify(colors) },
				function(data) {
					var response = jQuery.parseJSON(data);
					
					product.find(".product_name").text(response.item_name);
					product.find(".product_link").attr("href", response.link);
					product.find(".product_gender").text(response.gender.toLowerCase());
					product.find(".product_kind").text(response.kind);
					product.find(".product_price").text(response.price);
					product.find(".product_brand").text(response.brand);
					product.find(".product_store").text(response.store);
					product.find(".product_description").text(response.description);
					
					$.each(response.images, function(index, item) {
						//alert(item);
						$(".product img." + index).attr("src", item);
						edit_product.find("img." + index).attr("src", item);
						/*for(var i in item) {
							//alert(item[i]);
							//alert(".product img." + i);
							//alert($(".product img." + i).attr("src"));
							
						}*/
					});
					
					//alert(response.colors);
					var php_colors = <?php echo json_encode($colors); ?>;
					$.each(response.colors, function(index, item) {
						//alert(item);
						//alert(index);
						var color_entry = index;
						//alert(".product .colors." + color_entry);
						var colors_div = $(".product .colors." + color_entry);
						colors_div.empty();
						for(var i in item) {
							//alert(item[i]);
							var cur_color = item[i];
							var color_name;
							$.each(php_colors, function(index2, item2) {
								//alert(item);
								if(item2 == cur_color) {
									//alert(index2);
									color_name = index2;
								}
							});
							//$(this).find('input[name="color_id"][value="' + color_entry + '"]').
							colors_div.append("<div class='img_color'><a href='javascript:void' style='background:" + cur_color + "'></a><p>" + color_name + "</p></div>");
						}
					});
					product.show();
					edit_product.hide();
					$('html,body').animate({scrollTop: product.offset().top - 10}, 'slow');
					
				}
			);
		});
		
	});
</script>
<?php
	
	$product_query = "SELECT * FROM product";
	if(!($product_result = mysql_query($product_query))) {
		die(mysql_error());
	}
	while($product_row = mysql_fetch_array($product_result)) {
		if($product_row['gender'] == "female") {
			$kinds = $female_kinds;
		} else {
			$kinds = $male_kinds;
		}
		
		$color_query = "SELECT * FROM color WHERE product_id=" . $product_row['product_id'];
		if(!($color_result = mysql_query($color_query))) {
			die(mysql_error());
		}
		echo "<div class='product_wrapper'>";
		echo "<div class='product'>";
		echo "<p>Product ID: " . $product_row['product_id'] . " <a class='product_edit' href='javascript:void'>Edit</a> <a class='product_delete' href='javascript:void'>Delete</a> <span class='confirm_delete' href='javascript:void'>Are you sure you want to delete? <a href='javascript:void' class='yes_delete'>Yes</a> <a href='javascript:void' class='no_delete'>No</a></span></p>";
		echo "<p>Item Name: <span class='product_name'>" . $product_row['item_name'] . "</span></p>";
		echo "<p>Gender: <span class='product_gender'>" . $product_row['gender'] . "</span></p>";
		echo "<p>Kind: <span class='product_kind'>" . $product_row['kind'] . "</p>";
		echo "<p>Price: $<span class='product_price'>" . $product_row['price'] . "</p>";
		echo "<p>Brand: <span class='product_brand'>" . $product_row['brand'] . "</p>";
		echo "<p>Store: <span class='product_store'>" . $product_row['merchant'] . "</p>";
		echo "<p>Description: <span class='product_description'>" . $product_row['description'] . "</p>";
		echo "<p><a class='product_link' target='_blank' href='" . $product_row['link'] . "'>Product Link</a></p>";
		while($color_row = mysql_fetch_array($color_result)) {
			echo "<p><img class='" . $color_row['id'] . "' src='" . $color_row['image_url'] . "' />";
			echo "<div class='colors " . $color_row['id'] . "'>";
			foreach(array_keys($colors) as $color) {
				if($color_row[$color] == 1) {
					echo "<div class='img_color'><a href='javascript:void' style='background:" . $colors[$color] . "'></a><p>" . $color . "</p></div>";
				}
			}
			echo "</div>";
			echo "</p>";
		}
		
		echo "</div>";
		echo "<div class='edit_product'>";
			echo "<form action='/' class='edit_form'>";
			
			echo "<p>Product ID: " . $product_row['product_id'] . "</p>";
			echo "<input type='hidden' name='product_id' value='" . $product_row['product_id'] . "' />";
			
			echo "<p>Item Name: <input name='item_name' type='text' value='" . $product_row['item_name'] . "' /></p>";
			
			echo "<p>Gender: <select name='gender'><option value='male' ";
			if($product_row['gender'] == 'male') { 
				echo "selected='selected'";
			}
			echo ">Male</option><option value='female' ";
			if($product_row['gender'] == 'female') { 
				echo "selected='selected'";
			}
			echo ">Female</option></select></p>";
			
			echo "<p>Kind: <select name='kind'><option value='blank'></option>";
			foreach($kinds as $kind) {
				if(is_array($kind)) {
					foreach($kind as $in_kind) {
						echo "<option";
						if($in_kind == $product_row['kind']) {
							echo " selected='selected'";
						}
						echo ">" . $in_kind . "</option>";
					}
				} else {
					echo "<option";
					if($kind == $product_row['kind']) {
						echo " selected='selected'";
					}
					echo ">" . $kind . "</option>";
				}
			}
			echo "</select></p>";
			
			echo "<p>Price: $<input name='price' type='text' value='" . $product_row['price'] . "' /></p>";
			
			echo "<p>Brand: <select name='brand'>";
			foreach($brands as $brand) {
				echo "<option";
				if($brand == $product_row['brand']) {
					echo " selected='selected'";
				}
				echo ">" . $brand . "</option>";
			}
			echo "</select></p>";
			
			echo "<p>Store: <select name='store'>";
			foreach($stores as $store) {
				echo "<option";
				if($store == $product_row['merchant']) {
					echo " selected='selected'";
				}
				echo ">" . $store . "</option>";
			}
			echo "</select></p>";
			
			echo "<p>Description:</p><p><textarea name='description' rows='10' cols='130'>" . $product_row['description'] . "</textarea></p>";
			
			echo "<p><a target='_blank' href='" . $product_row['link'] . "'>Product Link</a> <input name='link' size='100' type='text' value='" . $product_row['link'] . "' /></p>";
			
			$color_query = "SELECT * FROM color WHERE product_id=" . $product_row['product_id'];
			if(!($color_result = mysql_query($color_query))) {
				die(mysql_error());
			}
			
			echo "<input type='hidden' value='" . mysql_num_rows($color_result) . "' name='color_entries' />";
			
			while($color_row = mysql_fetch_array($color_result)) {
				echo "<input type='hidden' value='" . $color_row['id'] . "' name='color_id' />";
				echo "<p><img class='" . $color_row['id'] . "' src='" . $color_row['image_url'] . "' /></p>";
				echo "<p>Image Link: <input class='" . $color_row['id'] . "' name='edit_image' type='text' size='150' value='" . $color_row['image_url'] . "' /> <a href='javascript:void' class='delete_image'>Delete Image Link</a></p>";
				echo "<div class='colors " . $color_row['id'] . "'>";
				foreach(array_keys($colors) as $color) {
					echo "<div class='img_color";
					if($color_row[$color] == 1) {
						echo " selected";
					}
					echo "'><a href='javascript:void' style='background:" . $colors[$color] . "'";
					if($color_row[$color] == 1) {
						echo " class='selected'";
					}
					echo "></a><p>" . $color . "</p></div>";
				}
				echo "</div>";
				echo "</p>";
			}
			
			//echo "<p><a class='add_color_entry' href='javascript:void'>Add Link</a></p>";
			
			echo "<p><input type='submit' name='submit' value='Save Changes' /></p>";
			
			echo "</form>";
		echo "</div>";
		echo "</div>";
	}
?>