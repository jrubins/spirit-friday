<?php
	
	$message = $_POST['message'];

	$response = array();
	// send confirmation email
	$contact_to      = "spiritfriday@spiritfriday.com";
	$contact_subject = 'Spirit Friday Recommend Form';
	$contact_message = "<p>Message: $message</p>";
	$contact_headers = 'From: recommend@spiritfriday.com' . "\r\n";
	$contact_headers .= 'MIME-Version: 1.0' . "\r\n";
	$contact_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	if(mail($contact_to, $contact_subject, $contact_message, $contact_headers)) {
		$response['code'] = "success";
	} else {
		$response['code'] = "failure";
	}
	
	echo json_encode($response);


?>