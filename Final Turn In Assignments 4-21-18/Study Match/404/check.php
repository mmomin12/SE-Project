<?php
 
 include 'config.php';

if(isset($_POST['user'])){
	
	 $user=$_POST['user'];
	
	 $sql="select * from users where userid = '$user'";

     $res=$conn->query($sql);
	 
	echo $res->num_rows;
}

if(isset($_POST['email'])){
	
	 $email=$_POST['email'];
	
	 $sql="select * from users where gsuemail = '$email'";

     $res=$conn->query($sql);
	 
	echo $res->num_rows;
}


if(isset($_POST['userid']) && $_POST['pass'] ){
	$userid = $_POST['userid'];
	$pass = $_POST['pass'];


	
	$sql="select * from users where userid = '$userid' AND password = '$pass'";
	
	$res=$conn->query($sql);
	
	if ($res->num_rows > 0){
		while($row = $res->fetch_assoc()) {
			if($row["active"]==1){
				echo 1;
			}
			else{
				echo 2;
			}
		}
	}else{
		echo 0;
	}
	
}
?>