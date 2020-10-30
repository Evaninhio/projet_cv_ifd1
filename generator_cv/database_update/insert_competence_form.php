<?php



$nom_competence=strtoupper($_POST["nom_competence"]);
$logo_competence=$_POST["logo_competence"];
$secteur_competence=$_POST["secteur_competence"];

$bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT COUNT(*) from competence where competence=?");
$req->execute([$nom_competence]);
$data=$req->fetch();


if($data[0]==0){

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("INSERT INTO competence (competence,secteur_competence,logo_competence) VALUES(?,?,?)");
    $req->execute([$nom_competence,$secteur_competence,$logo_competence]);
    header("LOCATION:../competences.php");
}
else
{
    header("LOCATION:insert_competence.php?error");
}


?>