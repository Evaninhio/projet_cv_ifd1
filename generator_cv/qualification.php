
<?php
session_start();
?>


<!doctype html>
<html lang="fr">




<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="feuilles_de_style/qualification.css">
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

    <a href="#"><i class="fas fa-briefcase"></i><span>Expériences professionnelles</span></a>

    <a href="experience_benevolat.php"><i class="fas fa-hands-helping"></i><span>Expériences de bénévolat</span></a>

    <a href="competences.php"><i class="fas fa-check"></i><span>Compétences</span></a>

    <a href="#"><i class="fas fa-book"></i><span>Qualifications</span></a>

    <a href="langues.php"><i class="fas fa-language"></i><span>Langues</span></a>

    <a href="passions.php"><i class="fas fa-heart"></i><span>Passions</span></a>

    <a href="#"><i class="fas fa-download"></i><span> Générer le CV</span></a>

    <a href="../connexion_inscription/log_out.php" target="_blank"><i class="fas fa-sign-out-alt"></i><span> Me déconnecter </span></a>





</div>
<!--fin du menu vertical-->

<div class="content">

    <div class="ajouter_qualification">

        <div class="afficher/masquer">
            <input type="checkbox" id="check3">
            Créer une nouvelle qualification
            <label for="check3">
                <i class="fas fa-bars" id="afficher_masquer_button"></i>
            </label>


            <div class="contenu_ajouter_qualification">

                <!-- debut recherche approfondie des écoles-->

                <input type="checkbox" id="check2">

                <label for="check2">Recherche approfondie
                    <i class="fas fa-bars" id="search_button"></i>
                </label>


                <div id="content_search">

                    <form method="get" action="qualification.php">

                        <div class="form-row" >

                            <div class="form-group col-md-6">
                                <label>Rechercher une qualification par l'organisme de délivrance </label>
                                <input type="text" class="form-control" name="organisme_delivrance" placeholder="ex: PROTECTION CIVILE" required>

                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary">Appliquer les critères</button>

                    </form>



                </div>

                <form method="post" action="database_update/insertion_qualification.php">
                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label>Date d'obtention</label>
                            <input type="date" class="form-control" name="date_obtention" value="<?php echo $today = date("Y-m-d")?>" max= "<?php echo $today = date("Y-m-d")?>"  required />

                        </div>

                        <div class="form-group col-md-6">

                            <label>Date d'expiration </label>
                            <input type="date" class="form-control" name="date_expiration" value="<?php echo $today = date("Y-m-d")?>" min="<?php echo $today = date("Y-m-d")?>"/>

                        </div>

                    </div>



                    <div class="form-group">

                        <label>Nom de la qualification</label>
                        / Vous ne trouvez pas votre qualification ? Créez la <a href="database_update/insert_qualification.php" target="_blank"> ici </a>

                        <select name="nom_qualification" class="form-control"  required>
                            <option value=""> Choisissez une qualification </option>

                            <?php


                                if (isset($_GET["organisme_delivrance"])){
                                    $organisme_delivrance=strtoupper($_GET["organisme_delivrance"]);


                                    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                    $req_test=$bdd->prepare("SELECT nom_qualification from qualification where organisme_delivrance=?;");
                                    $req_test->execute([$organisme_delivrance]);
                                    $data=$req_test->fetch();

                                    while($data){
                                        echo" <option value=\"$data[0]\">$data[0]</option> ";
                                        $data=$req_test->fetch();
                                    }

                                }
                                else{

                                    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                    $req_test=$bdd->prepare("SELECT nom_qualification from qualification;");
                                    $req_test->execute();
                                    $data=$req_test->fetch();

                                    while($data){
                                        echo" <option value=\"$data[0]\">$data[0]</option> ";
                                        $data=$req_test->fetch();
                                    }

                                }

                            ?>
                        </select>

                    </div>


                    <button type="submit" class="btn btn-primary"> Créer la qualification </button>
                </form>
            </div>
        </div>
    </div>


    <!--        generation automatique des qualifications déja inscrites-->

    <?php

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT date_obtention,date_expiration,nom_qualification,organisme_delivrance from jointure_utilisateur_qualifications  INNER JOIN qualification on qualification.id_qualification=jointure_utilisateur_qualifications.id_qualification  where email_utilisateur=? ORDER BY date_obtention DESC
");
    $req->execute([$_SESSION["email"]]);
    $data=$req->fetch();



    while($data)
    {

        $date_obtention=$data[0];
        $date_expiration=$data[1];
        $nom_qualification=$data[2];
        $organisme_delivrance=$data[3];



        $date = new DateTime($date_obtention);
        $date_obtention=$date->format('d M Y');

        if($date_expiration!=NULL){
            $date = new DateTime($date_expiration);
            $date_expiration=$date->format('d M Y');
        }
        else{
            $date_expiration="Pas de date d'expiration";
        }

        echo"
            <div class=\"qualification\">
            <i class=\"fas fa-book\" id='floating_image'></i>
            <div class=\"name\">
                <b>$nom_qualification</b>
            </div>
            
            <div class=\"date_debut_fin\">
                Date d'obtention: $date_obtention / Date d'expiration : $date_expiration
            </div>
            <div class=\"description\">
               Délivré par : $organisme_delivrance
            </div>
        </div>
           
            ";

        $data=$req->fetch();
    }
    ?>


    <!--        suppression des qualifications ajoutées    -->

    <div class="qualification">


        <input type="checkbox" id="check_delete">

        <label for="check_delete">Supprimer une qualification
            <i class="fas fa-trash" id="delete"></i>
        </label>

        <div id="delete_form">

            Renseignez les informations contenant la qualification à supprimer:
            <form method="post" action="database_update/delete_qualification.php">

                <div class="form-group">

                    <label>Nom de la qualification</label>

                    <select name="nom_qualification" class="form-control"  required>
                        <option value=""> Choisissez une qualification </option>

                        <?php

                        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                        $req_test=$bdd->prepare("SELECT nom_qualification from qualification;");
                        $req_test->execute();
                        $data=$req_test->fetch();

                        while($data){
                            echo" <option value=\"$data[0]\">$data[0]</option> ";
                            $data=$req_test->fetch();
                        }


                        ?>
                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Supprimer cette expérience </button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>

