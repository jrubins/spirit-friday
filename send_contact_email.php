<?php
	$name = $_POST['name'];
	$phone = $_POST['number'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$response = array();
	// send confirmation email
	$contact_to      = "spiritfriday@spiritfriday.com";
	$contact_subject = 'Spirit Friday Contact Form';
	$contact_message = "<p>Name: $name</p><p>Phone Number: $phone</p><p>Email: $email</p><p>Message: $message</p>";
	$contact_headers = 'From: ' . $email . "\r\n";
	$contact_headers .= 'MIME-Version: 1.0' . "\r\n";
	$contact_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	if(mail($contact_to, $contact_subject, $contact_message, $contact_headers)) {
		$response['code'] = "success";
	} else {
		$response['code'] = "failure";
	}
	
	echo json_encode($response);


?>