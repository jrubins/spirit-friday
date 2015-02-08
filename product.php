<?php
	session_start();
	if(!$_SESSION['login']) {
		header("Location: index.php");
	}
	if(!isset($_GET['gender'])) {
		header("Location: index.php");
	}
	require_once('includes/database.php');
	require_once('includes/filters.php');
	require_once('includes/constants.php');
	require_once('includes/forms.php');
	require_once('includes/utility.php');
	
	db_connect();
	
	
	$gender = $_GET['gender'];
	
	if(isset($_GET['edit_profile'])) {
		$edit_profile = $_GET['edit_profile'];
	}
	
	if($gender == "female") {
		$kinds = $women_kinds;
		$accessories = $women_accessories;
	} else if($gender == "male") {
		$kinds = $men_kinds;
		$accessories = $men_accessories;
	}

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
			function lockScroll() {
				// lock scroll position, but retain settings for later
				var scrollPosition = [
					self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
					self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
				];
				var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
				html.data('scroll-position', scrollPosition);
				html.data('previous-overflow', html.css('overflow'));
				html.css('overflow', 'hidden');
				window.scrollTo(scrollPosition[0], scrollPosition[1]);
			}
			
			function unlockScroll() {				
				// un-lock scroll position
				var html = jQuery('html');
				var scrollPosition = html.data('scroll-position');
				html.css('overflow', html.data('previous-overflow'));
				window.scrollTo(scrollPosition[0], scrollPosition[1])
			}
		
			$(document).ready(function() {
				$("#change_password").on('click', function() {
					$(this).parents("tr").siblings(".hidden").show();
					$(this).siblings(".hidden").show();
					$(this).hide();
				});
			
				$("#top_search_form").submit(function(event) {
					event.preventDefault();
					
					alert("Search functionality coming soon!");
				});
			
				$(document).on('click', '.edit_comb_view_all', function() {
					var color_palette = $(this).parents("td").find(".edit_color_palette");
					//color_palette.css("width", "210px");
					/*color_palette.find(".edit_comb_color a").css("border", "2px solid #000");
					color_palette.find(".edit_comb_color a").css("width", "18px");
					color_palette.find(".edit_comb_color a").css("height", "18px");*/
					color_palette.find(".edit_comb_color a").addClass("edit_comb_color_selected");
				});
				
				$(document).on('click', '.edit_comb_clear', function() {
					var color_palette = $(this).parents("td").find(".edit_color_palette");
					//color_palette.css("width", "200px");
					/*color_palette.find(".edit_comb_color a").css("border", "1px solid #a9a9ab");
					color_palette.find(".edit_comb_color a").css("width", "20px");
					color_palette.find(".edit_comb_color a").css("height", "20px");*/
					color_palette.find(".edit_comb_color a").removeClass("edit_comb_color_selected");
				});
				
				$(document).on('click', '.edit_color_palette .edit_comb_color a', function() {
					if(!$(this).hasClass("edit_comb_color_selected")) {
						$(this).addClass("edit_comb_color_selected");
					} else {
						$(this).removeClass("edit_comb_color_selected");
					}
				});
			
				$(".add_dress_room").on('click', function() {
					$(this).parents(".add_dressing").addClass("keep_visible");
					$(this).text("adding...");
					var add_link = $(this);
						parent = $(this).parents(".product"),
						product_id = parent.attr("id"),
						kind = parent.attr("kind"),
						image_url = parent.attr("image_url");
						
					//alert(product_id);
					//alert(kind);
					$.post(
						"add_droom_product.php",
						{ product_id: product_id, kind: kind, image_url: image_url },
						function(data) {
							var response = jQuery.parseJSON(data);
							if(response.code == "success") {
								//alert(response.query);
								add_link.text("Successfully added!");
							} else if(response.code == "failure") {
								//alert(response.msg);
								//alert(response.query);
								$.post(
									"error_email.php",
									{ error: response.msg, query: response.query }
								);
							}
						}
					);
				});
				
				$("#my_colors .upper_check a").on('click', function() {
					$("#my_colors .upper_check a.user_selected").removeClass("user_selected");
					if($(this).hasClass("user_selected")) {
						$(this).removeClass("user_selected");
					} else {
						$(this).addClass("user_selected");
					}
					var comb_name = $(this).find(".my_comb_name").text();
					//alert(comb_name);
					var select_colors = $(this).parents(".upper_check").siblings(".my_combination_colors").find(".my_color a").map(function() {
						return $(this).css("background-color");
					});
					/*$.each(select_colors, function(index, value) {
						alert(value);
					});*/
					//alert(select_colors[0]);
					//if(select_colors.length) {
					$.post("set_colors.php", { 'colors[]': jQuery.makeArray(select_colors), comb_name: comb_name }, function() {
						//alert("<?php if(isset($_SESSION['color'])) { echo $_SESSION['color']; } ?>");
						window.location.replace("product.php?gender=<?php echo $gender; ?>");
					});
				});
			
				$("#user_combinations .upper_check a").on('click', function() {
					$("#user_combinations .upper_check a.user_selected").removeClass("user_selected");
					if($(this).hasClass("user_selected")) {
						$(this).removeClass("user_selected");
					} else {
						$(this).addClass("user_selected");
					}
					
					var select_colors = $(this).parents(".upper_check").siblings(".comb_colors").find(".user_comb_color a").map(function() {
						return $(this).css("background-color");
					});
					/*$.each(select_colors, function(index, value) {
						alert(value);
					});*/
					//alert(select_colors[0]);
					//if(select_colors.length) {
					$.post("set_colors.php", { 'colors[]': jQuery.makeArray(select_colors) }, function() {
						//alert("<?php if(isset($_SESSION['color'])) { echo $_SESSION['color']; } ?>");
						window.location.replace("product.php?gender=<?php echo $gender; ?>");
					});
				});
			
				$("#add_color_comb_form").submit(function(event) {
					event.preventDefault();
					var operation = $(this).find("input[name='operation']").val();
					//alert(operation);
					var user = $(this).find("input[name='user_id']").val();
					var comb_name = $(this).find("input[name='new_comb_name']").val();
					var colors = [];
					colors = jQuery.makeArray($("#new_comb_color_palette").find(".new_comb_color a.new_comb_color_selected").map(function() {
						return $(this).css("background-color");
					}));
					//alert(JSON.stringify(colors));
					
					if(operation == "add") {
						$.post(
							"add_comb.php",
							{ user_id: user, name: comb_name, add_colors: JSON.stringify(colors) },
							function(data) {
								var response = jQuery.parseJSON(data);
								if(response.code == "success") {
									window.location.replace("product.php?gender=<?php echo $gender; ?>");
								} else if(response.code == "failure") {
									//alert(response.msg);
									//alert(response.query);
									$.post(
										"error_email.php",
										{ error: response.msg, query: response.query }
									);
								}
							}
						);
					} else if(operation == "edit") {
						var comb_id = $(this).find("input[name='comb_id']").val();
						$.post(
							"edit_comb.php",
							{ edit_id: comb_id, name: comb_name, edit_colors: JSON.stringify(colors) },
							function(data) {
								var response = jQuery.parseJSON(data);
								if(response.code == "success") {
									//alert(response.query);
									window.location.replace("product.php?gender=<?php echo $gender; ?>");
								} else if(response.code == "failure") {
									//alert(response.msg);
									//alert(response.query);
									$.post(
										"error_email.php",
										{ error: response.msg, query: response.query }
									);
								}
							}
						);
					}
				});
			
				$(".my_delete").on('click', function() {
					var comb_id = $(this).parents(".my_combination").attr("comb_id");
					//alert(delete_id);
					$.post(
						"delete_comb.php",
						{ delete_id: comb_id },
						function(data) {
							var response = jQuery.parseJSON(data);
							if(response.code == "success") {
								window.location.replace("product.php?gender=<?php echo $gender; ?>");
							} else if(response.code == "failure") {
								//alert(response.msg);
								//alert(response.query);
								$.post(
									"error_email.php",
									{ error: response.msg, query: response.query }
								);
							}
						}
					);
				});
				
				$(".my_edit").on('click', function() {
					var comb_id = $(this).parents(".my_combination").attr("comb_id");
					$("#add_my_color_comb").find("input[type='submit']").val("edit");
					$("#add_my_color_comb").find("input[name='operation']").val("edit");
					$("#add_my_color_comb").find("input[name='comb_id']").val(comb_id);
					$("#add_my_color_comb").find(".new_comb_color a.new_comb_color_selected").each(function() {
						/*$(this).css("border", "none");
						$(this).css("height", "20px");
						$(this).css("width", "20px");*/
						$(this).removeClass("new_comb_color_selected");
					});
					
					var comb_name = $(this).parents(".my_combination").find(".my_comb_name").text();
					
					$("#add_my_color_comb").find("input[name='new_comb_name']").val(comb_name);
					$(this).parents(".my_combination").find(".my_color a").each(function() {
						var cur_background = $(this).css("background");
						$("#add_my_color_comb").find(".new_comb_color a").each(function() {
							if($(this).css("background") == cur_background) {
								/*$(this).css("border", "2px solid #000");
								$(this).css("height", "16px");
								$(this).css("width", "16px");*/
								$(this).addClass("new_comb_color_selected");
							}
						});
					});
					
					$("#add_my_color_comb").show();					
				});
				
				$("#add_my_color_comb .new_comb_color a").on('click', function() {
					if(!$(this).hasClass("new_comb_color_selected")) {
						$(this).addClass("new_comb_color_selected");
					} else {
						$(this).removeClass("new_comb_color_selected");
					}
				});
				
				/*$("#add_my_color_comb .new_comb_color a").hover(
					function() {
						$(this).css("border", "2px solid #000");
						$(this).css("width", "16px");
						$(this).css("height", "16px");
					},
					function() {
						if(!$(this).hasClass("new_comb_color_selected")) {
							$(this).css("border", "none");
							$(this).css("width", "20px");
							$(this).css("height", "20px");
						}
					}
				);*/
			
				$("#add_comb_button").on('click', function() {
					$("#add_my_color_comb").find("input[type='submit']").val("add");
					$("#add_my_color_comb").find("input[name='operation']").val("add");
					$("#add_my_color_comb").find("input[name='new_comb_name']").val("");
					$("#add_my_color_comb").find(".new_comb_color a.new_comb_color_selected").each(function() {
						$(this).css("border", "none");
						$(this).css("height", "20px");
						$(this).css("width", "20px");
						$(this).removeClass("new_comb_color_selected");
					});
					$("#add_my_color_comb").show();
				});
			
				$("#my_colors_nav").on('click', function() {
					if($("#my_colors_container").is(":visible")) {
						$("#my_colors_container").hide();
					} else {
						$("#my_colors_container").show();
					}
				});
				
				$("#brand_filter input").keyup(function() {
					var letter = $(this).val();
					$("#brands li a").each(function() {
						alert($(this).text());
					});
				});

				$("#edit_form input[name='edit_password_confirm']").keyup(function() {
					var edit_pass = $("#edit_form input[name='edit_password']").val(),
						edit_pass_confirm = $(this).val();
						
					if(edit_pass != edit_pass_confirm) {
						$("#edit_pass_no_match").show();
					} else {
						$("#edit_pass_no_match").hide();
					}
				});
				
				$("#edit_form").submit(function(event) {
					event.preventDefault();
					
					var user_id = $(this).find("input[name='user_id']").val(),
						edit_first_name = $(this).find("input[name='edit_first_name']").val(),
						edit_last_name = $(this).find("input[name='edit_last_name']").val(),
						edit_email = $(this).find("input[name='edit_email']").val(),
						edit_month = $(this).find("select[name='edit_month']").val(),
						edit_day = $(this).find("select[name='edit_day']").val(),
						edit_year = $(this).find("select[name='edit_year']").val(),
						edit_clothing_type = $(this).find("select[name='edit_clothing_type']").val(),
						password = $(this).find("input[name='old_pass']").val(),
						edit_pass = $(this).find("input[name='edit_password']").val(),
						edit_pass_confirm = $(this).find("input[name='edit_password_confirm']").val(),
						edit_updates = false;
					if($("#edit_updates").hasClass("edit_updates_checked")) {
						edit_updates = true;
					}
					
					if(edit_month == 'blank') {
						edit_month = '';
					}
					if(edit_day == 'blank') {
						edit_day = '';
					}
					if(edit_year == 'blank') {
						edit_year = '';
					}
					var colors = {};
					var names = {};
					$(this).find(".edit_color_palette").each(function() {
						var comb_id = $(this).parents("tr").attr("comb_id");
						var comb_name = $(this).parents("tr").siblings("tr[comb_id=" + comb_id + "]").find("input[name='edit_combination_name']").val();
						//alert(comb_id);
						//alert(comb_name);
						names[comb_id] = comb_name;
						colors[comb_id] = jQuery.makeArray($(this).find(".edit_comb_color a.edit_comb_color_selected").map(function() {
							return $(this).css("background-color");
						}));
					});
					//alert(JSON.stringify(names));
					//alert(JSON.stringify(colors));
					
					if(((edit_pass == edit_pass_confirm) && (password != '') && (edit_pass != '')) || (password == '')) {
						$.post(
							"edit_account.php",
							{ user_id: user_id, first_name: edit_first_name, last_name: edit_last_name, email: edit_email, password: password, edit_password: edit_pass, month: edit_month, day: edit_day, year: edit_year, clothing_type: edit_clothing_type, updates: edit_updates, names: JSON.stringify(names), combinations: JSON.stringify(colors) },
							function(data) {
								var response = jQuery.parseJSON(data);
								if(response.code == "success") {
									//alert(response.query);
									window.location.replace("product.php?gender=<?php echo $gender; ?>&edit_profile=true");
									
								} else if(response.code == "failure") {
									//alert(response.msg);
									//alert(response.query);
									window.location.replace("product.php?gender=<?php echo $gender; ?>&edit_profile=false");
									$.post(
										"error_email.php",
										{ error: response.msg, query: response.query }
									);
								}
							}					
						);
					}
					
					
					
				});
				
				$("#edit_updates a").on('click', function() {
					//alert("Functionality coming soon!");
					var edit_updates = $("#edit_updates");
					if(edit_updates.hasClass("edit_updates_checked")) {
						edit_updates.removeClass("edit_updates_checked");
					} else {
						edit_updates.addClass("edit_updates_checked");
					}
				});
				
				$("#confirm_delete").on('click', function() {
					alert("Functionality coming soon!");
				});
			
				$("#edit_profile_button").on('click', function() {
					$("#product_list").hide();
					$("#edit_profile").show();
					$("#dressing_room").hide();
				});
				
				$("#dressing_room_button").on('click', function() {
					$("#welcome h3").text("my dressing room");
					$("#product_list").hide();
					$("#edit_profile").hide();
					$("#dressing_room").show();
				});
			
				$("#add_comb").on('click', function() {
					$("#color_combinations").append('<?php color_combination(); ?>');
				});
			
				$("#close_create_account_2").on('click', function() {
					window.location.replace("product.php?gender=<?php echo $gender; ?>");
				});
				
				$("#create_account_2_cancel").on('click', function() {
					window.location.replace("product.php?gender=<?php echo $gender; ?>");
				});
				
				$(document).on('mouseover', '.product_img', function() {
					$(this).find(".add_dressing").show();
				});
				
				$(document).on('mouseout', '.product_img', function() {
					if(!$(this).find(".add_dressing").hasClass("keep_visible")) {
						$(this).find(".add_dressing").hide();
					}
				});
			
				$("#account").on('click', function() {
					$("#bottom_nav").css("z-index", "10");
					$("#sign_in").show();
				});
				
				$("#close_sign_in").on('click', function() {
					$("#bottom_nav").css("z-index", "10000");
					$("#sign_in").hide();
				});
				
				$("#change_colors_ok").on('click', function() {
					//alert("here");
					$("#my_colors .upper_check a").removeClass("user_selected");
					setColors('<?php echo $gender; ?>');
				});
				
				$("#delete_account_button").on('click', function() {
					$("#delete_confirm").show();
				});
				
				$("#close_delete_account").on('click', function() {
					$("#delete_confirm").hide();
				});
				
				$("#cancel_delete").on('click', function() {
					$("#delete_confirm").hide();
				});
				
				$("#close_colors a").on('click', function() {
					$("#my_colors_container").hide();
				});
				
				$("#new_comb_view_all").on('click', function() {
					$("#new_comb_color_palette .new_comb_color a").addClass("new_comb_color_selected");
				});
				
				$("#new_comb_clear").on('click', function() {
					$("#new_comb_color_palette .new_comb_color a").removeClass("new_comb_color_selected");
				});
			});
			
			
			
			function updateClothes() {
				var filter_clothes = $(".selected").map(function() {
					return $(this).text();
				});
				var filter_brands = $(".brand_selected").map(function() {
					return $(this).text();
				});
				var filter_stores = $(".store_selected").map(function() {
					return $(this).text();
				});
				var filter_prices = $(".price_selected").map(function() {
					return $(this).text();
				});
				/*$.each(filter_clothes, function(index, value) {
					alert(value);
				});*/
				//alert(select_colors[0]);
				
				$.post("set_filters.php", { 'filters[]': jQuery.makeArray(filter_clothes), 'brands[]': jQuery.makeArray(filter_brands), 'stores[]': jQuery.makeArray(filter_stores), 'prices[]': jQuery.makeArray(filter_prices) }, function() {
					//alert("<?php if(isset($_SESSION['filter'])) { echo $_SESSION['filter']; } ?>");						
					window.location.replace("product.php?gender=<?php echo $gender; ?>");
				});
				
			}
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
				<div id="filters">
					<div id="color_filters" class="filter
					<?php
						/*if($_SESSION['login']) {
							echo " login";
						}*/
					?>
					">
						<?php
														
							if(isset($_SESSION['color']) && (count($_SESSION['color']) < 18)) {
								echo "<div id='up_colors'";
								/*if($_SESSION['login']) {
									echo " class='login'";
								}*/
								echo "><h3 id='yes_colors'><a href='javascript:void'>change color(s)</a></h3>
									<div id='color_arrow_up'><a href='javascript:void'>></a></div></div>
									<div id='colors'>";
								if(isset($_SESSION['login'])) {
									$check_for_comb = "SELECT * FROM combinations WHERE user_id=" . $_SESSION['user_id'] . " AND ";
									$i = 1;
									foreach(array_keys($colors) as $color) {
										if($i == count($colors)) {
											if(in_array($color, $_SESSION['color'])) {
												$check_for_comb .= $colors[$color] . "=1";
											} else {
												$check_for_comb .= $colors[$color] . "=0";
											}
										}  else {
											if(in_array($color, $_SESSION['color'])) {
												$check_for_comb .= $colors[$color] . "=1 AND ";
											} else {
												$check_for_comb .= $colors[$color] . "=0 AND ";
											}
										}
										$i++;
									}
									if(!($check_for_comb_result = mysql_query($check_for_comb))) {
										echo "<p>" . $check_for_comb . "</p>";
										die(mysql_error());
									}
									if(mysql_num_rows($check_for_comb_result) > 0) {
										/*if(isset($_SESSION['cur_comb'])) {
											echo "<p id='cur_comb_name'>" . $_SESSION['cur_comb'] . "</p>";
										}*/
										$comb_result = mysql_fetch_array($check_for_comb_result);
										if(strlen($comb_result['name']) > 10) {
											echo "<div><p id='cur_comb_name'>" . substr($comb_result['name'], 0, 10) . "...</p></div>";
										} else {
											echo "<div><p id='cur_comb_name'>" . $comb_result['name'] . "</p></div>";
										}
									}
								}
								if(count($_SESSION['color']) > 4) {
									$i = 0;
									foreach($_SESSION['color'] as $color) {
										if($i > 3) break;
										echo "<div class='color";
										/*if($_SESSION['login']) {
											echo " login";
										}*/
										echo "' style='background:" . $color . "'></div>";
										$i++;
									}
									echo "...";
								} else {
									foreach($_SESSION['color'] as $color) {
										echo "<div class='color";
										/*if($_SESSION['login']) {
											echo " login";
										}*/
										echo "' style='background:" . $color . "'></div>";
									}
								}
								echo "</div>";
							} else {
								echo "<div id='up_colors'><h3 id='no_colors'><a href='javascript:void'>choose color(s)</a></h3>";
								echo "<div id='color_arrow'><a href='javascript:void'>></a></div></div>";
							}
						?>
						<div id="change_colors">
							<div id="top_change">
								<p><a href="javascript:void" id="change_colors_close">X</a></p>
							</div>
							<div id="bottom_change">
								<?php
									display_palette("color_selected");
								?>
							</div>
							<div id="swatch_options">
								<ul>
									<li><a id="view_all" href="javascript:void">view all</a></li>
									<li class="last"><a id="clear" href="javascript:void">clear</a></li>
								</ul>
							</div>
							<div id="change_colors_submit">
								<a href="javascript:void" id="change_colors_ok">ok</a>
							</div>
						</div>
						<?php
							if(isset($_SESSION['login']) && $_SESSION['login']) {
								/*$user_combination_query = "SELECT * FROM combinations WHERE user_id=" . $_SESSION['user_id'];
								if(!($user_combination_result = mysql_query($user_combination_query))) {
									echo $user_combination_query;
									die(mysql_error());
								}
								echo '<div id="user_combinations">';
								while($user_combination = mysql_fetch_array($user_combination_result)) {
									echo '<div class="user_combination">';
									echo '<div class="upper_check">';
									echo '<a href="javascript:void" class="user_check';
									$selected = true;
									foreach(array_keys($colors) as $color) {
										if(in_array($color, $_SESSION['color'])) {
											if($user_combination[$colors[$color]] == 0) {
												$selected = false;
											}
										}
									}
									if($selected) {
										echo " user_selected";
									}
									echo '"><div class="user_checkbox"></div>';
									echo '<p>';
									if(strlen($user_combination['name']) > 7) {
										echo substr($user_combination['name'], 0, 5) . "...";
									} else {
										echo $user_combination['name'];
									}
									echo '</p></a>';
									echo '</div>';
									echo '<div class="comb_colors">';
									foreach($colors as $color) {
										if($user_combination[$color] == 1) {
											echo '<div class="user_comb_color">
													<a href="javascript:void" style="background:' . array_search($color, $colors) . '"></a></div>';
										}
									}
									echo '</div></div>';
								}
								echo '</div>';*/
							}
						?>
					</div> <!-- end colors filter -->
					<div id="apparel" class="filter">
						<h4><a href="javascript:void">shop apparel</a></h4>
						<ul>
							<?php
								if(isset($_SESSION['filter']) && (count($_SESSION['filter']) != 0)) {
									foreach(array_keys($kinds) as $kind) {
										if(in_array($kind, $_SESSION['filter'])) {
											echo "<li><a class='check selected' href='javascript:void'><div class='checkbox'></div>";
											echo $kind . "</a></li>";
										} else {
											echo "<li><a class='check' href='javascript:void'><div class='checkbox'></div>";
											echo $kind . "</a></li>";
										}
									}
								} else {
									foreach(array_keys($kinds) as $kind) {
										echo "<li><a class='check' href='javascript:void'><div class='checkbox'></div>";
										echo $kind . "</a></li>";
									}
								}
							?>
						</ul>
					</div>
					<div id="shoes_accessories" class="filter">
						<h4><a href="javascript:void">shop shoes &amp; accessories</a></h4>
						<ul>
							<?php
								if(isset($_SESSION['filter']) && (count($_SESSION['filter']) != 0)) {
									foreach(array_keys($accessories) as $accessory) {
										if(in_array($accessory, $_SESSION['filter'])) {
											echo "<li><a class='check selected' href='javascript:void'><div class='checkbox'></div>";
											echo $accessory . "</a></li>";
										} else {
											echo "<li><a class='check' href='javascript:void'><div class='checkbox'></div>";
											echo $accessory . "</a></li>";
										}
									}
								} else {
									foreach(array_keys($accessories) as $accessory) {
										echo "<li><a class='check' href='javascript:void'><div class='checkbox'></div>";
										echo $accessory . "</a></li>";
									}
								}
							?>
						</ul>
					</div>
					<div id="refine">
						<h4><a href="javascript:void">refine by:</a></h4>
						<ul>
							<li><a class="refine" href="javascript:void">brand</a>
								<div id="brand_arrow" class="arrow">
									<p>></p>
								</div>
								<?php filter("brand", $brands, $stores, $prices); ?>
							</li>
							<li><a class="refine" href="javascript:void">store</a>
								<div id="store_arrow" class="arrow">
									<p>></p>
								</div>
								<?php filter("store", $brands, $stores, $prices); ?>
							</li>
							<li><a class="refine" href="javascript:void">price</a>
								<div id="price_arrow" class="arrow">
									<p>></p>
								</div>
								<?php filter("price", $brands, $stores, $prices); ?>
							</li>
						</ul>
					</div>
					<div id="share_buttons" <?php if($_SESSION['login']) { echo "class='login'"; } ?>>
						<a href="https://plus.google.com/104620108199708170125" target="_blank" title="google+" id="google_plus"><img src="images/google_plus_icon_bw.jpg" alt="Google Plus Icon" /></a>
						<a href="https://twitter.com/#!/SpiritFriday" target="_blank" title="twitter"><img src="images/twitter_icon_bw.png" alt="Twitter Icon" /></a>
						<a href="http://pinterest.com/spiritfriday/" target="_blank" title="pinterest" id="pinterest"><img src="images/pinterest_icon_bw.jpg" alt="Pinterest Icon" /></a>
						<a href="http://www.facebook.com/pages/Spirit-Friday/176837485739059" target="_blank" title="facebook"><img src="images/facebook_icon_bw.png" alt="Facebook Icon" /></a>
						<a href="mailto:support@spiritfriday.com" target="_blank" title="contact us"><img src="images/contact_us_icon_bw.png" alt="Contact Us Icon" /></a>
					</div>
				</div>
				<?php
					contact_form();
					recommend_form();
					sign_in_form();
					create_account_form();
					if($_SESSION['login']) {
						delete_confirm();
						my_colors();
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
								<li class="first"><img src="images/hanger_gray.jpg" /><a id="dressing_room_button" href="dressing_room.php">dressing room</a></li>
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
								if($_SESSION['login']) {
									echo "<li><a href='#' id='my_colors_nav'>My Colors</a></li>";
								}
							?>
							<li><a href="clear_filters.php?gender=female">Shop Women</a></li>
							<li><a href="clear_filters.php?gender=male">Shop Men</a></li>
							<?php
								if($_SESSION['login']) {
									echo "<li style='float:right'><a href='#' id='edit_profile_button'><img title='Edit Profile' src='images/settings.gif' /></a></li>";
								}
							?>
						</ul>
						<!--<div id="search">
							<form id="search_form">
								<input type="text" name="keywords" placeholder="Search Keyword" /><input type="submit" name="search" value=">" />
							</form>
						</div>-->
						<?php
							if(isset($_SESSION['first_name'])) {
								echo "<div id='welcome'>
									<h3>Welcome, " . $_SESSION['first_name'] . "!</h3>
									<p class='edit_success";
									if(isset($edit_profile) && $edit_profile) {
										echo " show";
									}
									echo "'>Your profile changes were successful!</p>
									<p class='edit_failure'";
									if(isset($edit_profile) && !$edit_profile) {
										echo " show";
									}
									echo "'>There was an error trying to save your profile changes.</p>
									</div>";
							}
						?>
					</div>
				</div>
				<div id="product_content">
					<div id="product_list">
						<?php
							
							
							if(isset($_SESSION['color'])) {
								$color_query = "SELECT * FROM color WHERE (";
								$i = 1;
								foreach($_SESSION['color'] as $color) {
									if($i != count($_SESSION['color'])) {
										$color_query .= $colors[$color] . "=1 OR ";
									} else {
										$color_query .= $colors[$color] . "=1) ";
									}
									$i++;
								}
								foreach(array_keys($colors) as $color) {
									if(!in_array($color, $_SESSION['color'])) {
										$color_query .= " AND " . $colors[$color] . "=0";
									}
								}
								//echo $color_query;
								if(!($color_result = mysql_query($color_query))) {
									echo $color_query;
									die(mysql_error());
								}
								$i = 0;
								$no_results = true;
								while($color_row = mysql_fetch_array($color_result)) {
									$product_query = filter_string($gender, $color_row['product_id'], $kinds, $accessories, $brands, $stores, $prices);
									//echo "<p>$product_query</p>";
									if(!($product_result = mysql_query($product_query))) {
										echo "<br /><p>$product_query</p>";
										die(mysql_error());
									}
									
									if(mysql_num_rows($product_result) != 0) {
										$no_results = false;
										$product_array = mysql_fetch_assoc($product_result);
										//$image_array = mysql_fetch_assoc($image_result);
										if($i == 0) {
											echo "<div class='product_row'>";
										}
										echo "<div class='product' id='" . $product_array['product_id'] . "' kind='" . $product_array['kind'] . "' image_url='" . $color_row['image_url'] . "'>";
										echo "<div class='product_img'>";
										echo "<a href='" . $product_array['link'] . "' target='_blank'>";
										echo "<img src='" . $color_row['image_url'] . "' /></a>";
										echo "<div class='add_dressing'>";
										echo "<a href='javascript:void' class='add_dress_room'>add to dressing room</a>";
										echo "</div></div>";
										echo "<div class='product_meta'>";
										/*$brand_key = array_search($product_array['brand'], $brands);
										if($brand_key) {
											echo "<p class='product_manu'>" . $brand_key . "</p>";
										} else {
											echo "<p class='product_manu'>" . $product_array['brand'] . "</p>";
										}*/
										echo "<p class='product_manu'>" . $brands[$product_array['brand']] . "</p>";
										echo "<p class='product_price'>$" . number_format($product_array['price'], 2) . "</p>";
										echo "<p class='product_store'>Buy at " . $stores[$product_array['merchant']] . "</p>";
										echo "</div>";
										echo "</div>";
										$i++;
										if($i == 4) {
											$i = 0;
											echo "</div>";
										}
									}
								}
								if($no_results) {
									echo "<p id='no_results'>Sorry, there are no items that match your criteria.</p>";
								}
							} else {
								$all_query = filter_string($gender, NULL, $kinds, $accessories, $brands, $stores, $prices);
								//echo $all_query;
								if(!($all_result = mysql_query($all_query))) {
									die(mysql_error());
								}
								
								if(mysql_num_rows($all_result) == 0) {
									echo "<p id='no_results'>Sorry, there are no items that match your criteria.</p>";
								} else {
									$i = 0;
									while($all_row = mysql_fetch_array($all_result)) {
										//echo $i;
										$image_query = "SELECT * FROM color WHERE product_id=" . $all_row['product_id'];
										if(!($image_result = mysql_query($image_query))) {
											die(mysql_error());
										}
										
										while($image_row = mysql_fetch_array($image_result)) {
											if($i == 0) {
												echo "<div class='product_row'>";
											}
											echo "<div class='product' id='" . $all_row['product_id'] . "' kind='" . $all_row['kind'] . "' image_url='" . $image_row['image_url'] . "'>";
											echo "<a href='" . $all_row['link'] . "' target='_blank'>";
											echo "<img src='" . $image_row['image_url'] . "' /></a>";
											echo "<div class='product_meta'>";
											/*$brand_key = array_search($all_row['brand'], $brands);
											if($brand_key) {
												echo "<p class='product_manu'>" . $brand_key . "</p>";
											} else {
												echo "<p class='product_manu'>" . $all_row['brand'] . "</p>";
											}*/
											echo "<p class='product_manu'>" . $brands[$all_row['brand']] . "</p>";
											echo "<p class='product_price'>$" . number_format($all_row['price'], 2) . "</p>";
											echo "<p class='product_store'>Buy at " . $stores[$all_row['merchant']] . "</p>";
											echo "</div>";
											echo "</div>";
											$i++;
											if($i == 4) {
												$i = 0;
												echo "</div>";
											}
										}
									}
								}
							}
						?>
					
					</div> <!-- end product list -->
					
				</div> <!-- end product content -->
				<?php
					if($_SESSION['login']) {
						edit_profile();
						//dressing_room();
					}
				?>
			</div>
			<div id="bottom_nav">
				<div id="foot_nav">
					<ul id="foot_nav_bar">
						<li><a href="clear_session.php">Home</a></li>
						<li><a href="about_us.php">About Us</a></li>
						<li><a href="privacy.php" target="_blank">Privacy Rights</a></li>
						<li><a id="contact_button" href="javascript:void">Contact Us</a></li>
						<li class="last"><a id="recommend_button" href="javascript:void">Recommend Items</a></li>
					</ul>
				</div>
			</div>
		</div> <!-- end container -->
	</body>
</html>