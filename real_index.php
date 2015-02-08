<?php
	session_start();
	if(!$_SESSION['login']) {
		header("Location: index.php");
	}
	require_once('includes/utility.php');
	require_once('includes/database.php');
	require_once('includes/forms.php');
	db_connect();
	
	/*if(!isset($_GET['beta_allow']) || !isset($_GET['beta_email']) || !isset($_GET['beta_ID'])) {
		header("Location: index.php");
	}*/
	$beta_allow = $_GET['beta_allow'];
	$beta_email = $_GET['beta_email'];
	$beta_ID = $_GET['beta_ID'];
	/*$beta_IDs = array(
		"christylarsen@sbcglobal.net" => "5498214567",
		"dlindow1@comcast.net" => "3428754916",
		"gguslani5@yahoo.com" => "4844759615",
		"vocej9@wfu.edu" => "3269845996",
		"hitcmj9@wfu.edu" => "0124803572",
		"sueramans@gmail.com" => "1156324822",
		"alissa@qltd.com" => "3024769653",
		"christine@qltd.com" => "3369263504",
		"joerenton@yahoo.com" => "4751953480",
		"zigkahuna@yahoo.com" => "2580316330",
		"kcraw@umich.edu" => "5489762341",
		"claudia0454@aol.com" => "9876123458",
		"jboulaha@umich.edu" => "0003481567",
		"julie.harness@bankofamerica.com" => "7648313349"
	);*/
	/*if($beta_ID != $beta_IDs[$beta_email]) {
		header("Location: index.php");
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>Spirit Friday</title>
		<link rel="icon" type="image/jpg" href="images/favicon.jpg" />
		<link href="css/index.css" type="text/css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="jquery/hoverintent.js" type="text/javascript"></script>
		<script src="jquery/index.js" type="text/javascript"></script>
		<script src="jquery/common.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				if(<?php echo $_SESSION['first_time']; ?>) {
					<?php unset($_SESSION['first_time']); ?>
					$("#create_account_2").show();
					$("#create_account_2 form input[name='email']").val("<?php echo $_SESSION['email']; ?>");
				}
			
				$("#add_comb").on('click', function() {
					$("#color_combinations").append('<?php color_combination(); ?>');
				});
				
				$("#top_search_form").submit(function(event) {
					event.preventDefault();
					
					alert("Search functionality coming soon!");
				});
				
				$("#close_create_account_2").on('click', function() {
					var gender = $("#create_account_2 form #clothing_type select[name='clothing_type']").val();
					if(gender == "men") {
						gender = "male";
					} else {
						gender = "female";
					}
					window.location.replace("product.php?gender=" + gender);
				});
			
				$("#beta_sign_up").submit(function(event) {
					event.preventDefault();
					
					var email_address = $(this).find("input[name='email']").val();
					var email_form = $(this);
					var success = $("#success");
					var duplicate = $("#duplicate");
					
					$.post(
						"request_invite.php",
						{ email: email_address },
						function(data) {
							
							var response = jQuery.parseJSON(data);
							email_form.hide();
							if(response.code == "success") {
								success.show();
							} else if(response.code == "duplicate") {
								duplicate.show();
							}
						}
					);
				});
				
				$("#account").on('click', function() {
					$("#bottom_nav").css("z-index", "10");
					$("#sign_in").show();
				});
				
				$("#close_sign_in").on('click', function() {
					$("#bottom_nav").css("z-index", "10000");
					$("#sign_in").hide();
				});
				
				/*$("#internal_login_form").submit(function(event) {
					event.preventDefault();
					
					var login_email = $(this).find("input[name='login_email']").val(),
						login_password = $(this).find("input[name='login_password']").val();
						
					$.post(
						"login.php",
						{ email: login_email, password: login_password },
						function(data) {
							var response = jQuery.parseJSON(data);
							if(response.code == "success") {
								if(response.login == "true") {
									alert("login success");
									window.location.replace("product.php?gender=" + response.gender);
								} else if(response.login == "false") {
									alert("failed login");
								}
							} else if(response.code == "failure") {
								alert(response.msg);
								alert(response.query);
							}
						}
					);
				});*/
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
			<div id="top_nav">
				<div id="top_search">
					<form id="top_search_form" method="post" action="/">
						<input type="text" name="search_text" placeholder="search" />
						<input type="submit" name="search" value="" />
					</form>
				</div>
				<div id="nav">
					<ul id="nav_bar">
						<li class="first"><img src="images/hanger_gray.jpg" /><a href="dressing_room.php">dressing room</a></li>
						<?php 
							if($_SESSION['login']) {
								echo "<li class='last'><a id='logout' href='logout.php'>logout</a></li>";
							} else {
								echo '<li class="last"><a id="account" href="javascript:void">account</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
			<div id="main_content">
				<div id="top_half">
					<div id="top_left">
						<img src="images/logo_gray.jpg" />
					</div>
					<div id="top_right">
						<div id="two"><p>2</p></div>
						<div id="shop_selection">
							<div id="shop_women">
								<div id="shop_women_text">
									<h1><a href="javascript:void"><span id="shop_women_shop"></span> women</a></h1>
								</div>
								<div id="shop_women_arrow">
									<h1>></h1>
								</div>
							</div>
							
							<div id="shop_men">
								<div id="shop_men_text">
									<h1><a href="javascript:void"><span id="shop_men_shop"></span> men</a></h1>
								</div>
								<div id="shop_men_arrow">
									<h1>></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="bottom_half">
					<div id="bottom_left">
						<div id="colors">
							<div id="one"><p>1</p></div>
							<h1>choose your color(s):</h1>
							<div id="color_swatches">
							<?php
								display_palette("");
							?>
							</div>
							<div id="swatch_options">
								<ul>
									<li><a id="view_all" href="javascript:void">view all</a></li>
									<li class="last"><a id="clear" href="javascript:void">clear</a></li>
								</ul>
							</div>
						</div> <!-- end colors -->
					</div>
					<div id="bottom_right">
						<div id="external_share">
							<a href="https://plus.google.com/104620108199708170125" target="_blank" title="google+" id="google_plus"><img src="images/google_plus_icon_bw.jpg" /></a>
							<a href="https://twitter.com/#!/SpiritFriday" target="_blank" title="twitter"><img src="images/twitter_icon_bw.png" /></a>
							<a href="http://pinterest.com/spiritfriday/" target="_blank" title="pinterest" id="pinterest"><img src="images/pinterest_icon_bw.jpg" /></a>
							<a href="http://www.facebook.com/pages/Spirit-Friday/176837485739059" target="_blank" title="facebook"><img src="images/facebook_icon_bw.png" /></a>
							<a href="mailto:support@spiritfriday.com" target="_blank" title="contact us"><img src="images/contact_us_icon_bw.png" /></a>
						</div>
						<div id="instructions">
							<p>The colors you select will be the colors, both solid and combined, of the clothes you choose to shop for. If you do not select any colors before you choose to shop, you will view all colors.</p>
							<a href="about_us.php">About Us   ></a>
						</div>
					</div>
				</div>
			</div>
			<div id="bottom_third">
				<div id="motto_area">
					<div id="color_motto">
						<h1>Show your colors</h1>
					</div>
					<div id="style_motto">
						<h1>Show your style</h1>
					</div>
				</div>
				<!--<div id="newsletter_area">
					<div id="newsletter_text">
						<p>join our newsletter</p>
					</div>
					<div id="newsletter_form">
						<form>
							<input type="text" name="email" placeholder="enter email address" />
							<input type="submit" name="join" value="Join" />
						</form>
					</div>
				</div>-->
			</div>
			<div id="bottom_nav">
				<div id="foot_nav">
					<ul id="foot_nav_bar">
						<li><a href="real_index.php">Home</a></li>
						<li><a href="about_us.php">About Us</a></li>
						<li><a href="privacy.php" target="_blank">Privacy Rights</a></li>
						<li><a href="javascript:void" id="contact_button">Contact Us</a></li>
						<li class="last"><a href="javascript:void" id="recommend_button">Recommend Items</a></li>
					</ul>
				</div>
			</div>
			<?php
				contact_form();
				recommend_form();
				beta_form();
				sign_in_form();
				create_account_form();
			?>
		</div> <!-- end container -->
	</body>
</html>