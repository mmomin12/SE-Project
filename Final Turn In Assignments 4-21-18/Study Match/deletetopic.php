<?php
include 'config.php';
session_start();

$verify_topic = "delete from forum_topics where
     topic_id = $_GET[topic_id]";
$conn->query($verify_topic);


$get_posts = "delete from
          forum_posts where topic_id = $_GET[topic_id]";
		  
$conn->query($get_posts);

header("Location: http://www.gsustudymatch.com/mypost.php");
	 exit();
?>
