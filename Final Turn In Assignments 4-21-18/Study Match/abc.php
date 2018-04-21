<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require 'vendor/autoload.php';
	  
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->Host = 'mx1.hostinger.com';
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->Username = 'admin@gsustudymatch.com';
		$mail->Password = 'study-match';
		$mail->setFrom('admin@gsustudymatch.com', 'STUDY MATCH');
		$mail->addReplyTo('admin@gsustudymatch.com', 'STUDY MATCH');
		$mail->addAddress('mmomin12@student.gsu.edu');
		$mail->Subject = 'PHPMailer SMTP message';
		$mail->Body = 'This is a plain text message body';
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message sent!';
		}
	
		
		?>