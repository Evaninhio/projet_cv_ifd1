<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- INSCRIPTION </title>
    <link rel="stylesheet" href="insert_data_vcss.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/css/bootstrap.css">
</head>


<body class="text_center">

<form class="form-signin" method="post" action="insert_ecole_form.php">


    <h1 class="mb-3" id="title">Aidez nous en créant une nouvelle école </h1>

    <?php
    if (isset($_GET["error"])){
        echo"L'école existe déja";
    }
    ?>


    <!--formulaire inscription nouvelle école-->
    <ul>
        <li>
            <label>
                Nom de l'école : <input type="text" name="nom_ecole" required/>
            </label>
            <br>
        </li>


        <li>
            <label>
                Ville: <input type="text" name="ville_ecole" required />
            </label>
            <br>

        </li>



        <li>
            <label>
                Adresse de l'école : <input type="text" name="adresse_ecole" required  />
            </label>
            <br>
        </li>

        <li>
            <label>
                Niveau d'études associé: <input type="number" name="niveau_etudes" min="0" required />
            </label>
            <br>
        </li>


        <li>
            <label>
                Logo de l'école: <input type="file" name="logo_ecole" accept="image/png" required>
            </label>
        </li>
    </ul>

    <input type="submit" id="button_creation" value=" Créer mon école !"/>
</form>


</body>

</html



