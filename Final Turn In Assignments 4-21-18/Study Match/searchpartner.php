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

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.html">STUDY MATCH</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div id="navbar" class="collapse navbar-collapse">
      <div class="topnav-right">
			  <ul class="navbar-nav mr-auto">
				  <li class="nav-item active">
					  <a class="nav-link" href="index.html">Main</a>
				  </li >
        </ul>

        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
          <a class="nav-link" href="searchpartner.php">SearchPartner</a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="chatroom.html">Chatroom</a>
        </li >

        <li class="nav-item active">
          <a class="nav-link" href="discussion.php">Discussion</a>
        </li >

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown">User Control</a>
          <div class="dropdown-menu" aria-labelledby="dropdown">
            <a class="dropdown-item" href="logout.php">Log out</a>
            <a class="dropdown-item" href="setting.php">Setting</a>
          </div>
        </li>
      </ul>
      </div>
		</div>
	</nav>

<br>
  

  <section class="container">
      <h2>Partner</h2>
        <p>Search Your Partner</p>

       <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">

		<div class="form-row">
		  <div class="form-group col-sm-6">
			<label>search</label>
			  <input type="text" name="search" class="form-control" maxlength="20">
		  </div>
		  
		<div class="">
          <button type="submit" class="btn btn-primary topnav-right">Submit</button>
        </div>
		  
		</form>

         
  </section>


<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
  Copyright &copy; 404 NOT FOUND All Rights Reserved.
</footer>

<?php 

	include 'config.php';
	
	$search = $_POST['search'];
	
	$sql = "SELECT * FROM WHERE firstname='".$search."'";
	
	$res=$conn->query($sql);
	
	echo $res;
	
	?>
	

</body>

</html>
