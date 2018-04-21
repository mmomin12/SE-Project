

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	 
	 session_start(); 
	 $_SESSION['userid'] = $_POST['userid'];
	 
	 header("Location: http://www.gsustudymatch.com/profile.php");
	 exit();

}
else{
	
		header("Location: http://www.gsustudymatch.com/login.php");
		exit();
}

?>
