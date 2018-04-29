<!--
Author: Syed Alfran Ali
 ID : 2015Kucp1032
  Work: The page that logs out the user by destroying his/her session and redirects to login page
-->

<?php

	//starting session
	session_start();

	//if session is set, unset and destroy it
	if(isset($_SESSION['name']))
	{
		session_unset();
		session_destroy();
	}

	//redirect user to login page
	header("Location: login.php");

?>
