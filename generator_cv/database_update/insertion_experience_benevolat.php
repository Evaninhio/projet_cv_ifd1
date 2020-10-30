<?php
session_start();

$date_debut=$_POST["date_debut"];
$date_fin=$_POST["date_fin"];
$description=$_POST["description_experience"];
$titre_experience=$_POST["titre_experience"];
$nom_organisme=$_POST["nom_organisme"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("INSERT INTO experience_benevolat (titre_experience,description,nom_organisme,date_debut,date_fin,email_utilisateur) VALUES(?,?,?,?,?,?);");
$req->execute([$titre_experience,$description,$nom_organisme,$date_debut,$date_fin,$_SESSION["email"]]);
header("Location: ../experience_benevolat.php");