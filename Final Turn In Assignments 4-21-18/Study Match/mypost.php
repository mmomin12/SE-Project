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
          <a class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown">My Account</a>
          <div class="dropdown-menu" aria-labelledby="dropdown">
            <a class="dropdown-item" href="logout.php">Log out</a>
            <a class="dropdown-item" href="setting.php">Setting</a>
          </div>
        </li>
      </ul>
      </div>
		</div>
	</nav>
	
<?php
	
	session_start();
	
 if (!isset($_SESSION['userid'])) {
	 header("Location: http://www.gsustudymatch.com/login.php");
	 exit();
 } 
 ?>
 

	<br>
	<br>
 
					
				
<?php
   include 'config.php';
	session_start();
   
  //gather the topics
   $get_topics = "select topic_id, topic_title,
  date_format(topic_create_time, '%b %e %Y at %r') as fmt_topic_create_time,
  topic_owner from forum_topics order by topic_create_time desc";
  $get_topics_res = $conn->query($get_topics);
  
	$num=$get_topics_res->num_rows;
  

  if ($num < 1) {
     //there are no topics, so say so
     $display_block = "<P><em>There are no Posts.</em></p>";
  } else {
     //create the display string
    
  
      while ($topic_info =  $get_topics_res->fetch_assoc()) {
		
		  
		  if($topic_info['topic_owner'] == $_SESSION['userid']){
			 $topic_id = $topic_info['topic_id'];
         $topic_title = stripslashes($topic_info['topic_title']);
         $topic_create_time = $topic_info['fmt_topic_create_time'];
         $topic_owner = stripslashes($topic_info['topic_owner']);
  
          //get number of posts
         $get_num_posts = "select * from forum_posts
              where topic_id = $topic_id";
         $get_posts_res = $conn->query($get_num_posts);
		 
		  $post_info =  $get_posts_res->fetch_assoc(); 
			$post_text = $post_info['post_text'];
  
         
        
		 
		$display_block .= "
		<section>
		<div class='card bg-light mt-3'>
			<div class='card-header bg-light'>
				<div class='row'>
					<div class='col-8 text-left'>$topic_owner</div><span class='pull-right'>$topic_create_time</span>
					<div class='col-4 text-right'>
					</div>
				</div>
			</div>
			<div class='card-body'>
				<h5 class='card-title'>
					$topic_title
				</h5>
				<p class='card-text'>$post_text</p>
				<div class='row'>
				
					<div class='col-6 text-right'>
					<a class='btn btn-info' href='showtopic1.php?topic_id=$topic_id'>View Answers</a>
					<a class='btn btn-danger' href='deletetopic.php?topic_id=$topic_id'>Delete</a>
						
					</div>
				</div>
			</div>
		</div>
		</section>";
		  }
		  

     }
	  

    
  }
  ?>

<?php print $display_block; ?>


<br>
<br>
<br>
<br>
<br>
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
