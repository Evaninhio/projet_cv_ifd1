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

        .form-signin{
            width: 200%;
        }


    </style>
</head>


<body class="text_center">

<form class="form-signin" method="post" action="insert_competence_form.php">


    <h1 class="mb-3" id="title">Aidez nous en créant une nouvelle compétence </h1>

    <?php
    if (isset($_GET["error"])){
        echo"La compétence existe déja dans notre base de données";
    }
    ?>


    <!--formulaire inscription nouvelle compétence-->
    <ul>
        <li>
            <label>
                Nom de la compétence : <input type="text" name="nom_competence" required/>
            </label>
            <br>
        </li>

        <li>
            <label>
                Logo de la compétence: <input type="file" name="logo_competence" accept="image/png" required>
            </label>
        </li>

        <li>
            <label>
                Type de compétence:

                <select name="secteur_competence" class="form-control" required>
                    <option value=""> Choisissez un type de competence</option>

                    <?php



                    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                    $req_test=$bdd->prepare("SELECT nom_secteur from secteur_competence;");
                    $req_test->execute();
                    $data=$req_test->fetch();

                    while($data){
                        echo" <option value=\"$data[0]\">$data[0]</option> ";
                        $data=$req_test->fetch();
                    }

                    ?>
                </select>

            </label>
        </li>



    </ul>

    <input type="submit" id="button_creation" value=" Créer la compétence !"/>
</form>


</body>

</html


