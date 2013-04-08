<?php
	include_once "ObjPdo.php";
	class Utilisateur
	{
		private $password;
		private $mysql_id;
		private $idUtilisateur;
		private $nom;
		private $prenom;
		private $dateNaissance;
		private $email;
		private $idPhoto;
		public function __get($attribut)
		{
			if($attribut=='password'){return $this->password;}
			else if($attribut=='mysql_id'){return $this->mysql_id;}
			else if($attribut=='idUtilisateur'){return $this->idUtilisateur;}
			else if($attribut=='nom'){return $this->nom;}
			else if($attribut=='prenom'){return $this->prenom;}
			else if($attribut=='dateNaissance'){return $this->dateNaissance;}
			else if($attribut=='email'){return $this->email;}
			else if($attribut=='idPhoto'){return $this->idPhoto;}
			else {return null;}
		}	
		public function __construct($pw, $mail)
		{
			$this->password=$pw;
			$this->email=$mail;
			$this->mysql_id=-1;
			$this->idUtilisateur = -1;
			$ident = $this->identification();
			if($this->idUtilisateur>=0)
			{	
				$this->setInfo();
			}
		}
		public function identification()
		{
			$pdo = ObjPdo::getPdo();
			$ident = $pdo->query("SELECT idUtilisateur, password FROM Utilisateur WHERE email='".$this->email."'")or exit(3);
			$result = $ident->fetchAll();
			if(count($result)>0)
			{
				if($result[0]["password"] == $this->password)
				{
					$this->idUtilisateur = $result[0]['idUtilisateur'];
				}
			}
		}
		public function setInfo()
		{
			$pdo = ObjPdo::getPdo();
			$info = $pdo->query("SELECT nom, prenom, dateNaissance, optionDroit, idPhoto FROM Utilisateur WHERE email='".$this->email."'")or exit(3);
			$assocInfo = $info->fetchAll();
			if(count($assocInfo)==0)
			{
				$this->nom=-1;
			}
			else
			{
				$this->nom=$assocInfo[0]['nom'];
				$this->prenom=$assocInfo[0]['prenom'];
				$this->optionDroit=$assocInfo[0]['optionDroit'];
				$this->dateNaissance=$assocInfo[0]['dateNaissance'];
				$this->idPhoto=$assocInfo[0]['idPhoto'];
			}
		}
	}		
?>
