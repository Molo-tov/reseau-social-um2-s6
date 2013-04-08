<?php
	//ini_set('display_errors', 'On');
	//on veut afficher le nom de la personne connecté
	include_once "recuperation.php";
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
            <script type="text/javascript" src="js/apparition_info.js"></script>
        </head>

         <body>
            
            <div id="haut_page">
                <h1 id="titre"> Winky</h1>

                <div id="texte_connecte">
                   <?php echo $_SESSION['utilisateur']->prenom.' '.$_SESSION['utilisateur']->nom; ?>
                 </div> 

                 <div id="notif">
                    <span id="icone_profil"><div id="logo_icone_profil"><img src="img/profil.png"></div></span>
                    <span id="icone_notification"></span>
                    <span id="icone_reglages"><div id="logo_icone_reglages"><img src="img/reglage.png"></div></span>
                    <span id="icone_deconnexion"><div id="logo_icone_deconnexion"><img src="img/deco.png"></div></span>
                </div>

             </div>   
            
             <div class="fleche_apparition">
            <div id="bouton_info"></div> 
             <div id="info_profil">

                <span id="info_texte">Nom : </span> <?php echo $_SESSION['utilisateur']->nom; ?><br>
                <span id="info_texte">Prénom : </span> <?php echo $_SESSION['utilisateur']->prenom; ?><br>
                <span id="info_texte">Date de naissance : </span> <?php echo $_SESSION['utilisateur']->dateNaissance; ?><br>
                <span id="info_texte">email : </span> <?php echo $_SESSION['utilisateur']->email; ?><br>  
                      
             </div>
         </div>


            <div id="contenu">  

                <div id="barre_gauche">
                    <div id="cadre_photo"></div>

                    <!--div id="photo"><img src="img/top.jpg"></div-->
                    <?php getPhotoProfil(); ?>
                    <div class="recherche">
                        <form method="GET" action="home.php">
                            <input type="text" class="champs_recherche" name="champs_recherche" placeholder="Rechercher ..." />
                            <input type="submit" class="bouton_recherche" value=""/> 

                        </form>
                    </div>

                      

                    <div class="menu">
                           
                            <li class="ascenseur">Acceuil</li>
                            <li class="ascenseur">Amis</li>
                            <li class="ascenseur">Messages</li>
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
                                
                            <li class="ascenseur">Conversations</li>

                    </div>
                    
                </div>

             

                <div class="bulle_statut">
                            <form class="bulle_mur">
                                <textarea class="text_bulle" name="text_bulle" placeholder="Exprimez vous : "></textarea><br>
                                <input class="publier" type="submit" name="publier" value="Publier" />
                            </form>
                        </div>

                <div id="mur">
                        <div class="mur_de">Mur de : </div>
                        

                        <div class="mur_publication">

                            <div class="result">

                            </div> 
                        
                        </div>

                </div>

            </div>      



        </body>

      
</html>
