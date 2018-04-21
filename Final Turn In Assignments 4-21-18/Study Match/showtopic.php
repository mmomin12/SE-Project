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
<style>

.sub{
	width:80%;
	margin-left:200px;
}

</style>


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
	include 'config.php';
	session_start();
	
 if (!isset($_SESSION['userid'])) {
	 header("Location: http://www.gsustudymatch.com/login.php");
	 exit();
 } 	
 
 if (!$_GET[topic_id]) {
   header("Location:  http://www.gsustudymatch.com/discussion.php");
	exit;
 }
 $topic_id = $_GET['topic_id'];
 
 if(isset($_POST['answer'])){ 
	 $add_post = "insert into forum_posts values ('', '$topic_id',
      '$_POST[answer]', now(), '$_SESSION[userid]', 1,0,0)";
     $conn->query($add_post);
 }
 
 
 $verify_topic = "select topic_title from forum_topics where
     topic_id = $_GET[topic_id]";
 $verify_topic_res = $conn->query($verify_topic);

  if ($verify_topic_res->num_rows < 1) {
     //this topic does not exist
    $display_block = "<P><em>You have selected an invalid topic.
     Please <a href=\"topiclist.php\">try again</a>.</em></p>";
 } else {
     //get the topic title
	 while ($top = $verify_topic_res->fetch_assoc()) {
    $topic_title = $top['topic_title'];
	 }
    //gather the posts
    $get_posts = "select post_id, post_text, date_format(post_create_time,
          '%b %e %Y at %r') as fmt_post_create_time, post_owner, sub, up, down from
          forum_posts where topic_id = $_GET[topic_id]
         order by post_create_time asc";
  
     $get_posts_res = $conn->query($get_posts);
  
    
  
     while ($posts_info = $get_posts_res->fetch_assoc()) {
         $post_id = $posts_info['post_id'];
         $post_text = nl2br(stripslashes($posts_info['post_text']));
         $post_create_time = $posts_info['fmt_post_create_time'];
         $post_owner = stripslashes($posts_info['post_owner']);
		 $sub = $posts_info['sub'];
		 $up = $posts_info['up'];
		 $down = $posts_info['down'];
         //add to display
		  if ($sub<1){
         $display_block .= 
		 
		 "<section>
		<div class='card bg-light mt-3'>
			<div class='card-header bg-light'>
				<div class='row'>
					<div class='col-8 text-left'>$post_owner</div><span class='pull-right'>$post_create_time</span>
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
					<a class='btn btn-primary mx-1 mt-2' data-toggle='modal' href='#registerModal'>reply</a></td>
						
					</div>
				</div>
			</div>
		</div>
		</section>";
		  }
		  else{
			  if($up){
				   $display_block .= 
		 
		 "<section class='sub'>
		<div class='card bg-light mt-3'>
			<div class='card-header bg-light'>
				<div class='row'>
					<div class='col-8 text-left'>$post_owner</div><span class='pull-right'>$post_create_time</span>
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
					<a class='btn btn-primary mx-1 mt-2' data-toggle='modal' href='#registerModal'>reply</a></td>
					<img src='up.png'>
					 
					</div>
				</div>
			</div>
		</div>
		</section>";
			  }
			  else if($down){
				   $display_block .= 
		 
		 "<section class='sub'>
		<div class='card bg-light mt-3'>
			<div class='card-header bg-light'>
				<div class='row'>
					<div class='col-8 text-left'>$post_owner</div><span class='pull-right'>$post_create_time</span>
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
					<a class='btn btn-primary mx-1 mt-2' data-toggle='modal' href='#registerModal'>reply</a></td>
					<img src='down.png'>
					 
					</div>
				</div>
			</div>
		</div>
		</section>";
				  
			  }
			  else{
			   $display_block .= 
		 
		 "<section class='sub'>
		<div class='card bg-light mt-3'>
			<div class='card-header bg-light'>
				<div class='row'>
					<div class='col-8 text-left'>$post_owner</div><span class='pull-right'>$post_create_time</span>
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
					<a class='btn btn-primary mx-1 mt-2' data-toggle='modal' href='#registerModal'>reply</a></td>
					 
					</div>
				</div>
			</div>
		</div>
		</section>";
			  }
		  }
		
     }
  
 }
  ?>
  
   <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">

		<div class="modal-dialog">
			<div class="modal-content">
			
				<div class="modal-header">
					<h5 class="modal-title" id="modal">Discussion & Rate</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					<form action="showtopic.php?topic_id=<?php echo $topic_id; ?>" method="post">
						<div class="form-group">
							<label>your opinion</label>
							<textarea name="answer" class="form-control" maxlength="2048" style="height: 180px;"></textarea>
						</div>
						
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			
     </div>
  <?php print $display_block; ?>
  
  
	
	
	
	
	
<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
  Copyright &copy; 404 NOT FOUND All Rights Reserved.
</footer>








</body>


</html>
