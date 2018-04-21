 <?php
 include '../config.php';
 
  //check for required info from the query string
  if (!$_GET[topic_id]) {
     header("Location: topiclist.php");
   exit;
 }
  
 //verify the topic exists
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
          '%b %e %Y at %r') as fmt_post_create_time, post_owner from
          forum_posts where topic_id = $_GET[topic_id]
         order by post_create_time asc";
  
     $get_posts_res = $conn->query($get_posts);
  
     //create the display string
     $display_block = "
     <P>Showing posts for the <strong>$topic_title</strong> topic:</p>
  
    <table width=100% cellpadding=3 cellspacing=1 border=1>
     <tr>
    <th>AUTHOR</th>
     <th>POST</th>
     </tr>";
  
     while ($posts_info = $get_posts_res->fetch_assoc()) {
         $post_id = $posts_info['post_id'];
         $post_text = nl2br(stripslashes($posts_info['post_text']));
         $post_create_time = $posts_info['fmt_post_create_time'];
         $post_owner = stripslashes($posts_info['post_owner']);
  
         //add to display
         $display_block .= "
        <tr>
         <td width=35% valign=top>$post_owner<br>[$post_create_time]</td>
         <td width=65% valign=top>$post_text<br><br>
          <a href=\"replytopost.php?post_id=$post_id\"><strong>REPLY TO
         POST</strong></a></td>
         </tr>";
     }
  
     //close up the table
     $display_block .= "</table>";
 }
  ?>
  <html>
  <head>
 <title>Posts in Topic</title>
  </head>
  <body>
  <h1>Posts in Topic</h1>
  <?php print $display_block; ?>
  </body>
  </html>