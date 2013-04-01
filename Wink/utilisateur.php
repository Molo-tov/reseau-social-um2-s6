<?php
	class Utilisateur
	{
		private $password;
		private $mysql_id;
		private $idUtilisateur;
		private $nom;
		private $prenom;
		private $dateNaissance;
		private $email;
		public function __get($attribut)
		{
			if($attribut=='password'){return $this->password;}
			else if($attribut=='mysql_id'){return $this->mysql_id;}
			else if($attribut=='idUtilisateur'){return $this->idUtilisateur;}
			else if($attribut=='nom'){return $this->nom;}
			else if($attribut=='prenom'){return $this->prenom;}
			else if($attribut=='dateNaissance'){return $this->dateNaissance;}
			else if($attribut=='email'){return $this->email;}
			else {return null;}
		}	
		public function __construct($pw, $mail)
		{
			$this->password=$pw;
			$this->email=$mail;
			$this->connexion();
			if($this->mysql_id!=-1)
			{
				$this->idUtilisateur=$this->identification();
				if($this->idUtilisateur>=0)
				{	
					$this->getInfo();
				}
			}
			mysql_close($this->mysql_id);
		}
		public function connexion()
		{
			$this->mysql_id = mysql_connect('localhost', 'client', 'client')or die('Connexion impossible');
			if($this->mysql_id)
			{
				mysql_select_db('Winky', $this->mysql_id)or die('Selection de la base de données impossible');
			}
		}
		public function identification()
		{
			$ident = mysql_query("SELECT idUtilisateur, password FROM Utilisateur WHERE email='".$this->email."'", $this->mysql_id) or die('Requete impossible');
			if(mysql_num_rows($ident) == 0)
			{
				$this->idUtilisateur=-2;
			}
			else
			{	
				$this->idUtilisateur = -1;
				while (($result = mysql_fetch_assoc($ident))&&($this->idUtilisateur==-1)) 
				{
					if($result["password"] == $this->password)
					{
						$this->idUtilisateur = $result['idUtilisateur'];
					}
				}
			}
		}
		public function getInfo()
		{
			$info = mysql_query("SELECT nom, prenom, dateNaissance, optionDroit FROM Utilisateur WHERE email='".$this->email."'", $this->mysql_id)or die('Requete getInfo impossible');
			if(mysql_num_rows($info)==0)
			{
				echo "</br>pas d'information</br>";
				mysql_close($this->mysql_id);
				$this->nom=-1;
			}
			else
			{
				$infot=mysql_fetch_assoc($info);
				$this->nom=$infot['nom'];
				$this->prenom=$infot['prenom'];
				$this->optionDroit=$infot['optionDroit'];
				$this->dateNaissance=$infot['dateNaissance'];
			}
			mysql_close($this->mysql_id);
		}
	}		
?>
