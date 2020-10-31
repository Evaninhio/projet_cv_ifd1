<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>My Online CV- INSCRIPTION </title>
        <link rel="stylesheet" href="feuilles_de_style/inscription_css.css">
        <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
        </head>


    <body class="text_center">

    <slider>
        <!--slider de modèles de cv-->
        <slide></slide>
        <slide></slide>
        <slide></slide>
        <slide></slide>
    </slider>



    <form class="form-signin" method="post" action="gestion_formulaire/formulaire_insert.php">
        <!--formulaire d'inscription -->


        <h1 class="mb-3" id="title">Inscrivez vous dès aujourd'hui</h1>

        <div class="error">
            <!--si l'adresse mail est déja présente dans la base de données on renvoie error dans l'url-->
            <!--on teste si error est set dans l'url avec la méthode get-->
            <!--si c'est le cas on affiche un message d'erreur-->
            <?php
                if (isset($_GET['error'])){ echo "<p>Adresse email déja utilisée</p>";}
            ?>
        </div>


        <ul>
            <li>
                    Nom : <input type="text" name="nom" required/>
            </li>

            <li>
                    Prénom : <input type="text" name="prenom" required/>
            </li>

            <li>
                    Email : <input type="email" name="email" required placeholder="xxxxxxx@xxxxx.com"/>
                    <!--placeholder permet d'afficher un exemple-->
            </li>

            <li>
                    Adresse : <input type="text" name="adresse_actuelle" required  />
            </li>

            <li>
                    Ville de residence : <input type="text" name="ville_de_residence" required />
            </li>

            <li>
                    Date de naissance: <input type="date" name="date_naissance" value="<?php echo $today = date("Y-m-d")?>" max= "<?php echo $today = date("Y-m-d")?>"  required />
                    <!--on affiche par défaut la date du jour et on bloque la date de naissance minimum à la date du jour-->
            </li>

            <li>
                    Mot de passe: <input type="password" name="password" min="8" required>
            </li>

            <li>
                    Lien linkedin: <input type="text" name="lien_linkedin">
            </li>


            <li>
                    Biographie: <TEXTAREA name="biographie" maxlength="200"></TEXTAREA>
            </li>

            <li>
                    Numéro de Téléphone: <input type="number"  name="num_telephone" pattern="[0-9]{10}">
                    <!--l'attribut pattern permet de vérifier si lle num de téléphone contient bien 10 chiffres allant de 0 à 9-->
            </li>

            <li>
                    Photo de profil: <input type="file" name="photo_profil" accept="image/png" required>
            </li>
        </ul>

        <input type="submit" id="button_creation" value=" Créer un compte! "/>
    </form>


    </body>

</html


