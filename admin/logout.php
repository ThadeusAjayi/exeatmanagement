<?php

session_start();

if(isset($_SESSION['admin'])){
	
	session_unset();
	session_destroy();
	
	header("Location: login.php?status=success&msg=Successfully Signed Out");
}

?>