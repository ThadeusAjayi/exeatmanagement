<?php

session_start();

if(isset($_SESSION['user'])){
	
	session_unset();
	session_destroy();
	
	header("Location: login.php?status=success&msg=Successfully Signed Out");
}

?>