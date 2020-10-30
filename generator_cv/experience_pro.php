
<?php
session_start();
?>


<!doctype html>
<html lang="fr">




<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="feuilles_de_style/experience_pro.css">
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

                <a href="qualification.php"><i class="fas fa-book"></i><span>Qualifications</span></a>

                <a href="langues.php"><i class="fas fa-language"></i><span>Langues</span></a>

                <a href="passions.php"><i class="fas fa-heart"></i><span>Passions</span></a>

                 <a href="#"><i class="fas fa-download"></i><span> Générer le CV</span></a>

            <a href="../connexion_inscription/log_out.php" target="_blank"><i class="fas fa-sign-out-alt"></i><span> Me déconnecter </span></a>





    </div>
<!--fin du menu vertical-->

    <div class="content">

    <div class="ajouter_experience_pro">

        <div class="afficher/masquer">
            <input type="checkbox" id="check3">
            Créer une nouvelle expérience professionnelle
            <label for="check3">
                <i class="fas fa-bars" id="afficher_masquer_button"></i>
            </label>


        <div class="contenu_ajouter_experience_pro">

        <!-- debut recherche approfondie des écoles-->

        <input type="checkbox" id="check2">

        <label for="check2">Recherche approfondie
            <i class="fas fa-bars" id="search_button"></i>
        </label>


        <div id="content_search">

            <form method="get" action="experience_pro.php">

                <div class="form-row" >

                    <div class="form-group col-md-6">
                        <label>Rechercher une entreprise par ville </label>
                        <input type="text" class="form-control" name="ville" placeholder="ex: Belfort" required>

                    <label>Rechercher une entreprise par secteur d'activité</label>

                    <select name="secteur_activite" class="form-control" required>
                        <option value=""> Choisissez un secteur d'activité </option>

                        <?php
                            $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                            $req = $bdd->prepare("SELECT nom_secteur_activite from secteur_activite;");
                            $req->execute();
                            $data=$req->fetch();

                            while($data){
                                while ($data) {
                                    echo " <option value=\"$data[0]\">$data[0]</option> ";
                                    $data = $req->fetch();
                                }
                            }
                        ?>
                    </select>
                    </div>

                </div>


                <button type="submit" class="btn btn-primary">Appliquer les critères</button>

            </form>



        </div>

            <!-- fin recherche approfondie des écoles-->


        <!--formulaire pour ajouter une experience_pro-->


        <form method="post" action="database_update/insertion_experience_pro.php">
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

                <label>Description du travail</label>
                <TEXTAREA class="form-control" name="description_experience" maxlength="200"></TEXTAREA>

            </div>

            <div class="form-group">

                <label>Poste occupé</label>
                <input type="text" class="form-control" name="poste_occupe"  placeholder="ex: Manager" required>

            </div>

            <div class="form-group">

                <label>Nom de l'entreprise</label>
                 / Vous ne trouvez pas votre entreprise ? Créez la <a href="database_update/insert_entreprise.php" target="_blank"> ici </a>

                <select name="nom_entreprise" class="form-control"  required>
                    <option value=""> Choisissez une entreprise </option>

                    <?php

                    if (isset($_GET["ville"],$_GET["secteur_activite"])) {
                        $ville = strtoupper($_GET["ville"]);
                        $secteur_activite=$_GET["secteur_activite"];
                        $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                        $req_test = $bdd->prepare("SELECT nom_entreprise from entreprise where ville_entreprise=? AND secteur_activite=?;");
                        $req_test->execute([$ville,$secteur_activite]);
                        $data = $req_test->fetch();
                        while ($data) {
                            echo " <option value=\"$data[0]\">$data[0]</option> ";
                            $data = $req_test->fetch();
                        }
                    }
                    else {
                        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                        $req_test=$bdd->prepare("SELECT nom_entreprise from entreprise;");
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

            <div class="form-group">

                <label>Sélectionnez votre type de contrat</label>

                <select name="type_contrat" class="form-control"  required>
                    <option value=""> Choisissez un type de contrat</option>

                    <?php
                    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                    $req_test=$bdd->prepare("SELECT nom_type_contrat from type_contrat_travail;");
                    $req_test->execute();
                    $data=$req_test->fetch();

                    while($data){
                        echo" <option value=\"$data[0]\">$data[0]</option> ";
                        $data=$req_test->fetch();
                    }
                    ?>
                </select>

            </div>

            <button type="submit" class="btn btn-primary">Créer l'expérience professionelle </button>
        </form>
        </div>
        </div>
    </div>


<!--        generation automatique des expériences déja inscrites-->

        <?php

        $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
        $req=$bdd->prepare("SELECT poste_occupe,experiences_professionnelles.description,date_debut,date_fin,type_contrat,nom_entreprise from experiences_professionnelles INNER JOIN type_contrat_travail on experiences_professionnelles.type_contrat=type_contrat_travail.nom_type_contrat INNER JOIN entreprise on entreprise.id_entreprise=experiences_professionnelles.id_entreprise where email_utilisateur=? ORDER BY date_debut DESC
");
        $req->execute([$_SESSION["email"]]);
        $data=$req->fetch();



        while($data)
        {

            $poste_occupe=$data[0];
            $description=$data[1];
            $date_debut=$data[2];
            $date_fin=$data[3];
            $type_contrat=$data[4];
            $nom_entreprise=$data[5];


            $date = new DateTime($date_debut);
            $date_debut=$date->format('M Y');
            $date = new DateTime($date_fin);
            $date_fin=$date->format('M Y');

            echo"
            <div class=\"experience_pro\">
            <i class=\"fas fa-briefcase\" id='floating_image'></i>
            <div class=\"name\">
                <b>$nom_entreprise</b>
            </div>
            <div class=\"type_contrat\">
                $poste_occupe/$type_contrat
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


<!--        suppression des expériences_pro ajoutées    -->

        <div class="experience_pro">


            <input type="checkbox" id="check_delete">

            <label for="check_delete">Supprimer une expérience professionelle
                <i class="fas fa-trash" id="delete"></i>
            </label>

            <div id="delete_form">

                Renseignez les informations contenant l'expérience à supprimer:
                <form method="post" action="database_update/delete_experience_pro.php">

                    <div class="form-group">

                        <label>Poste occupé</label>
                        <input type="text" class="form-control" name="poste_occupe" placeholder="ex: Manager" required>

                    </div>


                    <div class="form-group">


                        <label> Nom de l'entreprise</label>



                        <select name="nom_entreprise" class="form-control"  required>
                            <option value=""> Choisissez une entreprise </option>

                            <?php


                                $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                $req_test=$bdd->prepare("SELECT nom_entreprise from entreprise;");
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

                        <label>Type de contrat</label>

                        <select name="type_contrat" class="form-control"  required>
                            <option value=""> Choisissez un type de contrat</option>

                            <?php
                            $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                            $req_test=$bdd->prepare("SELECT nom_type_contrat from type_contrat_travail;");
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
