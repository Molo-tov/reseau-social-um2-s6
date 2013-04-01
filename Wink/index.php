<?php
	//ini_set('display_errors', 'On');
	if((isset($_POST['connexion']))&&(isset($_SESSION['utilisateur'])))
	{
		include_once 'home.php';
	}
	else
	{
		include_once 'identification.php';
	}
?>
			
