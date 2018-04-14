<!doctype html>

<html>


<head>
<title>Register</title>
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
            <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
</nav>
<br>
<br>
<h5>Register</h5>
<br>


<section class="container mt-3" style="max-width: 560px;">

		<form id="reg_submit" method="post" action="userregisteraction.php" >
			<div class="form-group">
				<label>User Name</label>
				<input type="text" name="userid" id="userid" class="form-control" >
				<span id="usererror"></span><br>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="userpassword" id="userpassword" class="form-control" >
				<span id="passworderror"></span><br>
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="text" name="useremail" id="useremail" class="form-control" >
				<span id="emailerror"></span><br>
			</div>

			<button type="submit" class="btn btn-primary">Sign up</button>
		</form>

</section>




<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
	Copyright &copy; 2018 Panther Coders All Rights Reserved.
</footer>



	<script>
		$(function(){

			$("#usererror").hide();
			$("#passworderror").hide();
			$("#emailerror").hide();


			var user_error = false;
			var password_error = false;
			var email_error = false;

			$("#userid").focusout(function(){

				uservalid();

			});

			$("#userpassword").focusout(function(){

				passwordvalid();

			});

			$("#useremail").focusout(function(){

				emailvalid();

			});

			function uservalid(){
				var user = $("#userid").val();

				if(user){
					$("#usererror").hide();
					user_error=false;
					$.post("check.php",{ user: user, },function(data){
							if(data > 0){
								$("#usererror").html("User Id already taken");
								$("#usererror").show();
								user_error = true;
							}
						});
				}else{
					$("#usererror").html("Please fill out this field");
					$("#usererror").show();
					user_error = true;
				}

			}

			function passwordvalid(){
				var password = $("#userpassword").val();

				if(password){
					$("#passworderror").hide();
					password_error=false;
					if(password.length<8){
						$("#passworderror").html("Password must be atleast 8 character");
						$("#passworderror").show();
						password_error=true;
					}
					else{
						$("#passworderror").hide();
					}
				}else{
					$("#passworderror").html("Please fill out this field");
					$("#passworderror").show();
					password_error=true;
				}

			}


		function emailvalid(){
			var email = $("#useremail").val();

				if(email){
					$("#emailerror").hide();
					email_error=false;
					var filter= /.+\@student.gsu.edu/;
					if (!filter.test(email)){
						$("#emailerror").html("Please enter valid gsu email");
						$("#emailerror").show();
						email_error = true;
					}else{
					$.post("check.php",{ email: email, },function(data){
							if(data > 0){
								$("#emailerror").html("This email is already registered");
								$("#emailerror").show();
								email_error = true;
							}
						});
					}
				}else{
					$("#emailerror").html("Please fill out this field");
					$("#emailerror").show();
					email_error = true;
				}

		}

		$("#reg_submit").submit(function(){
			 user_error=false;
			 email_error=false;
			 password_error=false;
				uservalid();
				passwordvalid();
				emailvalid();
			if(user_error==false && email_error==false && password_error==false){
				return true;

			}else{

				return false;
			}


		});


	});


	</script>





</body>


</html>
