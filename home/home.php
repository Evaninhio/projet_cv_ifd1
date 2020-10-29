<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- Le job de vos rêves est à portée de main ! </title>
    <link rel="stylesheet" href="home_css.css"> <!---lien sur le fichier css-->
</head>


<body>


<div id="fond_menu">

    <ul id="menu">
        <li><a href="#second_section">Qui sommes-nous ?</a></li>
        <li>
            <?php
            if (isset($_GET['connected']))
            {
                echo "<a href='../generator_cv/formations_cv.php'>Essayez dès maintenant</a>";
            }
            else if(isset($_GET['connection-error']))
            {
                echo "<a href=\"home.php?connection-error\">Vous devez etre connecté</a>";
            }
            else {
            echo "<a href=\"home.php?connection-error\">Essayez dès maintenant</a>";
            }

            ?>
        </li>

        <li>
            <?php
            if (isset($_GET['creation_compte']))
            {
                echo "<p>Compte créé avec succès</p>";
            }
            elseif (isset($_SESSION["prenom"]))
            {
            }
            else{
                echo" <a href=\"../connexion_inscription/inscription.php\">Inscription</a>";
            }

            ?>

        </li>
        <li>
        <?php
        if(isset($_SESSION["prenom"])==FALSE)
        {
            echo "
            <a href= \" ../connexion_inscription/connexion.php\">Connexion<img src=\"../images/kisspng-india-login-computer-icons-emoticon-medicine-user-login-icon-5ab05c8bc2f8d1.4479395815215074677986.jpg\" alt=\"photo profil\"></a>
            ";
        }
        else{
            echo 'Connecté <img src="data:image/png;base64,'.base64_encode( $_SESSION['photo_profil'] ).'"/>';
        }

        ?>

        </li>

        <?php
        if(isset($_SESSION["prenom"])==TRUE)
        {
            echo " <li>
            <a href=\"../connexion_inscription/log_out.php\" target=\"_blank\">Déconnexion</a>
        </li>";
        }

       ?>

    </ul>

</div>

<section class="first_section">



    <?php
    $now=date( "H");



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

    <p>

    <p id="slogan_home">Rédigez un CV n'a jamais été aussi simple! </p>

    <div id="arguments">
        <ul>
        <li>Modifiez et améliorez votre CV à volonté</li>
        <li>Disponible à tout moment sur téléphone,tablettes et ordinateurs</li>
        <li>Profitez des conseils et astuces de nos experts gratuitement</li>
    </ul>

     <img id="ex_cv" src="../images/86-modele-cv-parfait.jpg" alt="exemple_cv">

    </div>

    <div id="stat">


        <?php
        $nb_user=0;
        $nb_schools=0;
        $nb_formations=0;
        $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
        $req = $bdd-> prepare("SELECT COUNT(*) from utilisateur;");
        $req->execute();
        $data=$req->fetch();
        $nb_user=$data[0];
        /*we get the number of users*/
        $req = $bdd-> prepare("SELECT COUNT(*) from liste_ecole;");
        $req->execute();
        $data=$req->fetch();
        $nb_schools=$data[0];
        $req = $bdd-> prepare("SELECT COUNT(*) from type_diplome;");
        $req->execute();
        $data=$req->fetch();
        $nb_formations=$data[0];

        echo"
        <p><strong>$nb_user</strong>  personnes ont déja franchi le pas !</p>
        <p><strong>$nb_schools</strong>  écoles déja recensées</p>
        <p><strong>$nb_formations</strong>  formations déja enregistrées</p>
        ";
        ?>
    </div>

</section>

<section id="second_section">
    <p>Qui sommes nous ?</p>
</section>


<div id="fond_bandereau_fin">
    <ul id="bandereau_fin">
        <li><a href="mailto:corentin.latimier@utbm.fr">Nous contacter</li>
        <li><a href="http://www.utbm.fr"><img src="../images/1200px-Utbm.svg.png" alt="logo_utbm"></li>
    </ul>

</div>


</body>

</html>
