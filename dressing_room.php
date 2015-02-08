<?php
	session_start();
	require_once('includes/database.php');
	//require_once('includes/filters.php');
	require_once('includes/constants.php');
	require_once('includes/forms.php');
	require_once('includes/utility.php');
	
	db_connect();
	if(!$_SESSION['login']) {
		header("Location: index.php");
	}
	/*if($_SERVER['REQUEST_METHOD'] != "GET") {
		header("Location: index.php");
	}*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>Spirit Friday</title>
		<link rel="icon" type="image/jpg" href="images/favicon.jpg" />
		<link href="css/product.css" type="text/css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="jquery/hoverintent.js" type="text/javascript"></script>
		<script src="jquery/product.js" type="text/javascript"></script>
		<script src="jquery/common.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#top_search_form").submit(function(event) {
					event.preventDefault();
					
					alert("Search functionality coming soon!");
				});
				
				$(document).on('mouseover', '.product_img', function() {
					$(this).find(".remove_dressing").show();
				});
				
				$(document).on('mouseout', '.product_img', function() {
					$(this).find(".remove_dressing").hide();
				});
			
				$(".remove_dress_room").on('click', function() {
					$(this).text("removing...");
					var parent = $(this).parents(".product"),
						product_id = parent.attr("id");
						
					
					
					$.post(
						"remove_droom_product.php",
						{ product_id: product_id },
						function(data) {
							var response = jQuery.parseJSON(data);
							if(response.code == "success") {
								//alert(response.query);
								window.location.replace("dressing_room.php");
							} else if(response.code == "failure") {
								//alert(response.msg);
								//alert(response.query);
							}
						}
					);
				});
			
			});
		</script>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-31623743-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</head>

	<body>
		<div id="container">
			<div id="sidebar">
				<div id="logo">
					<a href="clear_session.php"><img src="images/logo_gray.jpg" alt="Spirit Friday Logo" /></a>
				</div>
				<?php
					contact_form();
					recommend_form();
					sign_in_form();
					create_account_form();
					if($_SESSION['login']) {
						delete_confirm();
					}
				?>
				<div id="top_jump">
					<a href="#">Back to Top</a>
				</div>
			</div> <!-- end sidebar -->
			<div id="main_content">
				<div id="fixed_top">
					<div id="top_nav">
						<div id="top_search">
							<form id="top_search_form" method="post" action="/">
								<input type="text" name="search_text" placeholder="search" />
								<input type="submit" name="search" value="" />
							</form>
						</div>
						<div id="nav">
							<ul id="nav_bar">
								<li class="first"><a href="product.php?gender=<?php if(isset($_SESSION['gender'])) { echo $_SESSION['gender']; } else { echo "female"; } ?>">< back to shopping</a></li>
								<?php 
									if($_SESSION['login']) {
										echo "<li class='last'><a id='logout' href='logout.php'>logout</a></li>";
									} else {
										echo '<li class="last"><a id="account" href="javascript:void">account</a></li>';
									}
								?>
								<!--<li class="last"><a id="account" href="javascript:void">account</a></li>-->
							</ul>
						</div>
					</div>
					<div id="main_nav">
						<ul>
							<li><a href="clear_session.php">Home</a></li>
							<?php
								/*if($_SESSION['login']) {
									echo "<li><a href='#' id='my_colors_nav'>My Colors</a></li>";
								}*/
							?>
							<li><a href="clear_filters.php?gender=female">Shop Women</a></li>
							<li><a href="clear_filters.php?gender=male">Shop Men</a></li>
							<?php
								/*if($_SESSION['login']) {
									echo "<li style='float:right'><a href='#' id='edit_profile_button'><img title='Edit Profile' src='images/settings.gif' /></a></li>";
								}*/
							?>
						</ul>
						<!--<div id="search">
							<form id="search_form">
								<input type="text" name="keywords" placeholder="Search Keyword" /><input type="submit" name="search" value=">" />
							</form>
						</div>-->
						<div id='welcome'>
							<h3>my dressing room</h3>
						</div>
					</div>
				</div>
				<div id="product_content">
					<div id="product_list">
					<?php
						if(isset($_SESSION['user_id'])) {
							echo "<div id='dressing_room'>";
							
							$kinds = array_merge($men_kinds, $women_accessories);
							$no_products = true;
							foreach($kinds as $kind) {
								$fetch_user_dress = "SELECT * FROM dress_room WHERE user_id=" . $_SESSION['user_id'] . " AND kind='$kind'";
								if(!($fetch_user_result = mysql_query($fetch_user_dress))) {
									die(mysql_error());
								}
								echo "<div class='dress_room_category'>";
								if(mysql_num_rows($fetch_user_result) > 0) {
									$no_products = false;
									echo "<h3>" . array_search($kind, $kinds) . "</h3>";
									
									$i = 0;
									while($fetch_user_row = mysql_fetch_array($fetch_user_result)) {
										
										//echo $i;
										$product_query = "SELECT * FROM product WHERE product_id=" . $fetch_user_row['product_id'];
										if(!($product_result = mysql_query($product_query))) {
											die(mysql_error());
										}
										
										$product = mysql_fetch_assoc($product_result);
										
										if($i == 0) {
											echo "<div class='product_row'>";
											$not_closed = true;
										}
										echo "<div class='product' id='" . $product['product_id'] . "'>";
										echo "<div class='product_img'>";
										echo "<a href='" . $product['link'] . "' target='_blank'>";
										echo "<img src='" . $fetch_user_row['image_url'] . "' /></a>";
										echo "<div class='remove_dressing'>";
										echo "<a href='javascript:void' class='remove_dress_room'>remove</a>";
										echo "</div>";
										echo "</div>";
										echo "<div class='product_meta'>";
										echo "<p class='product_manu'>" . $brands[$product['brand']] . "</p>";
										echo "<p class='product_price'>$" . number_format($product['price'], 2) . "</p>";
										echo "<p class='product_store'>Buy at " . $stores[$product['merchant']] . "</p>";
										echo "</div>";
										echo "</div>";
										$i++;
										if($i == 4) {
											$not_closed = false;
											$i = 0;
											echo "</div>";
										}
										
									}
									if($not_closed) {
										echo "</div>";
									}
								}
								echo "</div>";
							}
							if($no_products) {
								echo "<p>No products in your dressing room.</p>";
							}
							echo "</div>";
						}
					?>
					</div> <!-- end product list -->
					
				</div> <!-- end product content -->
				<?php
					if($_SESSION['login']) {
						edit_profile();
					}
				?>
			</div>
			<div id="bottom_nav">
				<div id="foot_nav">
					<ul id="foot_nav_bar">
						<li><a href="clear_session.php">Home</a></li>
						<li><a href="about_us.php">About Us</a></li>
						<li><a href="">Privacy Rights</a></li>
						<li><a id="contact_button" href="javascript:void">Contact Us</a></li>
						<li class="last"><a id="recommend_button" href="javascript:void">Recommend Items</a></li>
					</ul>
				</div>
			</div>
		</div> <!-- end container -->
	</body>
</html>