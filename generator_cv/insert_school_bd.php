<?php


$nom=strtoupper($_POST["nom"]);
$adresse=strtoupper($_POST["adresse"]);
$ville=strtoupper($_POST["ville"]);
$niveau=$_POST["niveau"];
$logo=$_POST["logo"];



$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req_test=$bdd->prepare("SELECT  COUNT(*) from ecole where nom_ecole='$nom'");
$req_test->execute();
$data=$req_test->fetch();

if($data[0]!=0)
{
    header("Location: inscription.php?error=1");

    exit();
}
else
{

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req_test=$bdd->prepare("SELECT id_ecole FROM ecole where id_ecole=(Select max(id_ecole)from ecole)");
    $req_test->execute();
    $data=$req_test->fetch();
    $test=$data['id_ecole'];
    $test=$test+1;
 echo $test;
    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");

    $req=$bdd->prepare("INSERT INTO ecole VALUES ('$test','$nom','$adresse','$ville','$niveau','$logo')");
    $req->execute();





}

?>