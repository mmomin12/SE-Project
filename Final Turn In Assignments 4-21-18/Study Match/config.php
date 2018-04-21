<?php


$localhost = 'localhost';
$username = 'u889291016_study';
$password = 'studymatch';


$conn = new mysqli($localhost, $username, $password, 'u889291016_study');

if ($conn->connect_error){
	echo "unsuccessfull";
}



?>