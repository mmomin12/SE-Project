<?php

session_start();
session_destroy();
header("Location: http://www.gsustudymatch.com/login.php");
exit();
?>