<?php

$nom_ecole=strtoupper($_POST["nom_ecole"]);
$adresse_ecole=strtoupper($_POST["adresse_ecole"]);
$ville_ecole=strtoupper($_POST["ville_ecole"]);
$niveau_etudes=$_POST["niveau_etudes"];
$logo_ecole=$_POST["logo_ecole"];


$bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT COUNT(*) from ecole where nom_ecole=? ");
$req->execute([$nom_ecole]);
$data=$req->fetch();

if ($data[0]==0){


    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("INSERT INTO ecole (nom_ecole,adresse_ecole,ville_ecole,niveau_etudes,logo_ecole) VALUES (?,?,?,?,?); ");
    $req->execute([$nom_ecole,$adresse_ecole,$ville_ecole,$niveau_etudes,$logo_ecole]);
    header("Location: formations_cv.php");

}
else
{
    header("Location: insert_ecole.php?error");

}

?>


