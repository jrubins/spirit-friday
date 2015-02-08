<?php
	session_start();
	require_once('../includes/database.php');
	db_connect();
	if(!$_SESSION['admin']) {
		header("Location: ../index.php");
	}
	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		/*$(".update_link_form").submit(function(event) {
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
		});*/
	});
</script>
<?php
	$products = "SELECT * FROM product";
	if(!($products_result = mysql_query($products))) {
		die(mysql_error());
	}
	$bad_links = 0;
	while($product_row = mysql_fetch_array($products_result)) {
		$ch = curl_init($product_row['link']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);
		$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($response != "200") {
			if($response == "404") {
				$delete_product = "DELETE FROM product WHERE product_id=" . $product_row['product_id'];
				if(!mysql_query($delete_product)) {
					die(mysql_error());
				}
				echo "<p>Product was deleted: <a href='" . $product_row['link'] . "'>" . $product_row['link'] . "</a></p>";
			} else {
				echo "<form class='update_product_form' action='/' method='post'>";
				echo "<div class='bad_link'>";
				$bad_links++;
				echo "<p><a href='" . $product_row['link'] . "'>" . $product_row['link'] . "</a> " . $product_row['product_id'];
				echo " </p>";
				echo "<p>Response: $response</p>";
				if(($response == "301") || ($response == "302")) {
					$new_loc = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
					if($new_loc != $product_row['link']) {
						echo "<p style='font-weight:bold;color:red;'>New link: $new_loc</p>";
					}
					
				}
				echo "<input type='text' size='150' name='update_product' />";
				echo "<input type='hidden' name='id' value='" . $product_row['product_id'] . "' />";
				echo "<input type='submit' name='submit' value='Update' />";
				echo "</div>";
				echo "</form>";
			}
		}
		curl_close($ch);
	}
	echo "Number of bad links: $bad_links";
	if($bad_links == 0) {
		echo "<p>No bad links :)!</p>";
	}
	
?>
