<?php
session_start();
?>



<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="formation_cv.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>My Online CV - Créez votre CV en toute simplicité</title>
</head>


<body>

    <input type="checkbox" id="check">

    <header>

        <label for="check">
            <i class="fas fa-bars" id="sidebar_button"></i>
        </label>

        <div class="left_area">
            <h1> Créer mon CV </h1>
        </div>

    </header>

    <div class="side_bar">

        <center>
            <?php
                if(isset($_SESSION["prenom"]))
                {
                     echo '<img class="profile_photo" src="data:image/png;base64,'.base64_encode( $_SESSION['photo_profil'] ).'"/>';
                 }
            ?>
            <h2>

                <?php
                if(isset($_SESSION["prenom"]))
                {
                    echo $_SESSION["prenom"];
                }
                ?>

            </h2>
        </center>

                <a href="#"><i class="fas fa-graduation-cap"></i><span>Formations</span></a>

                <a href="#"><i class="fas fa-briefcase"></i><span>Expériences professionnelles</span></a>

                <a href="#"><i class="fas fa-hands-helping"></i><span>Expériences de bénévolat</span></a>

                <a href="#"><i class="fas fa-check"></i><span>Compétences</span></a>

                <a href="#"><i class="fas fa-language"></i><span>Langues</span></a>

                <a href="#"><i class="fas fa-heart"></i><span>Passions</span></a>

    </div>


















<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>





</body>
</html>
