<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- INSCRIPTION </title>
    <link rel="stylesheet" href="insert_data_vcss.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/css/bootstrap.css">
</head>


<body class="text_center">

<form class="form-signin" method="post" action="insert_diplome_form.php">


    <h1 class="mb-3" id="title">Aidez nous en créant une nouveau diplôme </h1>

    <?php
    if (isset($_GET["error"])){
        echo"Le diplome existe déja";
    }
    ?>


    <!--formulaire inscription nouveau diplome-->
    <ul>
        <li>
            <label>
                Nom du diplome : <input type="text" name="nom_type_diplome" placeholder="ex: DUT Informatique" required/>
            </label>
            <br>
        </li>



    <input type="submit" id="button_creation" value=" Créer le diplôme !"/>
</form>


</body>

</html



