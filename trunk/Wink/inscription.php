<?php
	//ini_set('display_errors', 'On');
	function inscription()
	{
		$mysql_id = mysql_connect('localhost', 'client', 'client')or die('Connexion impossible');
		mysql_select_db('Winky', $mysql_id)or die('Selection de la base de données impossible');
		$test = mysql_query("SELECT idUtilisateur FROM Utilisateur WHERE email='".$_POST['champs_mail']."'", $mysql_id)or die('Vérification impossible');
		if(mysql_num_rows($test)==0)
		{
			if($_POST['radio_h'])
			{
				$sexe=0;
			}
			else
			{
				$sexe=1;
			}
			mysql_query("INSERT INTO Utilisateur VALUES(NULL , '".$_POST['champs_password']."', '".$_POST['champs_mail']."', '".$_POST['champs_nom']."', '".$_POST['champs_prenom']."', '".$_POST['annee']."-".$_POST['mois']."-".$_POST['jour']."', 0,".$sexe.")",$mysql_id)or die("Enregistrement échoué");
			mysql_close($mysql_id);
			return 1;
		}
		else
		{
			mysql_close($mysql_id);
			return 0;
		}
	}
?>
