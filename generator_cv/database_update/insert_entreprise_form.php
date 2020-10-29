<?php

$nom_entreprise=strtoupper($_POST["nom_entreprise"]);
$adresse_entreprise=strtoupper($_POST["adresse_entreprise"]);
$ville_entreprise=strtoupper($_POST["ville_entreprise"]);
$nombre_employes=$_POST["nombre_employes"];
$logo_entreprise=$_POST["logo_entreprise"];
$secteur_activite=$_POST["secteur_activite"];


$bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT COUNT(*) from entreprise where nom_entreprise=? AND adresse_entreprise=? AND ville_entreprise=?");
$req->execute([$nom_entreprise,$adresse_entreprise,$ville_entreprise]);
$data=$req->fetch();

if ($data[0]==0){


    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("INSERT INTO entreprise (nom_entreprise,adresse_entreprise,ville_entreprise,nombre_employes,logo_entreprise,secteur_activite) VALUES (?,?,?,?,?,?); ");
    $req->execute([$nom_entreprise,$adresse_entreprise,$ville_entreprise,$nombre_employes,$logo_entreprise,$secteur_activite]);
    header("Location: ../experience_pro.php");

}
else
{
    header("Location: insert_entreprise.php?error");

}

?>


