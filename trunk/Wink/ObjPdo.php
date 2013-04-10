<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	class ObjPdo
	{
		private static $pdo;
		public static function getPdo()
		{
			if(self::$pdo==null)
			{
				self::$pdo = new PDO('mysql:host=localhost;dbname=Winky','client','client')or exit(1);
				return self::$pdo;
			}
			else
			{
				return self::$pdo;
			}
		}
		public static function closePdo()
		{
		  	self::$pdo = null;
		}
	}
	
/*
 * $pdo = ObjPdo::getPdo();
 * $hashPass = md5($_POST['password']); //Hachage du mot de passe dans la BDD
 * if($pdo->exec("INSERT INTO ....."))	//Requete d'alteration de table
 * {
 * 	....
 * }
 * $requete=$pdo->query("SELECT ....")or exit(...);	//Requete de récupération d'informations dans la table
 * $result = $requete->fetchAll();
 * if(count($result)>0)
 * {
 * 	foreach($result as $key=>$val)
 * 	{
 * 		...
 * 	}
 * }
 * $pdo->beginTransaction();
 * ....
 * ....
 * $pdo->commit();
 */
?>
