<?php
	session_start();
	require_once('../includes/database.php');
	db_connect();
	if(!$_SESSION['admin']) {
		header("Location: ../index.php");
	}
	
	$check_colors = array("red", "yellow", "light_pink", "sky_blue", "turquoise", "beige", "white", "burgandy", "coral", "dark_pink",
								"blue", "lime_green", "gold", "grey", "burnt_orange", "orange", "purple", "navy", "dark_green", "brown", "black");
	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".update_link_form").submit(function(event) {
			event.preventDefault();
			
			var update_form = $(this);
			var link = $(this).find('input[name="update_link"]').val();
			var link_id = $(this).find('input[name="id"]').val();
			window.alert(link);
			window.alert(link_id);
			
			$.post(
				"update_link.php",
				{ id: link_id, update_link: link },
				function(data) {
					//alert(data);
					var response = jQuery.parseJSON(data);
					if(response.code == "success") {
						alert("Success!");
						update_form.remove();
					} else if(response.code == "failure") {
						alert(response.msq);
						alert(response.query);
					}
				}
			);
		});
	});
</script>
<?php
	$colors = "SELECT * FROM color";
	if(!($colors_result = mysql_query($colors))) {
		die(mysql_error());
	}
	$bad_links = 0;
	while($color_row = mysql_fetch_array($colors_result)) {
		$ch = curl_init($color_row['image_url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);
		$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($response != "200") {
			echo "<form class='update_link_form' action='/' method='post'>";
			echo "<div class='bad_link'>";
			$bad_links++;
			$product_link = "SELECT * FROM product WHERE product_id=" . $color_row['product_id'];
			if(!($product_result = mysql_query($product_link))) {
				die(mysql_error());
			}
			$product = mysql_fetch_assoc($product_result);
			echo "<p><a href='" . $product['link'] . "'>" . $product['link'] . "</a> " . $product['product_id'];
			foreach($check_colors as $color) {
				if($color_row[$color]) {
					echo " " . $color;
				}
			}
			echo " </p>";
			echo "<p><a href='" . $color_row['image_url'] . "'>" . $color_row['image_url'] . "</a> Response: $response</p>";
			echo "<input type='text' size='150' name='update_link' />";
			echo "<input type='hidden' name='id' value='" . $color_row['id'] . "' />";
			echo "<input type='submit' name='submit' value='Update' />";
			echo "</div>";
			echo "</form>";
		}
		curl_close($ch);
	}
	echo "Number of bad links: $bad_links";
	if($bad_links == 0) {
		echo "<p>No bad links :)!</p>";
	}
	
?>
