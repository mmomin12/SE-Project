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




<section class="container mt-3" style="max-width: 560px;">
		 <div id="loginerror" class="alert alert-danger"></div>
		<form id="login_submit" method="post" action="loginaction.php" >
			<div class="form-group">
				<label>User ID</label>
				<input type="text" name="userid" id="userid" class="form-control" >
				<span id="usererror"></span><br>
			</div>
			
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="userpassword" id="userpassword" class="form-control" >
				<span id="passworderror"></span><br>
			</div>
						
			<button type="submit" id="submit"  class="btn btn-primary">Login</button>
			<a href="forgetpassword.php">Forgot password?</a>
		</form>
		
</section>


<script>
		$(function(){
			$("#loginerror").hide();
			$("#usererror").hide();
			$("#passworderror").hide();
			
			var user_error = false;
			var password_error = false;
			var yes = 0;
			
			$("#userid").focusout(function(){
				
				uservalid();
			
			});
			
			$("#userpassword").focusout(function(){
				
				passwordvalid();
				
			});
			
			function uservalid(){
				var user = $("#userid").val();
				
				if(!user){
					$("#usererror").html("Please fill out this field");
					$("#usererror").show();
					user_error = true;
				}else{
					$("#usererror").hide();
					user_error = false;
				}	
			
			}
			
			function passwordvalid(){
				var password = $("#userpassword").val();
				
				if(!password){
					$("#passworderror").html("Please fill out this field");
					$("#passworderror").show();
					password_error=true;
				}else{
					$("#passworderror").hide();
					password_error=false;
				}	
			
			}
			
			
			$("#login_submit").submit(function(e){
				var user_error = false;
				var password_error = false;
				uservalid();
				passwordvalid();
				var user = $("#userid").val();
				var password = $("#userpassword").val();
				$.post("check.php",{ userid: user, pass:password },function(data){
					if(data==0){
					$("#loginerror").html("Invalid UserName and/or Password");
					$("#loginerror").show();
					yes=0;
					}
					else if(data==2){
					$("#loginerror").html("This account is not verified yet. Login your email and click confirmation link to activate the account");
					$("#loginerror").show();
					yes=0;
					}
					else{
						yes=1;
					}
				});
				
			
				if(yes){
					return true;
				}
				return false; 
				
						
			});
			
			
		
	});


</script>
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
