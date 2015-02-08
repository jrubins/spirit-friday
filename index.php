<?php
	require_once('includes/utility.php');
	require_once('includes/forms.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>Spirit Friday</title>
		<meta name="description" content="Shop for clothes by color." />
		<meta name="keywords" content="color, clothes, shopping by color, shopping, spirit, friday, spirit friday, school colors, colors, school" />
		<meta name="author" content="Jon Rubins" />
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<link href="css/beta.css" type="text/css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#beta_login").submit(function(event) {
					event.preventDefault();
					
					var email = $(this).find("input[name='email']").val(),
						password = $(this).find("input[name='password']").val();
					
					//alert(email);
					$.post(
						"beta_login.php",
						{ email: email, password: password },
						function(data) {
							var response = jQuery.parseJSON(data);
							if(response.code == "success") {
								//alert(response.query);
								if(response.admin == "true") {
									window.location.replace("admin/enter_links.php");
								} else {
									if(response.product == "true") {
										window.location.replace("product.php?gender=" + response.gender);
									} else {
										window.location.replace("real_index.php");
									}
								}
							} else if(response.code == "failure") {
								//alert(response.msg);
								//alert(response.query);
								//alert("heres");
								if(response.bad_password == "true") {
									//alert("here");
									$("#bottom_beta #left_beta #beta_login input[name='password']").val("");
									$("#bottom_beta #left_beta .failure").show();
								} else if(response.bad_email == "true") {
									$("#bottom_beta #left_beta #beta_login input[name='password']").val("");
									$("#bottom_beta #left_beta .failure").show();
								} else {
									$.post(
										"error_email.php",
										{ error: response.msg, query: response.query }
									);
								}
							}
						}
					);
				});
			
				$("#beta_sign_up").submit(function(event) {
					event.preventDefault();
					
					$(this).find("input[type='submit']").val("Sending...");
					
					var email_address = $(this).find("input[name='email']").val();
					var school = $(this).find("input[name='school']").val();
					var email_form = $(this);
					var success = $("#success");
					var duplicate = $("#duplicate");
					var failure = $("#failure");
					
					$.post(
						"request_invite.php",
						{ email: email_address, school: school },
						function(data) {
							
							var response = jQuery.parseJSON(data);
							
							if(response.code == "success") {
								email_form.hide();
								failure.hide();
								success.show();
							} else if(response.code == "duplicate") {
								email_form.hide();
								failure.hide();
								duplicate.show();
							} else if(response.code == "failure") {
								failure.show();
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
			<div id="beta">
				<div id="top_beta">
					<img src="images/blue.jpg" />
					<img src="images/blue2.png" />
					<img src="images/blue3.png" />
				</div>
				<div id="mid_beta">
					<div id="bad_search">
						<p>Too many <span class="bold">results</span> and too many <span class="bold">variations</span></p>
					</div>
					<div id="good_search">
						<p><span class="bold">Spirit Friday</span> makes your search easier!</p>
					</div>
				</div>
				<div id="bottom_beta">
					<div id="left_bottom">
						<img id="beta_logo" src="images/logo_white.jpg" alt="Beta Logo" />
					</div>
					<div id="right_bottom">	
						<div id="left_beta">
							<p>already have an account?</p>
							<p class="bold">login here</p>
							<form id="beta_login" method="post" action="beta_login.php">
								<p class="smaller">Email</p>
								<input type="text" name="email" />
								<p class="smaller">Password</p>
								<input type="password" name="password" />
								<p class="failure">Your password or email was incorect.</p>
								<div id="bottom_login">
									<input type="submit" name="login" value="Login" />
									<a href="javascript:void" id="beta_forgot">Forgot your password?</a>
								</div>
							</form>
						</div>
						<div id="right_beta">
							<p id="right_info">while Spirit Friday is in its Beta Stage, we will be sending invitations to test our site. Please sign up below!</p>
							<div id="sign_up_1">
								<form id="beta_sign_up" method="post" action="/">
									<div id="email_address">
										<div class="number"><p>1</p></div>
										<p id="enter_email">enter email address</p>
									</div>
									<div id="email">
										<input type="text" name="email" />
									</div>
									<div id="school_info">
										<div class="number"><p>2</p></div>
										<p id="enter_school">enter school</p>
									</div>
									<div id="school">
										<input type="text" name="school" />
										<input type="submit" name="beta_submit" value="Submit" />
									</div>
								</form>
								<div id="success">
									<p>Your email was successfully submitted!</p>
								</div>
								<div id="duplicate">
									<p>You've already requested an invite!</p>
									<p>We'll let you know when your account is ready!</p>
								</div>
							</div>
							<div id="sign_up_2">
								<p>look for an invitation email from us!</p>
							</div>
						</div>
					</div> <!-- end right bottom -->
				</div> <!-- end bottom beta -->
			</div> <!-- end beta -->
		</div> <!-- end container -->
	</body>
</html>