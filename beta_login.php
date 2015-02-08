<?php
	session_start();
	require_once('includes/database.php');
	require_once('includes/utility.php');
	require_once('PasswordHash.php');
	db_connect();	
	
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
	
	/*$beta_emails = array(
		"ledudley@umich.edu" => "sw9VhLR4",
		"Enaruns@aol.com" => "XnE3ZEL5",
		"deehammons@yahoo.com" => "ALTZr8JZ",
		"hathawaymoore@comcast.net" => "vjE9JUUb",
		"luvgardening@cox.net" => "AGgEkAAd",
		"pook139@aol.com" => "pbuLu6t4",
		"mjkef@aol.com" => "Bx3ytbGD",
		"hazelk@umich.edu" => "h35Qk8L7",
		"scottybo@umich.edu" => "xC8Aakbw",
		"ethinde@umich.edu" => "5wTD73Zf",
		"dmrubins@gmail.com" => "PdwXZeKC",
		"marjoripomarole@gmail.com" => "vYACBhgG",
		"weshuff@umich.edu" => "NBnT6fqS",
		"sjanec@umich.edu" => "n83Yshsb",
		"kgrimald@umich.edu" => "LBHtZ6bY",
		"tbrig@umich.edu" => "ScKsUkUr",
		"natalieshere@gmail.com" => "d3MUyFYr",
		"linneajo@umich.edu" => "gAKAz7up",
		"rmropeik@gmail.com" => "P63UmHf3",
		"hnirby@gmail.com" => "F95JHzp8",
		"natalie@spiritfriday.com" => "NNy2q6jk",
		"hayleygurriell@yahoo.com" => "JfYXnk5T",
		"kjtwill@umich.edu" => "qkHjWTUS",
		"adamjski@umich.edu" => "hLMkrbZ7",
		"nicknaruns@aol.com" => "7Cvr3mQF",
		"laurenjeworski@yahoo.com" => "75qv2N5f",
		"jesselefferts@sfhs.com" => "YuBaVfFB",
		"pnaruns@aol.com" => "yCtA4yv3",
		"zeebrand@umich.edu" => "PGZr5Sef",
		"mnschaef@umich.edu" => "pvp7WQFb",
		"ericuhlee@yahoo.com" => "tQ3UrWT8",
		"katy@spiritfriday.com" => "WTUDdJh9",
		"ken.ludwig@gmail.com" => "kHV7Zpuu",
		"megan.nikoo@gmail.com" => "7yTXT82w",
		"sjanec@umich.edu" => "VgEDy9MR",
		"jerbber@aol.com" => "Q5b2GUdj",
		"djme@umich.edu" => "bWwVm3ST",
		"latviandc@gmail.com" => "dQkPtahy",
		"jonrubins@gmail.com" => "password",
		"sdfletch@umich.edu" => "dwHCSgcU",
		"southpawe46@yahoo.com" => "ZjgXTB8q",
		"kelseynolan@gmail.com" => "3SpbUdgD",
		"nadopolo1@mac.com" => "GjRchhtt",
		"jkacerek@hotmail.com" => "dUsxR4My",
		"megcobb1313@gmail.com" => "6q6a5ePj",
		"kfgoblue@umich.edu" => "qsbnVtCR",
		"alex.schiff1128@gmail.com" => "b2mV8CAS",
		"giannaboo@sbcglobal.net" => "ZaMKpHqJ",
		"andreyartamonov2@gmail.com" => "X5AeszKC",
		"lnadel@umich.edu" => "UgD9RDa7",
		"melanie_holohan@yahoo.com" => "AnfrgTWK",
		"sabinadelrosso@gmail.com" => "4xzNjUDJ",
		"mfsween@umich.edu" => "vjjbzSQy",
		"Tbuko3@gmail.com" => "LaLRMCwy",
		"emacleod@umich.edu" => "4vayRjdR",
		"emenos@gmail.com" => "d5phymfM",
		"shoegh@umich.edu" => "b5C6e4SD",
		"goyaa1@gmail.com" => "wEm9E2d4",
		"margie.goebel@yahoo.com" => "3cxZtstv",
		"jfkwant@hotmail.com" => "QjAdVeBk",
		"cbeidler@umich.edu" => "EfVTBP7N",
		"wesleyme@umich.edu" => "6F2gxMdG",
		"claireivry@gmail.com" => "83bLYK3F",
		"jrswift@umich.edu" => "Q92BYF4k",
		"armstrong.timothy@gmail.com" => "gVgng8Sh",
		"ktobel@umich.edu" => "NuCgm8j9",
		"aladar50@gmail.com" => "9SRCSDsy",
		"djmeyer7@gmail.com" => "NWD7cYNL",
		"lmilstea@umich.edu" => "pmRpWSen",
		"tayfo@umich.edu" => "AgaCwD3C",
		"li5on@aol.com" => "jSSysKfZ",
		"dlindow1@comcast.net" => "vSCByhMN",
		"blah@gmail.com" => "M2XtbDjd",
		"bpilz@umich.edu" => "qZJ8CzXu"
	);*/
	
	$response = array();
	$email = $_POST['email']; 
	$password = $_POST['password'];
	
	
	if(($email == "admin") && ($password == "78451254986534278lkght%#@")) {
		$_SESSION['admin'] = true;
		//$_SESSION['login'] = true;
		$response['admin'] = "true";
		$response['code'] = "success";
	} else {
	
		$t_hasher = new PasswordHash(8, FALSE);
		$dbh = new PDO('mysql:host=localhost;dbname=jrubins_sf', 'jrubins_sf', 'spirit_friday');
		//$login_query = "SELECT * FROM user WHERE email='$email'";// AND password='$password'";
		$login_query = "SELECT * FROM user WHERE email=:email";
		$stmt = $dbh->prepare($login_query);
		$stmt->bindParam(':email', $email);
		
		//($login_result = mysql_query($login_query))
		if(!$stmt->execute()) {
			$response['code'] = "failure";
			$response['query'] = $login_query;
			$err = $stmt->errorInfo();
			$response['msg'] = $err[2];//mysql_error();
		} else {
			$response['code'] = "success";
			// mysql_num_rows($login_result)
			if(count($user_info = $stmt->fetch()) > 0) {
				//$user_info = mysql_fetch_assoc($login_result);
				$check = $t_hasher->CheckPassword($password, $user_info['password']);
				if(!$check) {
					$response['code'] = "failure";
					$response['login'] = "false";
					$response['bad_password'] = "true";
				} else {
					if($user_info['first_time'] == 1) {
						$_SESSION['first_time'] = true;
						$update_first_time = "UPDATE user SET first_time=0 WHERE user_id=" . $user_info['user_id'];
						mysql_query($update_first_time);
					}
					$_SESSION['user_id'] = $user_info['user_id'];
					if($user_info['first_name'] != '') {
						$_SESSION['first_name'] = $user_info['first_name'];
					}
					
					// set the colors for most popular combination
					$get_comb_query = "SELECT * FROM combinations WHERE user_id=" . $user_info['user_id'] . " LIMIT 1";
					if(!($get_comb_result = mysql_query($get_comb_query))) {
						$response['code'] = "failure";
						$response['msg'] = mysql_error();
						$response['query'] = $get_comb_query;
					} else {
						if(mysql_num_rows($get_comb_result) > 0) {
							$set_comb = mysql_fetch_assoc($get_comb_result);
							$set_colors = array();
							foreach($colors as $color) {
								if($set_comb[$color] == 1) {
									$set_colors[] = array_search($color, $colors);
								}
							}
							
							if(count($set_colors) > 0) {
								$_SESSION['cur_comb'] = $set_comb['name'];
								$_SESSION['color'] = $set_colors;
								$response['product'] = "true";
							}
						}
						
						$_SESSION['login'] = true;
						if($user_info['clothing_type'] == "men") {
							$_SESSION['gender'] = "male";
							$response['gender'] = "male";
						} else {
							$_SESSION['gender'] = "female";
							$response['gender'] = "female";
						}
						$response['login'] = "true";
						$_SESSION['email'] = $email;
						cust_log($user_info['first_name'] . " (" . $user_info['user_id'] . ") logged in at " . date("m-d-Y g:i:s A"));
					}
				}
			} else {
				$response['code'] = "failure";
				$response['bad_email'] = "true";
			}
		}
	}
		
	echo json_encode($response);
	
	

?>