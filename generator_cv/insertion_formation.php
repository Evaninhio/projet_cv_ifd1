<?php
session_start();
$date_de_debut=$_POST["date_de_debut"];
$date_de_fin=$_POST["date_de_fin"];
$intitule_diplome=$_POST["intitule_diplome"];
$description_formation=$_POST["description_formation"];

//pour ces deux variables on doit récuperer leur clés primaires

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

$id_ecole=$data[0];


$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("INSERT INTO formation (intitule_diplome, description_formation, date_de_debut, date_de_fin, type_diplome, email_utilisateur, id_ecole) VALUES (?, ?, ?, ?, ?, ?, ?);");
$req->execute([$intitule_diplome,$description_formation,$date_de_debut,$date_de_fin,$type_diplome,$_SESSION["email"],$id_ecole]);

header("Location: formations_cv.php");


?>












