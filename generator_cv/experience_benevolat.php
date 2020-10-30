
<?php
session_start();
?>


<!doctype html>
<html lang="fr">




<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="feuilles_de_style/experience_benevolat.css">
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

    <a href="#"><i class="fas fa-hands-helping"></i><span>Expériences de bénévolat</span></a>

    <a href="competences.php"><i class="fas fa-check"></i><span>Compétences</span></a>

    <a href="langues.php"><i class="fas fa-language"></i><span>Langues</span></a>

    <a href="#"><i class="fas fa-heart"></i><span>Passions</span></a>

    <a href="#"><i class="fas fa-download"></i><span> Générer le CV</span></a>

    <a href="../connexion_inscription/log_out.php" target="_blank"><i class="fas fa-sign-out-alt"></i><span> Me déconnecter </span></a>





</div>
<!--fin du menu vertical-->

<div class="content">

    <div class="ajouter_experience_benevolat">

        <div class="afficher/masquer">
            <input type="checkbox" id="check3">
            Créer une nouvelle expérience de bénévolat
            <label for="check3">
                <i class="fas fa-bars" id="afficher_masquer_button"></i>
            </label>


            <div class="contenu_ajouter_experience_benevolat">

                <!--formulaire pour ajouter une experience_benevolat-->


                <form method="post" action="database_update/insertion_experience_benevolat.php">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Date de début</label>
                            <input type="date" class="form-control" name="date_debut" value="<?php echo $today = date("Y-m-d")?>" max= "<?php echo $today = date("Y-m-d")?>"  required />
                        </div>

                        <div class="form-group col-md-6">
                            <label>Date de fin </label>
                            <input type="date" class="form-control" name="date_fin" value="<?php echo $today = date("Y-m-d")?>" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Description de l'expérience</label>
                        <TEXTAREA class="form-control" name="description_experience" maxlength="200"></TEXTAREA>
                    </div>

                    <div class="form-group">
                        <label>Titre de l'expérience</label>
                        <input type="text" class="form-control" name="titre_experience"  placeholder="ex: Voyage Humanitaire" required>

                    </div>

                    <div class="form-group">
                        <label>Nom de l'organisme</label>
                        <input type="text" class="form-control" name="nom_organisme"  placeholder="ex: Les Restos du Coeur" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Créer l'expérience de bénévolat </button>
                </form>
            </div>
        </div>
    </div>


    <!--        generation automatique des expériences de bénévolat déja inscrites-->

    <?php

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT titre_experience,description,date_debut,date_fin,nom_organisme from experience_benevolat where email_utilisateur=? ORDER BY date_debut DESC;");
    $req->execute([$_SESSION["email"]]);
    $data=$req->fetch();



    while($data)
    {

        $titre_experience=$data[0];
        $description=$data[1];
        $date_debut=$data[2];
        $date_fin=$data[3];
        $nom_organisme=$data[4];


        $date = new DateTime($date_debut);
        $date_debut=$date->format('M Y');
        $date = new DateTime($date_fin);
        $date_fin=$date->format('M Y');

        echo"
            <div class=\"experience_benevolat\">
            <i class=\"fas fa-hands-helping\" class='floating_image'></i>
            <div class=\"name\">
                <b>$nom_organisme</b>
            </div>
            <div class=\"titre_experience\">
                $titre_experience
            </div>
            <div class=\"date_debut_fin\">
                $date_debut-$date_fin
            </div>
            <div class=\"description\">
               $description
            </div>
        </div>
           
            ";

        $data=$req->fetch();
    }
    ?>


    <!--        suppression des experiences_de_benevolat ajoutées  -->

    <div class="experience_benevolat">


        <input type="checkbox" id="check_delete">

        <label for="check_delete">Supprimer une expérience de bénévolat
            <i class="fas fa-trash" id="delete"></i>
        </label>

        <div id="delete_form">

            Renseignez les informations contenant l'expérience à supprimer:
            <form method="post" action="database_update/delete_experience_benevolat.php">

                <div class="form-group">

                    <label>Titre de l'expérience</label>
                    <input type="text" class="form-control" name="titre_experience" placeholder="ex: Voyage Humanitaire" required>

                </div>


                <div class="form-group">


                    <label> Nom de l'organisme</label>

                    <input type="text" class="form-control" name="nom_organisme" placeholder="Les Restos du Coeur" required>

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
