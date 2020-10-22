<?php
session_start();



$email=$_POST["email"];
$password=$_POST["password"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req_test=$bdd->prepare("SELECT COUNT(*) from utilisateur where email=? AND password=PASSWORD(?);");
$req_test->execute([$email,$password]);
$data=$req_test->fetch();

echo $data[0];

if($data[0]==0)
{
    header("Location: connexion.php");
    exit();
}
else{

    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT prenom,photo_profil from utilisateur where email='$email';");
    $data=$req->fetch();
    $_SESSION["prenom"]=$data[0];
    $_SESSION["is_connected"]=1;
    header("Location: ../home/home.php");
}


?>