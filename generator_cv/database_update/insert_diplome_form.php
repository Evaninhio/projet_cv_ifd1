<?php
    $nom_type_diplome=strtoupper($_POST["nom_type_diplome"]);


    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT COUNT(*) from type_diplome where nom_type_diplome=?");
    $req->execute([$nom_type_diplome]);
    $data=$req->fetch();

    if ($data[0]==0){

        $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
        $req=$bdd->prepare("INSERT INTO type_diplome (nom_type_diplome) VALUES(?)");
        $req->execute([$nom_type_diplome]);
        header("Location:../formations_cv.php");
    }
    else
    {
        header("Location:insert_type_diplome.php");

    }
?>