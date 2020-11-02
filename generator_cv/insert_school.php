
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>My Online CV- ajout ecole </title>
    <link rel="stylesheet" href="insert_school.css">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    </head>


<body class="text_center">

<slider>
    <slide></slide>
    <slide></slide>
    <slide></slide>
    <slide></slide>
</slider>



<form class="form-signin" method="post" action="insert_school_bd.php">



    <h1 class="mb-3" id="title">Rensignez votre école </h1>

    <div class="error">
        <?php
        if (isset($_GET['error']))
        { echo "<p>Ecole déja présente</p>";
        }
        ?>
    </div>


    <!--formulaire inscription nouvel utilisateur-->
    <ul>
        <li>
            <label>
                Nom : <input type="text" name="nom" required/>
            </label>
            <br>
        </li>
        <li>
            <label>
                adresse : <input type="text" name="adresse" required/>
            </label>
            <br>
        </li>

        <li>
            <label>
                ville : <input type="text" name="ville" required/>
            </label>
            <br>
        </li>

        <li>
            <label>
                niveau d'étude : <input type="number" name="niveau" required min="1" max="10" />
            </label>
            <br>
        </li>
        <li>
            <label>
                logo de l'école: <input type="file" name="logo" accept="image/png" >
            </label>
        </li>
    </ul>

    <input type="submit" id="button_creation" value=" insérer l'école "/>
</form>


</body>

</html




