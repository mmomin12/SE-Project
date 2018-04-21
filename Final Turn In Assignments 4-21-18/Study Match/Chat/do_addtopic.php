<?php
  include '../config.php';
  //check for required fields from the form
   if ((!$_POST[topic_owner]) || (!$_POST[topic_title])
       || (!$_POST[post_text])) {
       header("Location: addtopic.html");
       exit;
   }
   

 
  //create and issue the first query
  $add_topic = "insert into forum_topics values ('', '$_POST[topic_title]',
      now(), '$_POST[topic_owner]')";
  
	$conn->query($add_topic);
	
 //get the id of the last query 
  $topic_id = $conn->insert_id;
  
  //create and issue the second query
  $add_post = "insert into forum_posts values ('', '$topic_id',
      '$_POST[post_text]', now(), '$_POST[topic_owner]')";
  
  $conn->query($add_post);
  
  //create nice message for user
  $msg = "<P>The <strong>$topic_title</strong> topic has been created.</p>";
 ?>
  <html>
 <head>
 <title>New Topic Added</title>
</head>
<body>
 <h1>New Topic Added</h1>
<?php print $msg; ?>
 </body>
 </html>