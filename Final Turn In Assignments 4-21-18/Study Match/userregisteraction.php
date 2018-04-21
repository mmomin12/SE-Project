<!doctype html>

<html>


<head>
<title>Account Activation</title>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="./js/jquery.min.js"></script>
<script src="./js/popper.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body>

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"><a class="navbar-brand" href="#">STUDY MATCH</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
</nav>
<br>
<br>



<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
include 'config.php';

if (isset($_POST['userid']) && isset($_POST['useremail']) && isset($_POST['userpassword'])){

	$user = $_POST['userid'];
	$password=$_POST['userpassword'];
	$email= $_POST['useremail'];
	$hash = md5( rand(0,1000) );



	$sql = "INSERT INTO users (userid, password, gsuemail, hash) VALUES ('".$user."','".$password."','".$email."','".$hash."')";

	if ($conn->query($sql) === TRUE) {
							 
	
			
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Host = 'mx1.hostinger.com';
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->Username = 'admin@gsustudymatch.com';
		$mail->Password = 'study-match';
		$mail->setFrom('admin@gsustudymatch.com', 'STUDY MATCH');
		$mail->addReplyTo('admin@gsustudymatch.com', 'STUDY MATCH');
		$mail->addAddress($email);
		$mail->Subject = 'Sign Up | Verification';
		$mail->Body = " Click on the button below to verify
<p class='send'><a href='www.gsustudymatch.com/verify.php?email=$email&hash=$hash'>Verify Now</a></p>";
		$mail->IsHTML(true); 
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo '<div class="alert alert-success">';
			echo 'Please open your email and click on the link provided to activate your account.';
			echo '</div>';
		}
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}else{
	header ('Location: www.facebook.com');
	exit();
}

?>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
  Copyright &copy; 404 NOT FOUND All Rights Reserved.
</footer>


</body>

</html>