<?php
session_start();
//ce code permet d'utiliser les variables de session
?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>My Online CV- Le job de vos rêves est à portée de main ! </title>
        <link rel="stylesheet" href="home_css.css"> <!---lien sur le fichier css qui gère la mise en forme de la page-->
    </head>


    <body>


        <div id="fond_menu">
        <!-- tout ce qui est contenu dans cette div correspond à la banderole située en haut de la page-->

            <ul id="menu">
                <!-- liste de tous les élements situés dans la banderole du haut-->


                <li>
                    <!--ce code php gère ce qui est affiche dans la banderole en fonction de l'état de connexion/déconnexion-->
                    <?php
                        if (isset($_GET['connected']))
                        {
                         //on affiche alors le lien vers la page de création de cv si l'utilisateur est connecté cad si la variable connected est set dqns l'url
                            echo "<a href='../generator_cv/formations_cv.php'>Essayez dès maintenant</a>";
                        }
                        else if(isset($_GET['connection-error']))
                        {
                            //si la variable connection-error est set l'utilisateur a cliqué sans etre connecté
                            echo "<a href=\"home.php?connection-error\">Vous devez etre connecté</a>";
                        }
                        else {
                            //si l'utilisateur n'est pas connecté et clique pour la première fois sur le lien de creation de cv on le renvoie sur la page d'accueil avec connexion-error dans l'url
                        echo "<a href=\"home.php?connection-error\">Essayez dès maintenant</a>";
                        }
                    ?>
                </li>

                <li>
                    <?php
                        if (isset($_GET['creation_compte']))
                        {
                            //si l'utilisateur crée un compte on renvoie la variable creation-compte dans l'url et on affiche un message de succès
                            echo "<p>Compte créé avec succès</p>";
                        }
                        elseif (isset($_SESSION["prenom"]))
                        {
                        }
                        else{
                            //ici les variables de session ne sont pas crées et l'utilisateur ne vient pas de créer un compte on afiiche donc un lien vers la page d'inscription
                            echo" <a href=\"../connexion_inscription/inscription.php\">Inscription</a>";
                        }
                    ?>
                </li>

                <li>
                    <?php
                        if(isset($_SESSION["prenom"])==FALSE)
                        {
                            //si l'utilisateur n'est pas  connecté on affiche une pseudo photo de profil
                            echo " <a href= \" ../connexion_inscription/connexion.php\">Connexion<img src=\"../images/photo_profil_visiteur.jpg\" alt=\"photo profil\"></a> ";
                        }
                        else{
                            //sinon on affiche la photo contenue dans la base de données et stockée dans la variable de session photo_profil
                            echo 'Connecté <img src="data:image/png;base64,'.base64_encode( $_SESSION['photo_profil'] ).'"/>';
                        }
                    ?>
                </li>


                <!--si l'utilisateur est connecté on lui propose de se déconnecter-->
                <?php
                    if(isset($_SESSION["prenom"]))
                    {
                        echo " <li><a href=\"../connexion_inscription/log_out.php\" target=\"_blank\">Déconnexion</a></li>";
                    }
               ?>

            </ul>

        </div>

        <section class="first_section">
        <!--contenu de la page-->
            <?php
            $now=date( "H");
            //message dynamique en fonction de l'heure
                if($now>12 && $now<20)
                {
                        echo"<h1 id='welcome'> Bon après-midi sur My Online CV  </h1>";
                }
                else if ($now>20)
                {
                    echo"<h1 id='welcome'> Bonne soirée sur My Online CV</h1>";
                }
                else
                {
                    echo"<h1 id='welcome'> Bonne matinée sur My Online CV </h1>";
                }


            ?>

            <p id="slogan_home">Rédigez un CV n'a jamais été aussi simple! </p>

            <div id="arguments">
                <ul>
                    <li>Modifiez et améliorez votre CV à volonté</li>
                    <li>Disponible à tout moment sur téléphone,tablettes et ordinateurs</li>
                    <li>Profitez des conseils et astuces de nos experts gratuitement</li>
                </ul>

                <img id="ex_cv" src="../images/modele_cv_1.jpg" alt="exemple_cv">
            </div>

            <div id="stat">


                <?php
                    $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                    $req = $bdd-> prepare("SELECT COUNT(*) from utilisateur;");
                    $req->execute();
                    $data=$req->fetch();
                    $nb_user=$data[0];

                    //on récupère le nombre d'utilisateurs du site à partir de la table utilisateur de la base de données
                    $req = $bdd-> prepare("SELECT COUNT(*) from ecole;");
                    $req->execute();
                    $data=$req->fetch();
                    $nb_schools=$data[0];
                    //de la meme facon pour le nombre d'écoles et de diplômes

                    $req = $bdd-> prepare("SELECT COUNT(*) from type_diplome;");
                    $req->execute();
                    $data=$req->fetch();
                    $nb_formations=$data[0];

                    //on affiche le résultat

                    echo"
                    <p><strong>$nb_user</strong>  personnes ont déja franchi le pas !</p>
                    <p><strong>$nb_schools</strong>  écoles déja recensées</p>
                    <p><strong>$nb_formations</strong>  formations déja enregistrées</p>
                    ";
                ?>
            </div>

        </section>


        <div id="fond_bandereau_fin">
            <ul id="bandereau_fin">
                <li><a href="mailto:corentin.latimier@utbm.fr,evan.denis@utbm.fr">Nous contacter</li>
                <!--lien de contact par mail-->
                <li><a href="http://www.utbm.fr"><img src="../images/logo_utbm.png" alt="logo_utbm"></li>
                <!--lien vers le site ubtm-->
            </ul>
        </div>

    </body>
</html>
