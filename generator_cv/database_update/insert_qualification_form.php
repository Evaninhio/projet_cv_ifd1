<?php
    $nom_qualification=strtoupper($_POST["nom_qualification"]);
    $organisme_delivrance=strtoupper($_POST["organisme_delivrance"]);
    $description=strtoupper($_POST["description"]);

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT COUNT(*) from qualification where nom_qualification=? AND organisme_delivrance?;");
    $req->execute([$nom_entreprise,$adresse_entreprise,$ville_entreprise]);
    $data=$req->fetch();

    if ($data[0]==0){
        $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
        $req=$bdd->prepare("INSERT INTO qualification (nom_qualification,organisme_delivrance,description) VALUES(?,?,?);");
        $req->execute([$nom_qualification,$organisme_delivrance,$description]);
        header("Location:../qualification.php");

    }
    else
    {
        header("Location:insert_qualification.php?error");
    }
?>