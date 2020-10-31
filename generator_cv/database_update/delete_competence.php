<?php
    session_start();
    $nom_competence=$_POST["nom_competence"];
    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("DELETE from  jointure_competence_utilisateur where competence=? and email_utilisateur=?;");
    $req->execute([$nom_competence,$_SESSION["email"]]);
    header("Location: ../competences.php");
?>
