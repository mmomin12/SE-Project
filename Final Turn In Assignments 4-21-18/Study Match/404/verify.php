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



if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	$email=$_GET['email'];
	$hash=$_GET['hash'];
   
    $search = "SELECT gsuemail, hash, active FROM users WHERE gsuemail='".$email."' AND hash='".$hash."' AND active='0'"; 
    $res=$conn->query($search);
	$match=$res->num_rows;
            
    if($match > 0){
        // We have a match, activate the account
        $conn->query("UPDATE users SET active='1' WHERE gsuemail='".$email."' AND hash='".$hash."' AND active='0'");
		echo '<div class="alert alert-success">';
        echo 'Your account has been activated, you can now login';
		echo '</div>';
		
    }else{
        echo '<div class="alert alert-danger">';
        echo 'The url is either invalid or you already have activated your account.';
		echo '</div>';
    }
                 
}else{
    echo '<div class="alert alert-danger">';
    echo 'Invalid approach, please use the link that has been send to your email.</div>';
	echo '</div>';
}


?>

<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
	Copyright &copy; 2018 Panther Coders All Rights Reserved.
</footer>



</body>

</html>