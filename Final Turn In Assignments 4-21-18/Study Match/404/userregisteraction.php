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


include 'config.php';

if (isset($_POST['userid']) && isset($_POST['useremail']) && isset($_POST['userpassword'])){

	$user = $_POST['userid'];
	$password=$_POST['userpassword'];
	$email= $_POST['useremail'];
	$hash = md5( rand(0,1000) );



	$sql = "INSERT INTO users (userid, password, gsuemail, hash) VALUES ('".$user."','".$password."','".$email."','".$hash."')";

	if ($conn->query($sql) === TRUE) {
		$to      = $email; // Send email to our user
		$subject = 'Signup | Verification'; // Give the email a subject 
		$message = '
		 
		Thanks for signing up!
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
		 
		Please click this link to activate your account:
		planted-comments.000webhostapp.com/verify.php?email='.$email.'&hash='.$hash.'
		 
		';
							 
		$headers = 'From:noreply@studymatch.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers);
		
		echo '<div class="alert alert-success">';
		echo 'Please open your email and click on the link provided to activate your account.';
		echo '</div>';
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}else{
	header ('Location: www.facebook.com');
	exit();
}

?>

<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
	Copyright &copy; 2018 Panther Coders All Rights Reserved.
</footer>


</body>

</html>