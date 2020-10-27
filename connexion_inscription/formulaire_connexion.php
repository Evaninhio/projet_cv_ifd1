<?php


$email=$_POST["email"];
$password=$_POST["password"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req_test=$bdd->prepare("SELECT COUNT(*) from utilisateur where email=? AND password=PASSWORD(?);");
$req_test->execute([$email,$password]);
$data=$req_test->fetch();

if($data['COUNT(*)']==0)
{
    header("Location: connexion.php?error=1");
    exit();
}
else{

    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT prenom,nom,photo_profil from utilisateur where email=?;");
    $req->execute([$email]);
    $data=$req->fetch();
    session_start();

    $_SESSION["prenom"]=$data["prenom"];
    $_SESSION["nom"]=$data["nom"];
    $_SESSION["photo_profil"]=$data["photo_profil"];
//    header("Location: ../home/affichage_image.php");




       header("Location: ../home/home.php?connected");
}

?>