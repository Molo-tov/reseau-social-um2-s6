<?php
	include_once 'ObjPdo.php';
	function getPhotoProfil()
	{
	  	if(isset($_SESSION['utilisateur'])
		{
			$pdo = ObjPdo::getPdo();
			if($pdo==1) echo "<div id='photo'><img src='img/top.jpg'></div>";
			else
			{
				$requete = $pdo->query("SELECT image FROM Photo WHERE idPhoto='".$_SESSION['utilisateur']."'");
				$photo = $requete->fetchAll();
				if(count($photo)==1)
				{
				  	echo "<div id='photo'><img src='".$photo[0]["image"]."'></div>";
				}
				else
				{
				  	echo "<div id='photo'><img src='img/top.jpg'></div>";
				}
			}
		}
		else
		{
		  	header("index.php");
		}
	}
	function setPhotoProfil()
	{
	  	
?>