<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- INSCRIPTION </title>
    <link rel="stylesheet" href="insert_data_vcss.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/css/bootstrap.css">
    <style type="text/css">
        body{
            background-image: url("../../images/113-1130485_cgi-in-canada-les-images-de-l-entreprise.jpg");

        }


    </style>
</head>


<body class="text_center">

<form class="form-signin" method="post" action="insert_qualification_form.php">


    <h1 class="mb-3" id="title">Aidez nous en créant une nouvelle qualification </h1>

    <?php
    if (isset($_GET["error"])){
        echo"La qualification existe déja dans notre base de données";
    }
    ?>


    <!--formulaire inscription nouvelle qualification-->
    <ul>
        <li>
            <label>
                Nom de la qualification : <input type="text" name="nom_qualification" required/>
            </label>
            <br>
        </li>


        <li>
            <label>
                Organisme de délivrance <input type="text" name="organisme_delivrance" required />
            </label>
            <br>

        </li>



        <li>
            <label>
                Description : <TEXTAREA class="form-control" name="description" maxlength="200"></TEXTAREA>
            </label>
            <br>
        </li>


    </ul>

    <input type="submit" id="button_creation" value=" Créer la qualification !"/>
</form>


</body>

</html>




