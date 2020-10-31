<?php

    session_start();

    $poste_occupe=$_POST["poste_occupe"];
    $nom_entreprise=$_POST["nom_entreprise"];
    $type_contrat=$_POST["type_contrat"];

    //récuperation de la clé primaire de l'entreprise
    $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT id_entreprise from entreprise where nom_entreprise=?;");
    $req->execute([$nom_entreprise]);
    $data = $req->fetch();

    $id_entreprise = $data[0];


    $bdd = new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req = $bdd->prepare("DELETE from experiences_professionnelles where id_entreprise=? and type_contrat=? and poste_occupe=? and email_utilisateur=? ;");
    $req->execute([$id_entreprise, $type_contrat, $poste_occupe, $_SESSION["email"]]);


    header("Location: ../experience_pro.php");
?>