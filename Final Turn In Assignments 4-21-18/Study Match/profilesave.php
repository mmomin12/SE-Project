<?php 
include 'config.php';

	session_start();
	


if (!empty($_POST)){
	$first_name = $_POST['Fname'];
	$last_name = $_POST['Lname'];
	$sex = $_POST['sex'];
	$type = $_POST['type'];
	$college = $_POST['College'];
	$major= $_POST['sel_subj'];
	
	$sql = "INSERT INTO profile (firstname, lastname, sex, type, college, major, userid) VALUES ('".$first_name."','".$last_name."','".$sex."','".$type."','".$college."','".$major."','".$_SESSION['userid']."')";
	
	if ($conn->query($sql) === TRUE) {
		
		$sql = "select * from users where userid='".$_SESSION['userid']."'";
	
		$res=$conn->query($sql);
	
		while($row = $res->fetch_assoc()) {
			if($row["profile"]==0){
				$conn->query("UPDATE users SET profile='1' WHERE userid='".$_SESSION['userid']."' AND profile='0'");
					$_SESSION['profile'] = 1;
					header("Location: http://www.gsustudymatch.com/discussion.php");
					exit();
			}
			else{
				header("Location: http://www.gsustudymatch.com/discussion.php");
				exit();
			}
		
		}	
		

	}
	else{
		echo $conn->error;
	}
	
	
}else{
	header("Location: http://www.gsustudymatch.com/profile.php");
	exit();
}


?>
	