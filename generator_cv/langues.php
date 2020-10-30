
<?php
session_start();
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="feuilles_de_style/langues.css">
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

    <a href="competences.php"><i class="fas fa-check"></i><span>Compétences</span></a>

    <a href="#"><i class="fas fa-book"></i><span>Qualifications</span></a>


    <a href="#"><i class="fas fa-language"></i><span>Langues</span></a>

    <a href="passions.php"><i class="fas fa-heart"></i><span>Passions</span></a>

    <a href="#"><i class="fas fa-download"></i><span> Générer le CV</span></a>

    <a href="../connexion_inscription/log_out.php" target="_blank"><i class="fas fa-sign-out-alt"></i><span> Me déconnecter </span></a>



</div>
<!--fin du menu vertical-->

<div class="content">

    <div class="ajouter_langue">

        <div class="afficher/masquer">
            <input type="checkbox" id="check3">
            Ajouter une nouvelle langue
            <label for="check3">
                <i class="fas fa-bars" id="afficher_masquer_button"></i>
            </label>


            <div class="contenu_ajouter_langue">


                <!--formulaire pour ajouter une langue-->


                <form method="post" action="database_update/insertion_langue.php">



                    <div class="form-group">

                        <label>Nom de la langue</label>
                        / Vous ne trouvez pas la langue souhaitée ? Créez la <a href="database_update/insert_langue.php" target="_blank"> ici </a>

                        <select name="nom_langue" class="form-control"  required>
                            <option value=""> Choisissez une langue</option>

                            <?php

                            $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                            $req_test=$bdd->prepare("SELECT nom_langue from langue;");
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

                        <select name="niveau_langue" class="form-control"  required>
                            <option value=""> Choisissez un niveau</option>

                            <?php
                            $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                            $req_test=$bdd->prepare("SELECT niveau_langue from niveau_langue_etrangere;");
                            $req_test->execute();
                            $data=$req_test->fetch();

                            while($data){
                                echo" <option value=\"$data[0]\">$data[0]</option> ";
                                $data=$req_test->fetch();
                            }
                            ?>
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Je maitrise cette langue !</button>
                </form>
            </div>
        </div>
    </div>


    <!--        generation automatique des langues déja maitrisées-->

    <?php

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT nom_langue,niveau_langue from jointure_langue_utilisateur  where email_utilisateur=?;");
    $req->execute([$_SESSION["email"]]);
    $data=$req->fetch();



    while($data)
    {

        $nom_langue=$data[0];
        $niveau_langue=$data[1];

        echo"
            <div class=\"langue\">
            <i class=\"fas fa-language\" id=\"floating_image\"></i>
            <div class=\"name\">
                <b>$nom_langue</b>
            </div>
            
            
            <div class=\"niveau_langue\">
               $niveau_langue
            </div>
        </div>
           
            ";

        $data=$req->fetch();
    }
    ?>


    <!--   suppression des langues ajoutées   -->

    <div class="langue">


        <input type="checkbox" id="check_delete">

        <label for="check_delete">Supprimer une langue
            <i class="fas fa-trash" id="delete"></i>
        </label>

        <div id="delete_form">

            Renseignez les informations contenant la langue à supprimer:
            <form method="post" action="database_update/delete_langue.php">

                <div class="form-group">


                    <label> Nom de la compétence</label>



                    <select name="nom_langue" class="form-control"  required>
                        <option value=""> Choisissez une langue </option>

                        <?php

                        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                        $req_test=$bdd->prepare("SELECT nom_langue from langue;");
                        $req_test->execute();
                        $data=$req_test->fetch();

                        while($data){
                            echo" <option value=\"$data[0]\">$data[0]</option> ";
                            $data=$req_test->fetch();
                        }


                        ?>
                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Supprimer cette langue </button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
