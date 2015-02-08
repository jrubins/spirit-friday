<?php
	//require_once('database.php');
	
	//db_connect();
	$dbh = new PDO('mysql:host=localhost;dbname=jrubins_sf', 'jrubins_sf', 'spirit_friday');
	
	session_start();
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$stmt = $dbh->prepare("SELECT * FROM user WHERE username=:username AND password=:password");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		/*$check_login_query = "SELECT * FROM user WHERE username='" . $username . "' AND password='" . $password . "'";
		$check_login_result = mysql_query($check_login_query);*/
		//if(mysql_num_rows($check_login_result) == 0) {
		if(count($stmt->fetchAll()) == 0) {
			$failure = true;
		} else {
			// sign in successful
			$_SESSION['loggedIn'] = true;
			header("Location: real_index.php");
		}
	}
	
?>
<html>
	<head>
		<style type="text/css">
			#container {
				width: 500px;
				margin: 100px auto;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<h3>Please login below</h3>
			<form action="index.php" method="POST">
				<?php
					if($failure) {
						echo "<p style='color:#FF0000;font-weight:bold'>Your login was incorrect. Please try again.</p>";
					}
				?>
				<table>
					<tr>
						<td>Enter username:</td>
						<td><input type="text" name="username" /></td>
					</tr>
					<tr>
						<td>Enter password:</td>
						<td><input type="password" name="password" /></td>
					</tr>
				</table>
				<input type="submit" name="submit" value="Login" />
			</form>
		</div>
	</body>
</html>