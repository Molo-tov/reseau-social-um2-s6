<?php
	//ini_set('display_errors', 'On');
	//on veut afficher le nom de la personne connecté
?>

<!DOCTYPE html>
<html>
<head>
            <meta charset="UTF-8"/>
            <link rel="stylesheet" href="css/styleAll.css"/>
            <link rel="stylesheet" href="css/style_home.css"/>
            <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="js/fonction.js"></script>
            <script type="text/javascript" src="js/jquery.notif.js"></script>
        </head>

        <body>
        	
            <div id="haut_page">
        		<h1 id="titre"> Wink ;)</h1>
                <div id="texte_connecte">
                    <p>Vous êtes connecté : <?php echo $_SESSION['utilisateur']->prenom.' '.$_SESSION['utilisateur']->nom; ?></p>
                 </div>

                 <div class="notifications">
                     <div class="notification">
                         <div class="left">
                             <div class="icon">
                                &#128077;
                            </div> 
                         </div>
                         <div class="right">
                            <h2>Titre</h2>
                             <p>Une petite description</p>
                        </div>
                     </div>
                </div>

             </div>   
        	
        	<div id="contenu">	

                <div id="barre_gauche">
                    <div id="cadre_photo"></div>

                    <div id="photo"><img src="img/top.jpg"></div>
                       
                    <div class="recherche">
                        <form method="GET" action="#">
                            <input type="text" class="champs_recherche" name="champs_recherche" placeholder="Rechercher ..." />
                            <input type="submit" class="bouton_recherche" value=""/>

                        </form>
                    </div>

                    <div class="menu">
                           
                            <li class="ascenseur">Actualités</li>
                            <li class="ascenseur">Mes amis</li>
                            <li class="ascenseur">Mes Messages</li>
                            <li class="ascenseur">Groupes</li>
                                <div>
                                
                                    <li><a href="#">groupe 1</a></li>
                                    <li><a href="#">groupe 2</a></li>
                                    <li><a href="#">groupe 3</a></li>
                                    <li><a href="#">groupe 4</a></li>
                                    <li><a href="#">groupe 5</a></li>
                                    <li><a href="#">groupe 6</a></li>
                                    <li><a href="#">groupe 7</a></li>
                                    <li><a href="#">groupe 8</a></li>
                                
                                </div>
                                
                            <li class="ascenseur"> Evenements</li>
                                <div>
                                
                                    <li><a href="#">evenement 1</a></li>
                                    <li><a href="#">evenement 2</a></li>
                                    <li><a href="#">evenement 3</a></li>
                                    <li><a href="#">evenement 4</a></li>
                                
                                </div>
                                
                            <li class="ascenseur">Messagerie instantanée</li>

                    </div>
                    
                </div>

                <div class="notifications2">
                    <div class="icone_messages">
                        &#59160;
                     </div>  

                    <div class="icone_reglages">
                        &#9881;
                    </div>  

                </div>

        	
                <div id="mur">
                        <div class="bulle_statut">
                            <form class="bulle_mur">
                            <input class="text_bulle" type="text" name="text_bulle"/><br>
                            <input class="publier" type="submit" name="publier" value="Publier" />
                            </form>
                        </div>

                        <div class="mur_publication"></div>

                </div>

        	</div>		



        </body>

      
</html>
