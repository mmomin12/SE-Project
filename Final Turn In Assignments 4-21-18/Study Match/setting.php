<!doctype html>

<html>


<head>
<title>Study Match</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="./js/jquery.min.js"></script>
<script src="./js/popper.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</head>


<body>


	<?php
	
	include 'config.php';
	session_start();
	if (isset($_SESSION['userid'])){
		
	$sql = "select * from profile where userid='".$_SESSION['userid']."'";
	
	$res=$conn->query($sql);
	
	$row = $res->fetch_assoc();
	
		$fname=$row['firstname'];
		$lname=$row['lastname'];
		$gender=$row['sex'];
		$type=$row['type'];
			
	
	}else{
		header("Location: http://www.gsustudymatch.com/login.php");
		exit();
	}
	
	?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.html">STUDY MATCH</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div id="navbar" class="collapse navbar-collapse">
      <div class="topnav-right">
			  <ul class="navbar-nav mr-auto">
				  <li class="nav-item active">
					  <a class="nav-link" href="logout.php">Logout</a>
				  </li >
			</ul>

		</div>
	</nav>

  <div class="container">
    <h2>CREATE PROFILE</h2>
	
    <form action="profilesave.php" method="post">

    <div class="form-row">
      <div class="form-group col-sm-6">
        <label>First Name</label>
          <input type="text" name="Fname" value="<?php echo $fname; ?>" class="form-control" maxlength="20">
      </div>

      <div class="form-group col-sm-6">
        <label>Last Name</label>
          <input type="text" name="Lname" value="<?php echo $lname; ?>" class="form-control" maxlength="20">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-sm-4">
        <label>sex</label>
        <select name="sex" class="form-control">
          <option value="Female" <?php if($gender=="Female") echo 'selected="selected"'; ?> >Female</option>
          <option value="Male" <?php if($gender=="Male") echo 'selected="selected"'; ?> >Male</option>
        </select>
      </div>

      <div class="form-group col-sm-4">
        <label>type</label>
        <select name="semesterDivide"class="form-control">
          <option value="Associate" <?php if($type=="Associate") echo 'selected="selected"'; ?> >Associate</option>
          <option value="Bachelor" <?php if($type=="Bachelor") echo 'selected="selected"'; ?> >Bachelor</option>
          <option value="Master" <?php if($type=="Master") echo 'selected="selected"'; ?>>Master</option>
        </select>
      </div>

      

        <div class="">
          <button type="submit" class="btn btn-primary topnav-right">Update</button>
        </div>


  </form>
  </div>

<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
	Copyright &copy; 2018 Panther Coders All Rights Reserved.
</footer>




</body>


</html>
