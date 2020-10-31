<?php
    session_start();

    $titre_experience=$_POST["titre_experience"];
    $nom_organisme=$_POST["nom_organisme"];

    $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req = $bdd->prepare("DELETE from experience_benevolat where titre_experience=? and nom_organisme=? and email_utilisateur=? ;");
    $req->execute([$titre_experience, $nom_organisme, $_SESSION["email"]]);

    header("Location:../experience_benevolat.php");

?>