<?php
	class Utilisateur
	{
		private $mysql_id;
		private $idUtilisateur;
		private $nom;
		private $prenom;
		private $dateNaissance;
		private $email;
		public function __get($attribut)
		{
			return $this->$attribut;
		}	
		public function __construct()
		{
			$email=$_POST['id'];
			$mysql_id=connection();
			if($mysql_id!=-1)
			{
				$idUtilisateur=identification();
				if($idUtilisateur>=0)
				{	
					getInfo();
				}
			}
		}
		public function connection()
		{
			$mysql_id = mysql_connect('localhost', 'client', 'client') or return -1;
			mysql_select_db('Winky', $mysql_id) or return -1;
			return $mysql_id;
		}
		public function identification()
		{
			$ident = mysql_query("SELECT password FROM Utilisateur WHERE email='$email'", $mysql_id) or return -1;
			if(mysql_num_rows($ident) == 0)
			{
				return -2;
			}
			else
			{	
				$idU = -1;
				while (($result = mysql_fetch_assoc($ident))&&($idU==-1)) 
				{
					if($result["password"] == $_POST["password"])
					{
						$idU = $result["idUtilisateur"];
					}
				}
				return $idU;		
			}
		}	
		public function getInfo()
		{
			$info = mysql_query("SELECT nom, prenom, dateNaissante, optionDroit FROM Utilisateur WHERE idUtilisateur=".$_SESSION['idUtilisateur'].";", $mysql_id);
			if(mysql_num_rows($info)==0)
			{
				mysql_close($mysql_id);
				$nom=-1;
			}
			else
			{
				$nom=$info['nom'];
				$prenom=$info['prenom'];
				$optionDroit=$info['optionDroit'];
				$dateNaissance=$info['dateNaissance'];
			}
		}
	}		
?>
