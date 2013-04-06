<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	/*Fonction inscription() : 
	 * Sert à envoyer un mail de confirmation d'inscription après que l'utilisateur ai validé son formulaire d'inscription.
	 * Décommenter les lignes 43 et 56 si on a un serveur de mail (SMTP) pour envoyer un mail de confirmation.
	 * Codes de retour :
	 * 0 : Le mail a été envoyé avec succès.
	 * 1 : Connexion avec la base de données impossible.
	 * 2 : 	Transaction avec la base de données impossible.
	 * 3 : Echec lors de l'envoi du mail de confirmation.
	 * 4 : Adresse email déjà utilisée.
	 * 5 : On renvoie un mail de confirmation.
	 */
	function inscription()
	{
	  	$pdo = ObjPdo::getPdo();
		if($pdo==1) exit(1);
		$test = $pdo->query("SELECT idUtilisateur FROM Utilisateur WHERE email='".$_POST['champs_mail']."'")or exit(2);
		$result = $test->fetchAll();
		if(count($result)==0)
		{
			$val = 0;
			for($i = 0; i<10;++i)
			{
				$val += pow(10,i)*rand(0,9);
			}
			if($_POST['radio_h'])
			{
				$sexe=0;
			}
			else
			{
				$sexe=1;
			}
			$test2 = $pdo->query("SELECT * FROM InscriptionEnAttente WHERE email = '".$_POST['champs_mail']."'")or exit(2);
			$result2 = $test2->fetchAll();
			if(count($result2)==0)
			{
			  	try
			  	{
			  		$pdo->beginTransaction();
					$pdo->exec("INSERT INTO InscriptionEnAttente VALUES(NULL , '".$_POST['champs_mail']."', '".$_POST['champs_password']."', '".$_POST['champs_nom']."', '".$_POST['champs_prenom']."', '".$_POST['annee']."-".$_POST['mois']."-".$_POST['jour']."', '".$sexe."', '".$val."')");
					//mail($_POST['champs_mail'], "Vérification de l'inscription", "Bonjour et bienvenu sur WinkyNet.\nMerci de cliquer sur ce lien pour confirmer votre inscription\nhttp://localhost/Wink/inscription.php?email=".$_POST['champs_mail']."&code=".$val."\nMerci."); 
					$pdo->commit();
					header("http://localhost/Wink/inscription.php?email=".$_POST['champs_mail']."&code=".$val);	//Commenter cette ligne si on a un serveur de mail (SMTP)
					return 0;
				}
				catch(Exception $e)
				{	
				 	$pdo->rollback();
				 	return 3;
				}
			}
			else
			{
			  	//mail($_POST['champs_mail'], "Vérification de l'inscription", "Bonjour et bienvenu sur WinkyNet.\nMerci de cliquer sur ce lien pour confirmer votre inscription\nhttp://localhost/Wink/inscription.php?email=".$_POST['champs_mail']."&code=".$val."\nMerci."); 
			  	header("http://localhost/Wink/inscription.php?email=".$_POST['champs_mail']."&code=".$val);	//Commenter cette ligne si on a un serveur de mail (SMTP) 
			  	return 5;
			}
		}
		else
		{
			return 4;
		}
	}
	/*Fonction validerInscription() : 
	 * Sert à valider l'inscription après que l'utilisateur ai reçu un email de confirmation.
	 * Codes d'erreur : 
	 * 0 : Confirmation effectuée. L'utilisateur peut maintenant se connecter au réseau social.
	 * 1 : Connexion avec la base de données impossible.
	 * 2 : Transaction avec la base de données impossible.
	 * 3 : Code fourni incorrect.
	 * 4 : Email fourni incorrect.
	 */
	function validerInscription()
	{
	  	 $pdo = ObjPdo::getPdo();
	  	 if($pdo==1) exit(1);
	  	 $info = $pdo->query("SELECT * FROM InscriptionEnAttente WHERE email='".$_GET['email']."'")or exit(2);
	  	 $assocInfo = $info->fetchAll();
		 if(count($assocInfo)==1)
		 {
		 	$donnees = $assocInfo[0];
		 	if($donnees['code']==$_GET['code'])
		 	{
			  	try
			  	{
					$pdo->beginTransaction();
			  		$pdo->query("INSERT INTO Utilisateur VALUES(NULL, '".$donnees['password']."', '".$donnees['email']."', '".$donnees['nom']."', '".$donnees['prenom']."', '".$donnees['dateAnniversaire']."', '0', '".$donnees['sexe']."'");
		 			$pdo->query("DELETE FROM InscriptionEnAttente WHERE email='".$donnees['email']."'");
		 			$pdo->commit();
			 		return 0;
				}
				catch(Exception $e)
				{
				  	$pdo->rollback();
				  	return 2;
				}
		 	}
		 	else
		 	{
		 		return 3;
		 	}
		 }
		 else
		 {
		 	return 4;
		 }
	}
?>

