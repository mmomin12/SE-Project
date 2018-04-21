<?php
include 'config.php';

if(isset($_GET['up'])){
	$sql = "update forum_posts SET up = '1' where
     post_id = $_GET[id]";
	$res=$conn->query($sql);
	$sql = "update forum_posts SET down = '0' where
     post_id = $_GET[id]";
	$res=$conn->query($sql);
	
	 header("Location:  http://www.gsustudymatch.com/showtopic1.php?topic_id=$_GET[tid]");
	exit;
	
	
}
else if(isset($_GET['down'])){
	$sql = "update forum_posts SET up = '0' where
     post_id = $_GET[id]";
	$res=$conn->query($sql);
	$sql = "update forum_posts SET down = '1' where
     post_id = $_GET[id]";
	$res=$conn->query($sql);
	
	
	 header("Location:  http://www.gsustudymatch.com/showtopic1.php?topic_id=$_GET[tid]");
	exit;
}





?>