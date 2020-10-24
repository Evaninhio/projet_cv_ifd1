<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Online CV - Connexion</title>
    <link href="signin.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
</head>

<body class="text-center">

<form class="form-signin" method="post" action="formulaire_connexion.php">

    <img class="mb-4" src="../images/téléchargement.png" alt="logo_site" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">Connectez vous !</h1>
    <h2 id="inscription">Nouveau sur Online CV ?</h2>
    <p>Créez votre compte <a href="inscription.php">ici</a></p>

    <div class="form-group">
        <label>Adresse Email
            <input type="email" class="form-control" placeholder="xxxxxxx@xxxxx.com" name="email" required>
        </label>
    </div>
    <div class="form-group">
        <label>Password
            <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
        </label>
    </div>



    <div class="checkbox mb-3">

        <div id="error">
        <?php
        if (isset($_GET['error']))
        { echo "<p>Erreur lors de la saisie de l'email ou du mot de passe</p>";
        }
        ?>
        </div>

        <label>
            <input type="checkbox" value="remember-me"> Se souvenir de moi
        </label>
    </div>
    <br>
    <button type="submit" class="btn btn-success">Connexion</button>
</form>
</body>
</html>

