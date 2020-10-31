<?php
session_start();
?>


<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
        <link rel="stylesheet" href="feuilles_de_style/formation_cv.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <!--ce lien permet d'utiliser les icones du site font-awesome-->
        <title>My Online CV - Créez votre CV en toute simplicité / Formations </title>
    </head>


    <body>

    <!--debut menu vertical-->

        <input type="checkbox" id="check">
    <!--ce checkbox permet de gèrer le décalage de la sidebar si il est coché-->


        <header>
            <label for="check">
                <i class="fas fa-bars" id="sidebar_button"></i>
            </label>

            <div class="left_area">
                <h1> Créer mon CV </h1>
            </div>
        </header>

    <!--début du menu vertical-->
        <div class="side_bar">
            <center>
                <!--on affiche la photo de profil et le prenom de l'utilisateur dans la sidebar-->
                <?php
                    if(isset($_SESSION["prenom"]))
                    {echo '<img class="profile_photo" src="data:image/png;base64,'.base64_encode( $_SESSION['photo_profil'] ).'"/>';}
                ?>
                <h2>
                    <?php
                        if(isset($_SESSION["prenom"])) {echo $_SESSION["prenom"];}
                    ?>
                </h2>
            </center>

            <!--liens vers les autres pages présentes dans la sidebar-->

            <a href="#"><i class="fas fa-graduation-cap"></i><span>Formations</span></a>

            <a href="experience_pro.php"><i class="fas fa-briefcase"></i><span>Expériences professionnelles</span></a>

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
        <!--contenu de la page à côté-->

            <div class="ajouter_formation">

                <div class="afficher/masquer">

                    <input type="checkbox" id="check3">
                    <label for="check3">
                        Créer une nouvelle formation
                        <i class="fas fa-bars" id="afficher_masquer_button"></i>
                    </label>
                    <!--ce checkbox pemet de gèrer l'affichage du formulaire si il est coché-->


                    <div class="contenu_ajouter_formation">


                            <!-- debut recherche approfondie des écoles-->
                                <input type="checkbox" id="check2">
                        <!--ce checkbox pemet de gèrer l'affichage de la recherche approfondie si il est coché-->
                                <label for="check2">Recherche approfondie
                                    <i class="fas fa-bars" id="search_button"></i>
                                </label>

                                <div id="content_search">
                                    <form method="get" action="formations_cv.php">
                                    <!--le formulaire renverra les variables choisies dans l'url de la page-->

                                        <div class="form-row" >
                                            <div class="form-group col-md-6">
                                                <label>Rechercher une école par ville</label>
                                                <input type="text" class="form-control" name="ville" placeholder="ex: Belfort">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Appliquer les critères</button>
                                        <!--on renvoie la ville choisie dans l'url dans une variable "ville"-->
                                    </form>
                                </div>
                            <!-- fin recherche approfondie des écoles-->

                        <!--formulaire ajout formation dans le cv-->
                        <form method="post" action="database_update/insertion_formation.php">
                        <!--on récupère les variables nécessaires à l'insertion d'une nouvelle formation dans la base de données-->

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Date de début de formation</label>
                                    <input type="date" class="form-control" name="date_de_debut" value="<?php echo $today = date("Y-m-d")?>" max= "<?php echo $today = date("Y-m-d")?>"  required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date de fin de formation</label>
                                    <input type="date" class="form-control" name="date_de_fin" value="<?php echo $today = date("Y-m-d")?>" />
                                </div>
                             </div>

                            <div class="form-group">
                                <label>Intitulé du diplôme </label>
                                <input type="text" class="form-control" name="intitule_diplome" placeholder="ex: Diplôme d'ingénieur en informatique" required>
                            </div>


                            <div class="form-group">
                                <label>Description de la formation</label>
                                <TEXTAREA class="form-control" name="description_formation" maxlength="200"></TEXTAREA>
                            </div>

                            <div class="form-group">
                                <label>Nom de l'école</label>
                                 / Vous ne trouvez pas votre école ? Créez la <a href="database_update/insert_ecole.php" target="_blank"> ici </a>

                                <select name="id_ecole" class="form-control"  required>
                                    <option value=""> Choisissez une école </option>

                                    <?php
                                    //ce code permet d'afficher toutes les écoles présentes dans la base de données dans les option du select
                                        if (isset($_GET["ville"])) {
                                            //si l'utilisateur a effectué une recherche approfondie on récupère uniquement les écoles présentes dans la ville choisie
                                            $ville = strtoupper($_GET["ville"]);
                                            $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                            $req_test = $bdd->prepare("SELECT nom_ecole from ecole where ville_ecole=?;");
                                            $req_test->execute([$ville]);
                                            $data = $req_test->fetch();


                                            while ($data) {
                                                echo " <option value=\"$data[0]\">$data[0]</option> ";
                                                $data = $req_test->fetch();
                                            }

                                            //on affiche les options à l'aide d'une boucle while qui s'arrete quand on  est arrivé à la dernière école trouvée dans la base de données
                                        }
                                        else{
                                            //meme principe mais plus de conditions sur la ville de l'école -> on affiche toutes les écoles présentes dans la base de données
                                            $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                            $req_test=$bdd->prepare("SELECT nom_ecole from ecole;");
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
                                <label>Type de diplôme obtenu / Vous ne trouvez pas votre école ? Créez la <a href="database_update/insert_type_diplome.php" target="_blank"> ici </a></label>

                                <select name="type_diplome" class="form-control"  required>
                                    <option value=""> Choisissez un type de diplôme </option>


                                    <?php
                                    //meme principe que pour l'affichage des écoles
                                        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                        $req_test=$bdd->prepare("SELECT nom_type_diplome from type_diplome;");
                                        $req_test->execute();
                                        $data=$req_test->fetch();

                                        while($data){
                                            echo" <option value=\"$data[0]\">$data[0]</option> ";
                                            $data=$req_test->fetch();}
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Créer la formation</button>
                        </form>
                    </div>
                </div>
            </div>



            <!--trier les resultats-->

                <div class="sort_by">
                    <input type="checkbox" id="check_sort">
                    <label for="check_sort">
                        <i class="fas fa-filter" id="afficher_masquer_sort_button"></i>
                        Trier les résultats par :
                    </label>


                    <div id="content_tri">
                        <form method="get" action="formations_cv.php" id="form_tri">
                                <div class="form-group">
                                    <select name="sorting_options" class="form-control" required>
                                        <option value=""> Choississez une option </option>
                                        <option value="croissant"> Du plus ancien au plus récent </option>
                                        <option value="decroissant"> Du plus récent au plus vieux </option>
                                        <option value="alphabetique"> Ordre Alphabétique </option>
                                    </select>
                                </div>
                            <button type="submit" class="btn btn-primary">Appliquer les critères</button>
                        </form>
                    </div>
                </div>
            <!--fin tri resultats-->

                <!-- génération automatique des formations rentrées auparavant par l'utilisateur dans la base de données-->

                <?php
                $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");

                    if (isset($_GET["sorting_options"]))
                    {
                        switch ($_GET["sorting_options"]){
                            case "croissant":
                                $req=$bdd->prepare("SELECT intitule_diplome,description_formation,date_de_debut,date_de_fin,nom_type_diplome,nom_ecole from formation INNER JOIN ecole on ecole.id_ecole=formation.id_ecole INNER JOIN type_diplome on type_diplome.id_type_diplome=formation.type_diplome where email_utilisateur=? ORDER BY date_de_debut;");
                                break;
                            case "decroissant":
                                $req=$bdd->prepare("SELECT intitule_diplome,description_formation,date_de_debut,date_de_fin,nom_type_diplome,nom_ecole from formation INNER JOIN ecole on ecole.id_ecole=formation.id_ecole INNER JOIN type_diplome on type_diplome.id_type_diplome=formation.type_diplome where email_utilisateur=? ORDER BY date_de_debut DESC;");
                                break;
                            case "alphabetique":
                                $req=$bdd->prepare("SELECT intitule_diplome,description_formation,date_de_debut,date_de_fin,nom_type_diplome,nom_ecole from formation INNER JOIN ecole on ecole.id_ecole=formation.id_ecole INNER JOIN type_diplome on type_diplome.id_type_diplome=formation.type_diplome where email_utilisateur=? ORDER BY nom_ecole;");
                                break;

                        }
                    }
                    else
                    {
                        $req=$bdd->prepare("SELECT intitule_diplome,description_formation,date_de_debut,date_de_fin,nom_type_diplome,nom_ecole from formation INNER JOIN ecole on ecole.id_ecole=formation.id_ecole INNER JOIN type_diplome on type_diplome.id_type_diplome=formation.type_diplome where email_utilisateur=? ORDER BY date_de_debut DESC;");
                    }


                    $req->execute([$_SESSION["email"]]);
                    $data=$req->fetch();

                    while($data)
                    {
                        $intitule_diplome=$data[0];
                        $description_formation=$data[1];
                        $date_de_debut=$data[2];
                        $date_de_fin=$data[3];
                        $nom_type_diplome=$data[4];
                        $nom_ecole=$data[5];

                        $date = new DateTime($date_de_debut);
                        $date_de_debut=$date->format('M Y');
                        $date = new DateTime($date_de_fin);
                        $date_de_fin=$date->format('M Y');


                        echo"
                        <div class=\"formation\">
                            <img class='floating_image' src=\"../images/pngtree-graduated-students-png-image_2872038.jpg\">
                            <div class=\"name\">
                                <b>$nom_ecole</b>
                            </div>
                            <div class=\"type_diplome\">
                                $nom_type_diplome/$intitule_diplome
                            </div>
                            <div class=\"date_debut_fin\">
                                $date_de_debut-$date_de_fin
                            </div>
                            <div class=\"description\">
                               $description_formation
                            </div>
                        </div>";

                        $data=$req->fetch();
                    }
                ?>


        <!--suppression des formations ajoutées-->
            <div class="formation">
                <input type="checkbox" id="check_delete">

                <label for="check_delete">Supprimer une formation
                        <i class="fas fa-trash" id="delete"></i>
                    </label>

                <div id="delete_form">
                    Renseignez les informations contenant la formation à supprimer
                    <!--les informations dont on a besoin pour cibler précisément la formation sont : l'intitulé du diplome,le nom de l'école,le type de diplome obtenu-->

                    <form method="post" action="database_update/delete_formation.php">
                        <div class="form-group">
                            <label>Intitulé du diplôme </label>
                            <input type="text" class="form-control" name="intitule_diplome" placeholder="ex: Diplôme d'ingénieur en informatique" required>
                        </div>

                        <div class="form-group">
                            <label> Nom de l'école </label>

                            <select name="id_ecole" class="form-control"  required>
                                <option value=""> Choisissez une école </option>
                                <?php
                                        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                        $req_test=$bdd->prepare("SELECT nom_ecole from ecole;");
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
                            <label>Type de diplôme obtenu</label>

                            <select name="type_diplome" class="form-control"  required>
                                <option value=""> Choisissez un type de diplôme </option>
                                <?php
                                    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                                    $req_test=$bdd->prepare("SELECT nom_type_diplome from type_diplome;");
                                    $req_test->execute();
                                    $data=$req_test->fetch();

                                    while($data){
                                        echo" <option value=\"$data[0]\">$data[0]</option> ";
                                        $data=$req_test->fetch();
                                    }
                                 ?>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Supprimer cette formation</button>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
