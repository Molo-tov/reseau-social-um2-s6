<?php
	//ini_set('display_errors', 'On');   //Affiche les messages d'erreurs et warning
	include_once 'utilisateur.php';	//Inclusion de la classe Utilisateur
	session_start();
	$connectReussie=false;
	if(isset($_POST['connexion']))		//Si l'utilisateur a appuyé sur Connexion du formulaire de connexion
	{
		$utilisateur = new Utilisateur($_POST['pass'], $_POST['id']);	//Création d'un utilisateur avec identification dans la base de données
		if($utilisateur->idUtilisateur != -1)	
		{
			$_SESSION['utilisateur']=$utilisateur;
			$connectReussie=true;
			include 'home.php';
		}
		else if($utilisateur->idUtilisateur == -1)
		{
			echo "Erreur d'email ou de mot de passe";
		}
		else if($utilisateur->nom ==-1)	
		{
			echo "Récupération des informations de l'utilisateur échouée";
		}
		else	
		{
			echo "Connexion à la base de données impossible";
		}
	}
	else if(isset($_POST['champs_prenom']) && !empty($_POST['champs_prenom']) && !empty($_POST['champs_nom']) && !empty($_POST['champs_mail']) )//On regarde si les variables $_POST['pseudo'] et $_GET['formulaire'] existent, sinon la condition ne sera pas validée
     	{ 
		$_POST['jour']=13;
		$_POST['mois']=7;
		$_POST['annee']=1989;
		include_once 'inscription.php';
		if(inscription()==1)
		{
			echo 'Inscription effectuée';
		}
		else
		{
			echo "Erreur lors de l'inscription, email déjà existant";
		}
	} 
	if(!$connectReussie)
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
        		<form id="login_form" action="index.php" method="post">
        			<br>
              
        			<input class="id" type="text" name="id" value="Adresse email"><br>
        			<input class="pass" type="password" name="pass" placeholder="Mot de passe">
        			<input class="connexion" type="submit" name="connexion" value="Connexion">
       			</form>

       			<form id="inscription_form" action="index.php" method="post">   
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
