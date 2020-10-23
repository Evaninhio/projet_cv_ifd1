<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- Le job de vos rêves est à portée de main ! </title>
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
</head>


<body>




<form method="post" action="formulaire_insert.php">

    <!--formulaire inscription nouvel utilisateur-->

        <label>
            Nom : <input type="text" name="nom" required/>
        </label>
    <br>
        <label>
            Prénom : <input type="text" name="prenom" required/>
        </label>
    <br>
         <label>
            Email : <input type="email" name="email" required/>

         </label>
    <br>
         <label>
            Adresse : <input type="text" name="adresse_actuelle" required />
        </label>
    <br>
        <label>
            Ville de residence : <input type="text" name="ville_de_residence" required />
        </label>
    <br>
        <label>
            Date de naissance: <input type="date" name="date_naissance" value="<?php echo $today = date("Y-m-d")?>" max= "<?php echo $today = date("Y-m-d")?>"  required />
        </label>
    <br>
        <label>
            Mot de passe: <input type="password" name="password" min="8" required>
        </label>
    <br>
        <label>
            Lien linkedin: <input type="text" name="lien_linkedin">
        </label>
    <br>
        <label>
            Biographie: <TEXTAREA name="biographie" maxlength="200"></TEXTAREA>
        </label>
    <br>
        <label>
            Numéro de Téléphone: <input type="number"  name="num_telephone" pattern="[0-9]{10}">
        </label>
    <br>
        <label>
            Photo de profil: <input type="file" name="photo_profil" accept="image/jpeg, image/png">
         </label>

    <input type="submit" value=" Créer un compte! "/>
</form>

</body>

</html


