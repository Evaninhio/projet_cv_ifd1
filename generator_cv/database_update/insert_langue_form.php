<?php
$nom_langue=strtoupper($_POST["nom_langue"]);

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req=$bdd->prepare("SELECT COUNT(*) from langue where nom_langue=?;");
$req->execute([$nom_langue]);
$data=$req->fetch();

if($data[0]==0){
    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("INSERT INTO langue (nom_langue) VALUES(?)");
    $req->execute([$nom_langue]);
    header("LOCATION: ../langues.php");

}
else
{
    header("LOCATION: insert_langue.php?error");

}
?>




