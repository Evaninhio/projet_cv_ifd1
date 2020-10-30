<?php
session_start();
$nom_loisir=strtoupper($_POST["nom_loisir"]);
$description_loisir=strtoupper($_POST["description_loisir"]);
$nom_type=$_POST["nom_type"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("INSERT INTO loisir (nom_loisir,email_user,description,nom_type) VALUES (?,?,?,?);");
$req->execute([$nom_loisir,$_SESSION["email"],$description_loisir,$nom_type]);

header("Location: ../passions.php");

?>
