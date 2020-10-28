<?php
session_start();



$intitule_diplome=$_POST{"intitule_diplome"};
$nom_ecole=$_POST["id_ecole"];
$nom_type_diplome=$_POST["type_diplome"];


//récuperation de la clé primaire du type de diplome
$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT id_type_diplome from type_diplome where nom_type_diplome=?;");
$req->execute([$nom_type_diplome]);
$data=$req->fetch();

$type_diplome=$data[0];

//récupération de la clé primaire de l'école
$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT id_ecole from ecole where nom_ecole=?;");
$req->execute([$nom_ecole]);
$data=$req->fetch();

$nom_ecole=$data[0];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("DELETE from formation where intitule_diplome=? and type_diplome=? and id_ecole=? and email_utilisateur=?;");
$req->execute([$intitule_diplome,$type_diplome,$nom_ecole,$_SESSION["email"]]);


header("Location: formations_cv.php");
?>