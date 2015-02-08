<?php
	// make sure this is an admin
	session_start();
	if(!$_SESSION['admin']) {
		header("Location: ../index.php");
	}
	
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

?>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".color a").live('click', function() {
					if(!$(this).hasClass("selected")) {
						$(this).css("width", "23px");
						$(this).css("height", "23px");
						$(this).css("border", "2px solid #000");
						$(this).addClass("selected");
						$(this).parent().addClass("selected");
					} else {
						$(this).css("width", "25px");
						$(this).css("height", "25px");
						$(this).css("border", "none");
						$(this).removeClass("selected");
						$(this).parent().removeClass("selected");
					}
				});

				$(".remove_link").live('click', function() {
					var parent_tr = $(this).parents("tr");
					if(parent_tr.hasClass("last_image_link")) {
						parent_tr.prev("tr").addClass("last_colors");
						parent_tr.prev("tr").prev("tr").addClass("last_image_link");
					}
					parent_tr.next("tr").remove();
					parent_tr.remove();
				});

				$("a[name='add_link']").on('click', function() {
					$(".last_image_link").removeClass("last_image_link");
					$(".last_colors").removeClass("last_colors").after("<tr class='last_image_link'><td><p class='image_label'>Enter image link:</p></td><td><input class='enter_image' type='text' name='image_link' /> <a class='remove_link' href='javascript:void'>Remove Link</a></td></tr><tr class='last_colors'><td><p class='color_label'>Select your colors:</p></td><td><div class='colors' style='overflow:auto;background:#888;'><?php foreach(array_keys($colors) as $color) { echo "<div class='color' style='margin: 5px 5px;float:left;'><a href='javascript:void' style='display:block;width:25px;height:25px;background:" . $color . ";'></a></div>"; } ?></div></td></tr>");
				});

				$("#enter_form select[name='enter_gender']").change(function() {
					if($(this).val() == "male") {
						$("#enter_form select[name='enter_men_type']").show();
						$("#enter_form select[name='enter_women_type']").hide();
						$("#enter_form select[name='enter_women_type']").val("blank");
					} else if($(this).val() == "female") {
						$("#enter_form select[name='enter_men_type']").hide();
						$("#enter_form select[name='enter_men_type']").val("blank");
						$("#enter_form select[name='enter_women_type']").show();
					} else {
						$("#enter_form select[name='enter_men_type']").val("blank");
						$("#enter_form select[name='enter_women_type']").val("blank");
						$("#enter_form select[name='enter_men_type']").hide();
						$("#enter_form select[name='enter_women_type']").hide();
					}
				});
				
				$("#enter_form").submit(function(event) {
					event.preventDefault();	
					
					var link_input = $(this).find('input[name="enter_link"]'),
						gender_input = $(this).find('select[name="enter_gender"]'),
						women_type_input = $(this).find('select[name="enter_women_type"]'),
						men_type_input = $(this).find('select[name="enter_men_type"]'),
						item_name_input = $(this).find('input[name="enter_item_name"]'),
						price_input = $(this).find('input[name="enter_price"]'),
						description_input = $(this).find('textarea[name="enter_description"]'),
						brand_input = $(this).find('select[name="enter_brand"]'),
						brand_other_input = $(this).find('input[name="enter_brand_other"]'),
						store_input = $(this).find('select[name="enter_store"]'),
						store_other_input = $(this).find('input[name="enter_store_other"]');
					
					var enter_link = link_input.val(),
						enter_gender = gender_input.val(),
						enter_item_name = item_name_input.val(),
						enter_price = price_input.val(),
						enter_description = description_input.val(),
						enter_brand = brand_input.val(),
						enter_brand_other = brand_other_input.val(),
						enter_store = store_input.val(),
						enter_store_other = store_other_input.val();
							
					
					var image_entries = [];
					$(this).find('.enter_image').each(function() {
						image_entries.push($(this).val());
					});
					/*$.each(image_entries, function(index, item) {
						alert(item);
					});
					alert(JSON.stringify(image_entries));
					*/
					
					var colors = [];
					$(this).find('.colors').each(function() {
						colors.push(jQuery.makeArray($(this).find("a.selected").map(function() {
							return $(this).css("background-color");
						})));
						//alert(colors[color_entry_id]);
					});
					
					//alert(JSON.stringify(colors));

					var error = false;
					var other_brand = false;
					var other_store = false;
					// check data to make sure it's ok to submit
					if(enter_link == "") {
						error = true;
						link_input.addClass("input_error");
						$("#enter_form p[name='link_label']").addClass("label_error");
					} else {
						if(!error) error = false;
						link_input.removeClass("input_error");
						$("#enter_form p[name='link_label']").removeClass("label_error");
					}
					
					if(enter_gender == "male") {
						gender_input.removeClass("input_error");
						$("#enter_form p[name='gender_label']").removeClass("label_error");
						if(men_type_input.val() != "blank") {
							if(!error) error = false;
							var enter_kind = men_type_input.val();
							men_type_input.removeClass("input_error");
							$("#enter_form p[name='men_type_label']").removeClass("label_error");
						} else {
							error = true;
							men_type_input.addClass("input_error");
							$("#enter_form p[name='men_type_label']").addClass("label_error");
						}
					} else if(enter_gender == "female") {
						gender_input.removeClass("input_error");
						$("#enter_form p[name='gender_label']").removeClass("label_error");
						if(women_type_input.val() != "blank") {
							if(!error) error = false;
							var enter_kind = women_type_input.val();
							women_type_input.removeClass("input_error");
							$("#enter_form p[name='women_type_label']").removeClass("label_error");
						} else {
							error = true;
							women_type_input.addClass("input_error");
							$("#enter_form p[name='women_type_label']").addClass("label_error");
						}
					} else {
						error = true;
						gender_input.addClass("input_error");
						$("#enter_form p[name='gender_label']").addClass("label_error");
					}
					
					if(enter_item_name == "") {
						error = true;
						item_name_input.addClass("input_error");
						$("#enter_form p[name='item_name_label']").addClass("label_error");
					} else {
						if(!error) error = false;
						item_name_input.removeClass("input_error");
						$("#enter_form p[name='item_name_label']").removeClass("label_error");
					}
					
					if(enter_price == "") {
						error = true;
						price_input.addClass("input_error");
						$("#enter_form p[name='price_label']").addClass("label_error");
					} else {
						if(!error) error = false;
						price_input.removeClass("input_error");
						$("#enter_form p[name='price_label']").removeClass("label_error");
					}
					
					if(enter_description == "") {
						error = true;
						description_input.addClass("input_error");
						$("#enter_form p[name='description_label']").addClass("label_error");
					} else {
						if(!error) error = false;
						description_input.removeClass("input_error");
						$("#enter_form p[name='description_label']").removeClass("label_error");
					}
					
					if(enter_brand == "blank" && enter_brand_other == "") {
						error = true;
						brand_input.addClass("input_error");
						brand_other_input.addClass("input_error");
						$("#enter_form p[name='brand_label']").addClass("label_error");
						$("#enter_form p[name='brand_other_label']").addClass("label_error");
					} else if(enter_brand != "blank" && enter_brand_other != "") {
						error = true;
						brand_input.addClass("input_error");
						brand_other_input.addClass("input_error");
						$("#enter_form p[name='brand_label']").addClass("label_error");
						$("#enter_form p[name='brand_other_label']").addClass("label_error");
						$("#multiple_brands").text("Please only enter one option for brand.");
					} else {
						if(!error) error = false;
						$("#multiple_brands").text("");
						brand_input.removeClass("input_error");
						brand_other_input.removeClass("input_error");
						$("#enter_form p[name='brand_label']").removeClass("label_error");
						$("#enter_form p[name='brand_other_label']").removeClass("label_error");
						if(enter_brand_other != "") {
							other_brand = true;
							enter_brand = enter_brand_other;
						}
					}
					
					if(enter_store == "blank" && enter_store_other == "") {
						error = true;
						store_input.addClass("input_error");
						store_other_input.addClass("input_error");
						$("#enter_form p[name='store_label']").addClass("label_error");
						$("#enter_form p[name='store_other_label']").addClass("label_error");
					} else if(enter_store != "blank" && enter_store_other != "") {
						error = true;
						store_input.addClass("input_error");
						store_other_input.addClass("input_error");
						$("#enter_form p[name='store_label']").addClass("label_error");
						$("#enter_form p[name='store_other_label']").addClass("label_error");
						$("#multiple_stores").text("Please only enter one option for store.");
					} else {
						if(!error) error = false;
						$("#multiple_stores").text("");
						store_input.removeClass("input_error");
						store_other_input.removeClass("input_error");
						$("#enter_form p[name='store_label']").removeClass("label_error");
						$("#enter_form p[name='store_other_label']").removeClass("label_error");
						if(enter_store_other != "") {
							other_store = true;
							enter_store = enter_store_other;
						}
					}
					
					
					$('.enter_image').each(function() {
						if($(this).val() == "") {
							error = true;
							$(this).addClass("input_error");
							$(this).parent("td").siblings("td").find(".image_label").addClass("label_error");
						} else {
							if(!error) error = false;
							$(this).removeClass("input_error");
							$(this).parent("td").siblings("td").find(".image_label").removeClass("label_error");
						}
					});
					
					$(this).find('.colors').each(function() {
						if(jQuery.makeArray($(this).find("a.selected").map(function() {
							return $(this).css("background-color");
						})).length == 0) {
							error = true;
							$(this).addClass("input_error");
							$(this).parent("td").siblings("td").find(".color_label").addClass("label_error");
						} else {
							if(!error) error = false;
							$(this).removeClass("input_error");
							$(this).parent("td").siblings("td").find(".color_label").removeClass("label_error");
						}
						//alert(colors[color_entry_id]);
					});		
					
					if(!error) {
						//alert("here");
						$.post(
							"new_submit_link.php",
							{ link: enter_link, item_name: enter_item_name, gender: enter_gender, kind: enter_kind, price: enter_price, description: enter_description, brand: enter_brand, store: enter_store, images: JSON.stringify(image_entries), colors: JSON.stringify(colors) },
							function(data) {
								//alert(data);
								var response = jQuery.parseJSON(data);
								if(response.success == "true") {
									alert("Success!");
									// add other brand or other store to select list
									if(other_brand) {
										var brand_key = enter_brand_other.toLowerCase();
										brand_key = brand_key.replace(/\s+/g, "_");
										brand_input.append($("<option></option>").attr("value", brand_key).text(enter_brand_other));
									}
									if(other_store) {
										var store_key = enter_store_other.toLowerCase();
										store_key = store_key.replace(/\s+/g, "_");
										store_input.append($("<option></option>").attr("value", store_key).text(enter_store_other));
									}
									// remove all the existing values
									link_input.val("");
									gender_input.val("blank");
									women_type_input.val("blank");
									men_type_input.val("blank");
									women_type_input.hide();
									men_type_input.hide();
									item_name_input.val("");
									price_input.val("");
									description_input.val("");
									brand_input.val("blank");
									brand_other_input.val("");
									store_input.val("blank");
									store_other_input.val("");
									$('#enter_form .colors').each(function() {
										var parent_tr = $(this).parents("tr");
										if(!parent_tr.hasClass("last_colors")) {
											parent_tr.remove();
										}
									});
									$('#enter_form .enter_image').each(function() {
										var parent_tr = $(this).parents("tr");
										if(!parent_tr.hasClass("last_image_link")) {
											parent_tr.remove();
										}
									});
									$('#enter_form .enter_image').each(function() {
										$(this).val("");
									});
									$('#enter_form .remove_link').remove();
									$('#enter_form .colors a').each(function() {
										if($(this).hasClass("selected")) {
											$(this).css("width", "25px");
											$(this).css("height", "25px");
											$(this).css("border", "none");
											$(this).removeClass("selected");
											$(this).parent("div").removeClass("selected");
										}
									});
								} else if(response.success == "false") {
									alert("Failed. " + response.error);
								} else {
									alert("Shouldn't happen");
								}
							}
						);
					}
				});
			}); // end document.ready
		</script>
		<link href="../css/enter_links.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<form action="submit_link.php" method="POST" id="enter_form">
			<table>
				<tr>
					<td><p name="link_label">Enter product link:</p></td>
					<td><input type="text" name="enter_link" /></td>
				</tr>
				
				<tr class="last_image_link">
					<td><p class="image_label">Enter image link:</p></td>
					<td><input class="enter_image" type="text" name="enter_image" /></td>
				</tr>
				<tr class='last_colors'>
					<td><p class="color_label">Select your colors:</p></td>
					<td>
					<div class='colors' style='overflow:auto;background:#888;'>
						<?php
							foreach(array_keys($colors) as $color) {
								echo "<div class='color' style='margin: 5px 5px;float:left;'><a href='javascript:void' style='display:block;width:25px;height:25px;background:" . $color . ";'></a></div>";
							}
						?>				
					</div>
					</td>
				</tr>
				<tr>
					<td><a href="javascript:void" name="add_link">Add Link</a></td>
				</tr>
				<tr>
					<td><p name="gender_label">Select gender:<p></td>
					<td><select name="enter_gender"><option value="blank"></option><option value="male">Male</option><option value="female">Female</option></select></td>
				</tr>
				<tr>
					<td><p name="women_type_label">Enter women type:</p></td>
					<td><select id="women_type" name="enter_women_type" style="display:none;">
						<option value="blank"></option>
						<?php
							foreach(array_keys($women_kinds) as $kind_key) {
								if($kind_key == "bottoms") {
									foreach($women_kinds[$kind_key] as $kind) {
										echo "<option value='$kind'>$kind</option>";
									}
								} else {
									echo "<option value='$women_kinds[$kind_key]'>$women_kinds[$kind_key]</option>";
								}
							}
							foreach($women_accessories as $accessory) {
								echo "<option value='$accessory'>$accessory</option>";
							}
						?>
						</select></td>
				</tr>
				<tr>
					<td><p name="men_type_label">Enter men type:</p></td>
					<td><select id="men_type" name="enter_men_type" style="display:none;">
						<option value="blank"></option>
						<?php
							foreach($men_kinds as $kind) {
								echo "<option value='$kind'>$kind</option>";
							}
							foreach(array_keys($men_accessories) as $accessory_key) {
								if($accessory_key == "headwear") {
									foreach($accessory_key as $accessory) {
										echo "<option value='$accessory'>$accessory</option>";
									}
								} else {
									echo "<option value='$men_accessories[$accessory_key]'>$men_accessories[$accessory_key]</option>";
								}
							}
						?>
						</select></td>
				</tr>
				<tr>
					<td><p name="item_name_label">Enter item name:</p></td>
					<td><input type="text" name="enter_item_name" /></td>
				</tr>
				<tr>
					<td><p name="price_label">Enter item price:</p></td>
					<td><input type="text" name="enter_price" /></td>
				</tr>
				<tr>
					<td><p name="description_label">Enter item description:</p></td>
					<td><textarea name="enter_description" rows="8" cols="50"></textarea></td>
				</tr>
				<tr>
					<td><span id="multiple_brands"></span></td>
				</tr>
				<tr>
					<td><p name="brand_label">Enter item brand:</p></td>
					<td><select name="enter_brand">
						<option value="blank"></option>
						<?php
							foreach($brands as $key => $value) {
								echo "<option value='$key'";
								if(isset($brand_val) && ($key == $brand_val)) {
									echo " selected='selected'";
								}
								echo ">" . $value . "</option>";
								
								
							}
						?>
						</select></td>
				</tr>
				<tr>
					<td><p style="text-align:center;font-weight:bold;">Or</p></td>
				</tr>
				<tr>
					<td><p name="brand_other_label">Enter a new brand name:</p></td>
					<td><input type="text" name="enter_brand_other" /></td>
				</tr>
				<tr>
					<td><span id="multiple_stores"></span></td>
				</tr>
				<tr>
					<td><p name="store_label">Enter item store:</p></td>
					<td><select name="enter_store">
						<option value="blank"></option>
						<?php
							foreach($stores as $key => $value) {
								echo "<option value='$key'";
								if(isset($store_val) && ($key == $store_val)) {
									echo "selected='selected'";
								}
								echo ">" . $value . "</option>";
							}
						?>
						</select></td>
				</tr>
				<tr>
					<td><p style="text-align:center;font-weight:bold;">Or</p></td>
				</tr>
				<tr>
					<td><p name="store_other_label">Enter a new store name:</p></td>
					<td><input type="text" name="enter_store_other" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Submit" /></td>
				</tr>
		</form>
	</body>
</html>