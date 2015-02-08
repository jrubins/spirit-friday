<?php
	$already_requested = false;
	$request_email = $_POST['email'];
	$request_school = $_POST['school'];
	$fp = fopen('requests.txt', 'r');
	while(!feof($fp)) {
		$email = trim(fgets($fp, 1024));
		$school = trim(fgets($fp, 1024));
		if((strtolower($email) == strtolower($request_email)) && (strtolower($school) == strtolower($request_school))) {
			$already_requested = true;
			break;
		}
	}
	fclose($fp);
	$response = array();
	if(!$already_requested) {
		// send confirmation email
		$beta_to      = $request_email;
		$beta_subject = 'Spirit Friday Sign-up Confirmation';
		$beta_message = "<p>Thank you for signing up with Spirit Friday. While we are in our beta testing stage, we will be sending out invitations to test our site as they become available. In the meantime, feel free to follow us on <a href='https://twitter.com/#!/SpiritFriday' target='_blank'>Twitter</a> and like us on <a href='http://www.facebook.com/pages/Spirit-Friday/176837485739059' target='_blank'>Facebook</a>! Thank you for your interest, and we look forward to making your shopping easier!</p><p>Sincerely,</p><p>The Spirit Friday Team</p>";
		$beta_headers = 'From: spiritfriday@spiritfriday.com' . "\r\n";
		$beta_headers .= 'MIME-Version: 1.0' . "\r\n";
		$beta_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		if(mail($beta_to, $beta_subject, $beta_message, $beta_headers)) {
			// send new request email
			$to      = 'spiritfriday@spiritfriday.com';
			//$to = 'jonrubins@gmail.com';
			$subject = 'New SF Beta Request';
			$message = "Email address: " . $request_email . "\n";
			$message .= "School: " . $request_school . "\n";
			$headers = 'From: no-reply@spiritfriday.com' . "\r\n";
			if(mail($to, $subject, $message, $headers)) {
				$fp = fopen('requests.txt', 'a');
				fwrite($fp, $request_email . "\n");
				fwrite($fp, $request_school . "\n");
				fclose($fp);
				$response['code'] = "success";
			} else {
				$response['code'] = "failure";
			}
		} else {
			$response['code'] = "failure";
		}
	} else {
		$response['code'] = "duplicate";
	}
	echo json_encode($response);


?>