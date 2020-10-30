<?php
session_start();

$date_obtention=$_POST["date_obtention"];
$date_expiration=$_POST["date_expiration"];
$nom_qualification=$_POST["nom_qualification"];



$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT id_qualification from qualification where nom_qualification=?;");
$req->execute([$nom_qualification]);
$data=$req->fetch();

$id_qualification=$data["id_qualification"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("INSERT INTO `jointure_utilisateur_qualifications` (`email_utilisateur`, `id_qualification`, `date_obtention`, `date_expiration`) VALUES (?, ?, ?, ?);");

$req->execute([$_SESSION["email"],$id_qualification,$date_obtention,$date_expiration]);

header("Location: ../qualification.php");
?>


