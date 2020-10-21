<?php
$email=$_POST["email"];
$password=$_POST["password"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req_test=$bdd->prepare("SELECT COUNT(*) from utilisateur where email='$email';");
$req_test->execute();
$data=$req_test->fetch();

echo $data[0];

if($data[0]==0)
{
    header("Location: connexion.php");
    exit();
}
else{
    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT COUNT(*) from utilisateur where email='$email' AND password=PASSWORD('$password');");
    $data=$req->fetch();


//
//    if($data==1)
//    {
//        echo "test";
//    }
//    else
//    {
//        echo"error";
//        header("Location: connexion.php");
//        exit();
//    }

}


?>