<?php
session_start();

$niveau_competence=$_POST['niveau_competence'];
$competence=$_POST["competence"];


$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");



$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("INSERT INTO jointure_competence_utilisateur(email_utilisateur,competence,niveau_competence) VALUES ( ?, ?, ?);");
$req->execute([$_SESSION["email"],$competence,$niveau_competence]);

header("Location: ../competences.php");

?>
