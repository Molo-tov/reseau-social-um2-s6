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
			  	echo "<img id='photo' src='img/".$photo[0]["image"]."'/>";
			}
			else
			{
			  	echo "<img id='photo' src='img/top.jpg'/>";
			}
		}
		else
		{
		  	header("index.php");
		}
	}
	function setPhotoProfil($img)
	{
		$pdo = ObjPdo::getPdo();
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
	function afficherMur()
	{
		$pdo = ObjPdo::getPdo();
		$requete = $pdo->query("SELECT * FROM Publication, Notification WHERE Publication.idDestinataire='".$_SESSION['utilisateur']->idUtilisateur."' AND Notification.idNotification=Publication.idNotification ORDER BY DESC Notification.dateNotification")or exit(1);
		$mur = $requete->fetchAll();
		foreach($mur as $publication)
		{
			$requete1 = $pdo->query("SELECT image, titre FROM Photo WHERE idPublication=".$mur['idPublication']);
			$image = $requete1->fetchAll();
			if(($publication['texte']!=null)||(count($image)>0))
			{
				echo "<div id='publication'><div id='enteteP'>";
				if($_SESSION['utilisateur']->idUtilisateur!=$mur['idDestinataire'])	//Si l'expéditeur n'est pas le propriétaire du mur
				{
					$requete2 = $pdo->query("SELECT * FROM Utilisateur WHERE idUtilisateur='".$publication['idExpediteur']."'");
					$expediteur = $requete2->fetchAll();
					if(count($expediteur)==1)
					{
						$requete3 = $pdo->query("SELECT image FROM Photo WHERE Photo.idPhoto=".$expediteur['idPhoto']);
						$photo = $requete3->fetchAll();
						if(count($photo)==1)	//Affichage de l'image de l'expéditeur dans <img id='imgDest'>
						{
							echo "<img id='imgExp' src='img/".$photo['image']."' title='".$expediteur['nom']." ".$expediteur['prenom']."' />";
						}
						else
						{
							echo "<img id='imgExp' src='img/top.jpg' />";
						}
						echo "<div id='nomExp'>".$expediteur['prenom']." ".$expediteur['nom']."</div>";	//Nom et prénom de l'expéditeur dans <div id='nomDest'>
    					}
    					else
    					{
    						echo "<div id='nomExp'>N/A</div>";
    					}
				}
				else
				{
				  	$requete2 = $pdo->query("SELECT image FROM Photo WHERE Photo.idPhoto=".$_SESSION['utilisateur']->idPhoto);
				  	$photo = $requete2->fetchAll();
				  	if(count($photo)==1)
					{
					  	echo "<img id='imgExp' src='img/".$photo['image']."' title='".$expediteur['nom']." ".$expediteur['prenom']."' />";
					}
					else
					{
						echo "<img id='imgExp' src='img/top.jpg' />";
					}
					echo "div id='nomExp'>".$_SESSION['utilisateur']->prenom." ".$_SESSION['utilisateur']->nom."</div>";
				}
    				echo "<div id='dateP'>".date("d/m/Y à H:i:s", $mur['dateNotification'])."</div></div><div id='corpsP'>";
    				if($publication['texte']!=null)
    				{
    					echo "<div id='texteP'>".$mur['texte']."</div>";
				}
				if(count($image)>0)
				{
					echo "<div id='listeImgP'>";
					foreach($image as $img)
					{
						echo "<img id='imgP' src='img/".$img['image']." title='".$img['titre']."' />";
					}
					echo "</div>";
				}
				echo "</div></div>";
			}
		}
	}
	  	
?>
