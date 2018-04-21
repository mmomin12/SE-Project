<!doctype html>

<html>


<head>
<title>Welcome to Study Match</title>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="./js/jquery.min.js"></script>
<script src="./js/popper.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>


<body>

 <?php
 session_start();


 if (isset($_SESSION['userid'])) {
	 header("Location: http://www.gsustudymatch.com/profile.php");
	 exit();
 } 

?>


 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"><a class="navbar-brand" href="#">STUDY MATCH</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="Register.php">Register</a></li>
                </ul>
            </div>
        </div>
</nav>
<br>
<br>
<h5>Login</h5>
<br>


<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
include 'config.php';

if(isset($_POST['submit'])){
	$email= $_POST['email'];
	
	$sql = "select * from users where gsuemail='".$email."'";
		
		$data = $conn->query($sql);
		if ($data->num_rows > 0){
			$row = $data->fetch_assoc();
			$user=$row['userid'];
			$pass=$row['password'];
			
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
		$mail->Subject = 'Forgot Password or User ID';
		$mail->Body = "User ID= $user
Password = $pass";
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo '<div class="alert alert-success">';
			echo 'Please open your email to find your password.';
			echo '</div>';
			exit();
		}
		}else{
			echo '<div class="alert alert-success">';
			echo 'This email is not registered with the system.';
			echo '</div>';
			exit();
		}
		
	
}

?>


<section class="container mt-3" style="max-width: 560px;">
		<form id="login_submit" method="post" action="forgetpassword.php" >
			<div class="form-group">
				<label>Gsu Email</label>
				<input type="text" name="email" id="email" class="form-control" >
				<span id="emailerror">Please enter your email to reset your password</span><br>
			</div>
						
			<button type="submit" id="submit" name="submit" class="btn btn-primary">Send Email</button>
		</form>
		
</section>


<script>
		$(function(){
			
			$("#emailerror").hide();
			email_error= false;
			
			$("#email").focusout(function(){
				
				emailvalid();
			
			});
			
			function emailvalid(){
			var email = $("#email").val();
				
				if(email){
					$("#emailerror").hide();
					email_error=false;
					var filter= /.+\@student.gsu.edu/;
					if (!filter.test(email)){
						$("#emailerror").html("Please enter valid gsu email");
						$("#emailerror").show();
						email_error = true;
					}
				}else{
					$("#emailerror").html("Please fill out this field");
					$("#emailerror").show();
					email_error = true;
				}	
			
		}
			
			
			$("#login_submit").submit(function(){
			 email_error=false;
				emailvalid();
			if(email_error==false){
				return true;
				
			}else{
				
				return false;
			}
			
			
		});
		
		
	});
	
	
	</script>


</body>

</html>