

<?php
session_start();
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="feuilles_de_style/competences.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>My Online CV - Créez votre CV en toute simplicité</title>
</head>


<body>

<!--debut menu vertical-->

<input type="checkbox" id="check">

<header>

    <label for="check">
        <i class="fas fa-bars" id="sidebar_button"></i>
    </label>

    <div class="left_area">
        <h1> Créer mon CV </h1>
    </div>



</header>

<div class="side_bar">

    <center>
        <?php
        if(isset($_SESSION["prenom"]))
        {
            echo '<img class="profile_photo" src="data:image/png;base64,'.base64_encode( $_SESSION['photo_profil'] ).'"/>';
        }
        ?>
        <h2>

            <?php
            if(isset($_SESSION["prenom"]))
            {
                echo $_SESSION["prenom"];
            }
            ?>

        </h2>
    </center>

    <a href="formations_cv.php"><i class="fas fa-graduation-cap"></i><span>Formations</span></a>

    <a href="experience_pro.php"><i class="fas fa-briefcase"></i><span>Expériences professionnelles</span></a>

    <a href="experience_benevolat.php"><i class="fas fa-hands-helping"></i><span>Expériences de bénévolat</span></a>

    <a href="#"><i class="fas fa-check"></i><span>Compétences</span></a>

    <a href="langues.php"><i class="fas fa-language"></i><span>Langues</span></a>

    <a href="passions.php"><i class="fas fa-heart"></i><span>Passions</span></a>

    <a href="#"><i class="fas fa-download"></i><span> Générer le CV</span></a>

    <a href="../connexion_inscription/log_out.php" target="_blank"><i class="fas fa-sign-out-alt"></i><span> Me déconnecter </span></a>



</div>
<!--fin du menu vertical-->

<div class="content">

    <div class="ajouter_competence">

        <div class="afficher/masquer">
            <input type="checkbox" id="check3">
            Ajouter une nouvelle compétence
            <label for="check3">
                <i class="fas fa-bars" id="afficher_masquer_button"></i>
            </label>


            <div class="contenu_ajouter_competence">


                <!--formulaire pour ajouter une compétence-->


                <form method="post" action="database_update/insertion_competence.php">



                    <div class="form-group">

                        <label>Nom de votre compétence</label>
                        / Vous ne trouvez pas votre compétence ? Créez la <a href="database_update/insert_competence.php" target="_blank"> ici </a>

                        <select name="competence" class="form-control"  required>
                            <option value=""> Choisissez une compétence</option>

                            <?php

                                $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                $req_test=$bdd->prepare("SELECT competence from competence;");
                                $req_test->execute();
                                $data=$req_test->fetch();

                                while($data){
                                    echo" <option value=\"$data[0]\">$data[0]</option> ";
                                    $data=$req_test->fetch();
                                }
                            ?>
                        </select>

                    </div>

                    <div class="form-group">

                        <label>Sélectionnez votre niveau </label>

                        <select name="niveau_competence" class="form-control"  required>
                            <option value=""> Choisissez un niveau</option>

                            <?php
                            $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                            $req_test=$bdd->prepare("SELECT nom_niveau_competence from niveau_competence;");
                            $req_test->execute();
                            $data=$req_test->fetch();

                            while($data){
                                echo" <option value=\"$data[0]\">$data[0]</option> ";
                                $data=$req_test->fetch();
                            }
                            ?>
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Créer la compétence</button>
                </form>
            </div>
        </div>
    </div>


    <!--        generation automatique des compétences-->

    <?php

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT competence.competence,niveau_competence,secteur_competence  from jointure_competence_utilisateur INNER JOIN competence on competence.competence=jointure_competence_utilisateur.competence where email_utilisateur=?;");
    $req->execute([$_SESSION["email"]]);
    $data=$req->fetch();



    while($data)
    {

        $competence=$data[0];
        $niveau_competence=$data[1];
        $secteur_competence=$data[2];

        echo"
            <div class=\"competence\">
            <i class=\"fas fa-check\" id=\"floating_image\"></i>
            <div class=\"name\">
                <b>$competence</b>
            </div>
            <div class=\"type_competence\">
               $secteur_competence
            </div>
            
            <div class=\"niveau_competence\">
               $niveau_competence
            </div>
        </div>
           
            ";

        $data=$req->fetch();
    }
    ?>


    <!--   suppression des compétences ajoutées   -->

    <div class="competence">


        <input type="checkbox" id="check_delete">

        <label for="check_delete">Supprimer une compétence
            <i class="fas fa-trash" id="delete"></i>
        </label>

        <div id="delete_form">

            Renseignez les informations contenant la compétence à supprimmer:
            <form method="post" action="database_update/delete_competence.php">

                <div class="form-group">


                    <label> Nom de la compétence</label>



                    <select name="nom_competence" class="form-control"  required>
                        <option value=""> Choisissez une compétence </option>

                        <?php

                        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                        $req_test=$bdd->prepare("SELECT competence from competence;");
                        $req_test->execute();
                        $data=$req_test->fetch();

                        while($data){
                            echo" <option value=\"$data[0]\">$data[0]</option> ";
                            $data=$req_test->fetch();
                        }


                        ?>
                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Supprimer cette compétence </button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
