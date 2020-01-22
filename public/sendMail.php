<?php

	$lastname  = isset($_POST['lastname'])   ?  trim($_POST['lastname'])  : null ;
	$firstname = isset($_POST['firstname'])  ?  trim($_POST['firstname']) : null ;
	$email     = isset($_POST['email'])      ?  trim($_POST['email'])     : null ;
	$phone     = isset($_POST['phone'])      ?  trim($_POST['phone'])     : null ;
	$company   = isset($_POST['company'])    ?  trim($_POST['company'])   : null ;
	$message   = isset($_POST['message'])    ?  trim($_POST['message'])   : null ;
	$sendto    = isset($_POST['sendto'])     ?  trim($_POST['sendto'])    : null ;

	if($lastname != null
		&& $firstname != null
		&& $email != null
		&& $phone != null
		&& $company != null
		&& $message != null
		&& $sendto != null ) {

		// SEND MAIL
		$headers = array(
		    'From' => $email,
		    'Reply-To' => $email,
		    'X-Mailer' => 'PHP/' . phpversion()
		);

		$content =  "Nom : " . "\n" . $lastname . "\n" . "\n".
					"Prénom : " . "\n" . $firstname . "\n" . "\n".
					"Email : " . "\n" . $email . "\n" . "\n".
					"Téléphone : " . "\n" . $phone . "\n" . "\n".
					"Socièté : " . "\n" . $company . "\n" . "\n".
					"Message : " . "\n" . $message . "\n" . "\n";

		mail($sendto, 'CONTACT', $content, $headers);

		echo 'true';
	}
	else { echo 'false;' }

?>