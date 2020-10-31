<?php
    session_start();
    $nom_langue=$_POST["nom_langue"];

    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("DELETE from jointure_langue_utilisateur where email_utilisateur=? and nom_langue=?");
    $req->execute([$_SESSION["email"],$nom_langue]);

    header("LOCATION: ../langues.php");
?>