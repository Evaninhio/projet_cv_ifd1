<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- Le job de vos rêves est à portée de main ! </title>
</head>


<br>

<form method="post" action="formulaire.php">
        <label>
            Nom : <input type="text" name="nom" required="Champ obligatoire"/>
        </label>
    </br>
        <label>
            Prénom : <input type="text" name="prenom" required="Champ obligatoire"/>
        </label>
    </br>
         <label>
            Email : <input type="text" name="email" required="Champ obligatoire"/>
        </label>
    </br>
         <label>
            Adresse : <input type="text" name="adresse_actuelle" required="Champ obligatoire" />
        </label>
    </br>
        <label>
            Ville de residence : <input type="text" name="ville_de_residence" required="Champ obligatoire" />
        </label>
   </br>
        <label>
            Date de naissance: <input type="date" name="date_naissance" value="date"  min="2018-01-01" max="2018-12-31">
        </label>
    </br>
        <label>
            Mot de passe: <input type="password" name="password" required="Champ obligatoire">
        </label>
    </br>
        <label>
            Lien linkedin: <input type="text" name="lien_linkedin" >
        </label>
    </br>
        <label>
            Biographie: <TEXTAREA name="biographie" rows=10 COLS=40></TEXTAREA>
        <label>
    </br>
        <label>
            Numéro de Téléphone: <input type="tel"  name="num_telephone" pattern="[0-9]{10}" required>
        </label>
    </br>
        <label>
            Photo de profil: <input type="file" name="photo_profil" accept="image/jpeg, image/png">
         </label>


    <input type="submit" value="Créer un compte! "/>
</form>




</body>

</html


