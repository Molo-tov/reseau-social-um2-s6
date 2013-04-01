<?php
	//ini_set('display_errors', 'On');   //Affiche les messages d'erreurs et warning
	include 'utilisateur.php';	//Inclusion de la classe Utilisateur
	if($_POST['connexion'])		//Si l'utilisateur a appuyé sur Connexion du formulaire de connexion
	{
		$utilisateur = new Utilisateur($_POST['pass'], $_POST['id']);	//Création d'un utilisateur avec identification dans la base de données
		if($utilisateur->mysql_id == -1)	//Cas ou la connexion est impossible
		{
			echo 'Connexion avec la base de donnees impossible';
		}
		else if($utilisateur->idUtilisateur <0)	//Cas ou l'authentification de l'utilisateur est erronée
		{
			echo "Erreur de mot de passe ou d'adresse mail";
		}
		else	//Si le client est authentifié
		{
			session_start();
			$_SESSION['utilisateur']=$utilisateur;
			include 'home.php';	//On ne passe pas sur home.php, on reste sur cette page mais on récupère les informations... A revoir....
		}
	}
	else if(isset($_POST['champs_prenom']) && !empty($_POST['champs_prenom']) && !empty($_POST['champs_nom']) && !empty($_POST['champs_mail']) )//On regarde si les variables $_POST['pseudo'] et $_GET['formulaire'] existent, sinon la condition ne sera pas validée
     	{ 
	     	session_start(); //on ouvre une session
	    	$_SESSION['champs_prenom'] = $_POST['champs_prenom'];
		header("location:home.php");
     	} 
	else
	{
?>
<!DOCTYPE html>
<html>
<head>
            <meta charset="UTF-8"/>
            <link rel="stylesheet" href="css/style_identification.css"/>
            <link rel="stylesheet" href="css/styleAll.css"/>

            <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="js/script.js"></script>
        </head>

        <body>
        	<div id="haut_page">
        		<h1 id="titre"> Wink ;)</h1>
        	</div>
        	
        	<div id="contenu">	
        		<form id="login_form" action="identification.php" method="post">
        			<br>
              
        			<input class="id" type="text" name="id" value="Adresse email"><br>
        			<input class="pass" type="password" name="pass" placeholder="Mot de passe">
        			<input class="connexion" type="submit" name="connexion" value="Connexion">
       			</form>

       			<form id="inscription_form" action="#" method="post">   
       			<h3 id="text_inscription"><strong>Nouveau ? Inscrivez-vous</strong></h3>
      
       				<input class="champs_prenom" type="text" name="champs_prenom" placeholder="Prénom"><br>
       				<input class="champs_nom" type="text" name="champs_nom" placeholder="Nom"><br>
       				<input class="champs_mail" type="text" name="champs_mail" placeholder="Adresse email"><br>
       				<input class="champs_password" type="password" name="champs_password" placeholder="Mot de passe"><br>
        			<input class="radio_h" type="radio" name="radio_h" value="Homme"><label id="text_H" for="radio_h">Homme</label>
       				<input class="radio_f" type="radio" name="radio_f" value="Femme"><label id="text_F" for="riche">Femme</label><br>
       				
       				<label id="text_Anniversaire">Anniversaire :</label><input type="date" class="champs_anniversaire" name="anniversaire" placeholder="JJ/MM/AAAA"/><br>
       				<input type="submit" class="champs_inscription" name="inscription" value="Inscription">
       			</form>
        	
        	</div>		

        </body>
</html>
<?php
	}
?>
