<?php
session_start();
session_destroy();
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-4.5.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="resume_cv.css">
    <title>My Online CV - Relisez votre CV</title>
</head>


<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="navigation_bar">
    <a class="navbar-brand" href="#">
        <img src="../images/téléchargement.png" class="logo"> Résumé de votre CV
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link" href="#">
                    Formations <span class="sr-only"></span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#">Expériences profesionnelles <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Autres</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Compétences</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Langues</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Qualifications</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Expériences de bénévolat</a>
                </div>
            </li>
        </ul>
    </div>
</nav>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body>
</html>
