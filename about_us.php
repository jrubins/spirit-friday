<?php
	session_start();
	require_once('includes/database.php');
	db_connect();
	/*if(!$_SESSION['loggedIn']) {
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
		<script type="text/javascript">
			$(document).ready(function() {
				$("#top_search_form").submit(function(event) {
					event.preventDefault();
					
					alert("Search functionality coming soon!");
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
				<div id="top_content">
					<a href="real_index.php"><img src="images/logo_gray.jpg" /></a>
					<h2>About Spirit Friday</h2>
				</div>
				<div id="mid_content">
					<img src="images/about_pic.jpg" />
					<p>Natalie and Katy are two very spirited friends at the University of Michigan.  Since she was a freshman, Natalie dressed up in maize and blue every Friday to show her Michigan pride.  What began as a pre-football game day tradition, soon expanded as an excuse to dress up for any sporting event in the given weekend.   Natalie was always shopping for maize and blue to have unique outfits each week.  When Katy came to Michigan, a year after Natalie, she too started to take part in the weekly Spirit Fridays.  They inspired more friends to dress up each Friday, decked out in maize and blue.  From bows to socks, sweaters and vests, everyone always competed for the best outfit each week.</p>
					<p>While noticing how much time Natalie and Katy would spend looking for particular maize and blue apparel, whether it was a blue suit for an interview or yellow dress for a banquet, the girls realized there must be other students at schools across the country who are as spirited as they and have a hard time finding their colors as well.  They called some friends across the country and their hypothesis was validated! Jon came on board to program this beautiful site, and Spirit Friday was born! We hope you use it to make shopping for your favorite colors easy. So, select your colors, shop Men or Women and join in with us next Friday!</p>
				</div>
			</div>
			<div id="bottom_nav" class="border">
				<div id="foot_nav">
					<ul id="foot_nav_bar">
						<li><a href="real_index.php">Home</a></li>
						<li><a href="#">About Us</a></li>
						<li><a href="privacy.php" target="_blank">Privacy Rights</a></li>
						<li><a href="javascript:void" id="contact_button">Contact Us</a></li>
						<li class="last"><a href="javascript:void" id="recommend_button">Recommend Items</a></li>
					</ul>
				</div>
			</div>
		</div> <!-- end container -->
	</body>
</html>