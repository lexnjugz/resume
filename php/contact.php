<?php 
//////////////////////////
//Specify default values//
//////////////////////////

//Your E-mail
$your_email = 'info@lexnjugz.co.ke';

//Default Subject if 'subject' field not specified
$default_subject = 'From My Contact Form';

//Message if 'name' field not specified
$name_not_specified = 'Please type a valid name';

//Message if 'message' field not specified
$message_not_specified = 'Please type a vaild message';

//Message if e-mail sent successfully
$email_was_sent = 'Thanks, your message successfully sent';

//Message if e-mail not sent (server not configured)
$server_not_configured = 'Sorry, mail server not configured';


///////////////////////////
//Contact Form Processing//
///////////////////////////
$error = array();
if(isset($_POST['userMessage']) and isset($_POST['userName'])) {
	if(!empty($_POST['userName']))
		$sender_name  = stripslashes(strip_tags(trim($_POST['userName'])));
	
	if(!empty($_POST['userMessage']))
		$message      = stripslashes(strip_tags(trim($_POST['userMessage'])));
	
	if(!empty($_POST['userEmail']))
		$sender_email = stripslashes(strip_tags(trim($_POST['userEmail'])));


	//Message if no sender name was specified
	if(empty($sender_name)) {
		$error[] = $name_not_specified;
	}

	//Message if no message was specified
	if(empty($message)) {
		$error[] = $message_not_specified;
	}

	$from = (!empty($sender_email)) ? 'From: '.$sender_email : '';

	$subject = $default_subject;

	$message = (!empty($message)) ? wordwrap($message, 70) : '';

	//sending message if no errors
	if(empty($error)) {
		if (mail($your_email, $subject, $message, $from)) {
			echo $email_was_sent;
		} else {
			$error[] = $server_not_configured;
			echo implode('<br>', $error );
		}
	} else {
		echo implode('<br>', $error );
	}
}
?>