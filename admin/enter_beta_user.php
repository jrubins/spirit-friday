<?php
	session_start();
	if(!$_SESSION['admin']) {
		header("Location: ../index.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>Spirit Friday</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#enter_beta_user").submit(function(event) {
					event.preventDefault();

					var email = $(this).find("input[name='email']").val(),
						temp_password = $(this).find("input[name='temp_password']").val();

					$.post(
						"submit_beta_user.php",
						{ email: email, password: temp_password },
						function(data) {
							var response = jQuery.parseJSON(data);
							if(response.code == "success") {
								$("#results").append("<p>Email: " + email + " and Temp Password: " + temp_password + " were entered into the system.</p>");
							} else if(response.code == "failure") {
								alert(response.err);
								$("#results").append("<p>There was an error processing your requet.</p>");
							}
						}
					);
				});
			});
		</script>
	</head>
	<body>
		<form method="post" action="/" id="enter_beta_user">
			<table>
				<tr>
					<td>Email:</td>
					<td><input type="text" name="email" /></td>
				</tr>
				<tr>
					<td>Temp Password:</td>
					<td><input type="text" name="temp_password" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Submit" /></td>
				</tr>
			</table>
		</form>

		<div id="results">
		</div>
	</body>
</html>