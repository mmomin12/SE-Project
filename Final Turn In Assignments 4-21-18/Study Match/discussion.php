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
 
  include 'config.php';
  //check for required fields from the form
   if (($_POST['topic_title'])
       && ($_POST['post_text'])) {
       
   
   $owner = $_SESSION['userid'];

 
  //create and issue the first query
  $add_topic = "insert into forum_topics values ('', '$_POST[topic_title]',
      now(), '$owner')";
  
	$conn->query($add_topic);
	
 //get the id of the last query 
  $topic_id = $conn->insert_id;
  
  //create and issue the second query
  $add_post = "insert into forum_posts values ('', '$topic_id',
      '$_POST[post_text]', now(), '$owner', 0,0,0)";
  
  $conn->query($add_post);
  
  
	   }
 ?>
 
  <section class="container">
		<form action="mypost.php">
		<button class="btn btn-primary pull-right">My Posts</button>
		</form>
		<form action="discussion.php" method="post">
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label>Class Name</label>
								<input type="text" name="topic_title" class="form-control" size=40 maxlength="150">
							</div>
						</div>
							
						<div class="form-group">
							<label>Question</label>
							<textarea name="post_text" class="form-control" maxlength="2048" style="height: 180px;"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Create New Post</button>
		</form>					
	</section>	
	<br>
	<br>
 
					
				
<?php
   
   
  //gather the topics
   $get_topics = "select topic_id, topic_title,
  date_format(topic_create_time, '%b %e %Y at %r') as fmt_topic_create_time,
  topic_owner from forum_topics order by topic_create_time desc";
  $get_topics_res = $conn->query($get_topics);
  
 
  
  if ($get_topics_res->num_rows < 1) {
     //there are no topics, so say so
     $display_block = "<P><em>No topics exist.</em></p>";
  } else {
     //create the display string
    
  
      while ($topic_info =  $get_topics_res->fetch_assoc()) {
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
					<a class='btn btn-info' href='showtopic.php?topic_id=$topic_id'>answer</a>
						
					</div>
				</div>
			</div>
		</div>
		</section>";
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
