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

<form class="form-signin" method="post" action="insert_entreprise_form.php">


    <h1 class="mb-3" id="title">Aidez nous en créant une nouvelle entreprise </h1>

    <?php
    if (isset($_GET["error"])){
        echo"L'entreprise existe déja dans notre base de données";
    }
    ?>


    <!--formulaire inscription nouvelle entrerpise-->
    <ul>
        <li>
            <label>
                Nom de l'entreprise : <input type="text" name="nom_entreprise" required/>
            </label>
            <br>
        </li>


        <li>
            <label>
                Ville: <input type="text" name="ville_entreprise" required />
            </label>
            <br>

        </li>



        <li>
            <label>
                Adresse de l'entreprise : <input type="text" name="adresse_entreprise" required  />
            </label>
            <br>
        </li>

        <li>
            <label>
                Nombre d'employés: <input type="number" name="nombre_employes" min="1" required />
            </label>
            <br>
        </li>


        <li>
            <label>
                Logo de l'entreprise: <input type="file" name="logo_entreprise" accept="image/png" required>
            </label>
        </li>

        <li>
            <label>
                Secteur d'activité de l'entreprise:

                <select name="secteur_activite" class="form-control" required>
                    <option value=""> Choisissez un secteur d'activité</option>

                    <?php



                        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
                        $req_test=$bdd->prepare("SELECT nom_secteur_activite from secteur_activite;");
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

    <input type="submit" id="button_creation" value=" Créer mon entreprise !"/>
</form>


</body>

</html



