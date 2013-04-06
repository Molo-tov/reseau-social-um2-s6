<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	if(isset($_SESSION['utilisateur']))
	{
		include_once 'home.php';
	}
	else
	{
		include_once 'identification.php';
	}
?>
			
