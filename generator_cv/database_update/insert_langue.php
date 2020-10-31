<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- INSCRIPTION </title>
    <link rel="stylesheet" href="insert_data_vcss.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/css/bootstrap.css">
    <style type="text/css">
        body{
            background-image: url("../../images/langues_2.jpg");
        }




    </style>
</head>


<body class="text_center">

<form class="form-signin" method="post" action="insert_langue_form.php">


    <h1 class="mb-3" id="title">Aidez nous en créant une nouvelle langue </h1>

    <?php
    if (isset($_GET["error"])){
        echo"La langue existe déja dans notre base de données";
    }
    ?>


    <!--formulaire inscription nouvelle langue-->
    <ul>
        <li>
            <label>
                Nom de la langue: <input type="text" name="nom_langue" required/>
            </label>
            <br>
        </li>
    </ul>

    <input type="submit" id="button_creation" value=" Créer la langue !"/>
</form>


</body>

</html


