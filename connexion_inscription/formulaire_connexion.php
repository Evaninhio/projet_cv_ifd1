<?php
$email=$_POST["email"];
$password=$_POST["password"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req_test=$bdd->prepare("SELECT * from utilisateur where email='$email';");
$req_test->execute();
$data=$req_test->fetch();



if($data)
{
    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT * from utilisateur where email='$email' AND password=PASSWORD('$password');");
    $data=$req->fetch();

    if($data)
    {
        echo"error";
        header("Location: connexion.php");
        exit();
    }
    else
    {
        echo "test";
    }

}
else{
    header("Location: connexion.php");
    //no email corresponding
    exit();
}

?>