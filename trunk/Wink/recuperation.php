<?php
	include_once 'ObjPdo.php';
	/*
	 * Fonction getPhotoProfil : permet de recupérer la photo de profil de la base de données et de créer une balise <img id="photo">
	 * Si l'utilisateur ne possède pas de photo de profil ou si on n'arrive pas à récupérer alors on affiche l'image par défaut.
	 */
	function getPhotoProfil()
	{
	  	if(isset($_SESSION['utilisateur']))
		{
			$pdo = ObjPdo::getPdo();
			$requete = $pdo->query("SELECT image FROM Photo WHERE idPhoto='".$_SESSION['utilisateur']->idPhoto."'");
			$photo = $requete->fetchAll();
			if(count($photo)==1)
			{
			  	echo "<img id='photo' src='img/".$photo[0]["image"]."'>";
			}
			else
			{
			  	echo "<img id='photo' src='img/top.jpg'>";
			}
		}
		else
		{
		  	header("index.php");
		}
	}
	function setPhotoProfil($img)
	{
		$pdo = ObjPro();
		$requete = $pdo->query("SELECT idPhoto FROM Photo WHERE image='".$img."' AND idUtilisateur=".$_SESSION['utilisateur']->idUtilisateur)or exit(1);
		$idPhoto = $requete->fetchAll();
		if(count($idPhoto)==1)
		{
		  
			$requete = $pdo->exec("UPDATE Utilisateur SET idPhoto=".$idPhoto[0]['idPhoto']) or exit(2);
			return 0;
		}
		else
		{
		  	exit(3);
		}
	}
?>