<?php
session_start();
$nom_loisir=strtoupper($_POST["nom_loisir"]);
$description_loisir=strtoupper($_POST["description_loisir"]);


$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("DELETE  from loisir where email_user=? and description=? and nom_loisir=?;");
$req->execute([$_SESSION["email"],$description_loisir,$nom_loisir]);

header("LOCATION:../passions.php");
?>

