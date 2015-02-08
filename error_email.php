<?php
	$error = $_POST['error'];
	$query = $_POST['query'];

	// send confirmation email
	$contact_to      = "jonrubins@gmail.com";
	$contact_subject = 'Spirit Friday Error';
	$contact_message = "<p>Error: $error</p><p>Query: $query</p>";
	$contact_headers = 'From: error@spiritfriday.com' . "\r\n";
	$contact_headers .= 'MIME-Version: 1.0' . "\r\n";
	$contact_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($contact_to, $contact_subject, $contact_message, $contact_headers);



?>