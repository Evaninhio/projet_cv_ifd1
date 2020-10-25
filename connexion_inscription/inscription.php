<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- Le job de vos rêves est à portée de main ! </title>
    <link rel="stylesheet" href="inscription_css.css">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    </head>


<body class="text_center">

<slider>
    <slide></slide>
    <slide></slide>
    <slide></slide>
    <slide></slide>
</slider>



<form class="form-signin" method="post" action="formulaire_insert.php">


    <h1 class="mb-3" id="title">Inscrivez vous dès aujourd'hui</h1>

    <!--formulaire inscription nouvel utilisateur-->
    <ul>
        <li>
            <label>
                Prénom : <input type="text" name="prenom" required/>
            </label>
            <br>
        </li>

        <li>
            <label>
                Email : <input type="email" name="email" required placeholder="xxxxxxx@xxxxx.com"/>
            </label>
            <br>
        </li>

        <li>
            <label>
                Adresse : <input type="text" name="adresse_actuelle" required  />
            </label>
            <br>
        </li>

        <li>
            <label>
                Ville de residence : <input type="text" name="ville_de_residence" required />
            </label>
            <br>
        </li>

        <li>
            <label>
                Date de naissance: <input type="date" name="date_naissance" value="<?php echo $today = date("Y-m-d")?>" max= "<?php echo $today = date("Y-m-d")?>"  required />
            </label>
            <br>
        </li>

        <li>
            <label>
                Mot de passe: <input type="password" name="password" min="8" required>
            </label>
            <br>
        </li>
            <label>
                Lien linkedin: <input type="text" name="lien_linkedin">
            </label>
            <br>
        <li/>


        <li>
            <label>
                Biographie: <TEXTAREA name="biographie" maxlength="200"></TEXTAREA>
            </label>
            <br>
        </li>

        <li>
            <label>
                Numéro de Téléphone: <input type="number"  name="num_telephone" pattern="[0-9]{10}">
            </label>
            <br>
        </li>

        <li>
            <label>
                Photo de profil: <input type="file" name="photo_profil" accept="image/jpeg, image/png">
            </label>
        </li>
    </ul>

    <input type="submit" id="button_creation" value=" Créer un compte! "/>
</form>


</body>

</html


