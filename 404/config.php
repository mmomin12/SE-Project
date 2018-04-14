<?php


$localhost = 'localhost';
$username = 'id5202210_root1';
$password = 'root1';


$conn = new mysqli($localhost, $username, $password, 'id5202210_studymatch');

if ($conn->connect_error){
	echo "unsuccessfull";
}



?>