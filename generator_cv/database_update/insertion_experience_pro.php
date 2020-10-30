<?php
session_start();

$date_debut=$_POST["date_debut"];
$date_fin=$_POST["date_fin"];
$description_experience=$_POST ["description_experience"];
$poste_occupe=$_POST["poste_occupe"];
$nom_entreprise=$_POST["nom_entreprise"];
$type_contrat=$_POST["type_contrat"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT id_entreprise from entreprise where nom_entreprise=?;");
$req->execute([$nom_entreprise]);
$data=$req->fetch();

$id_entreprise=$data[0];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("INSERT INTO experiences_professionnelles ( id_entreprise, email_utilisateur,date_debut, date_fin, description, poste_occupe, type_contrat) VALUES ( ?, ?, ?, ?,?, ?, ?);");
$req->execute([$id_entreprise,$_SESSION["email"],$date_debut,$date_fin,$description_experience,$poste_occupe,$type_contrat]);

header("Location: ../experience_pro.php");
?>