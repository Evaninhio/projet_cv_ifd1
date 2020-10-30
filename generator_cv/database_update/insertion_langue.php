<?php
session_start();


$nom_langue=$_POST["nom_langue"];
$niveau_langue=$_POST["niveau_langue"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("INSERT INTO jointure_langue_utilisateur (nom_langue,email_utilisateur,niveau_langue) VALUES (?,?,?);");
$req->execute([$nom_langue,$_SESSION["email"],$niveau_langue]);

header("Location: ../langues.php");

?>