

<?php
$nom=strtoupper($_POST["nom"]);
$prenom=strtoupper($_POST["prenom"]);
$email=$_POST["email"];
$adresse_actuelle=strtoupper($_POST["adresse_actuelle"]);
$ville_de_residence=strtoupper($_POST["ville_de_residence"]);
$date_naissance=$_POST["date_naissance"];
$password=$_POST["password"];
$lien_linkedin=$_POST["lien_linkedin"];
$biographie=$_POST["biographie"];
$num_telephone=$_POST["num_telephone"];
$photo_profil=$_POST["photo_profil"];

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$req_test=$bdd->prepare("SELECT COUNT(*) from utilisateur where email='$email';");
$req_test->execute();
$data=$req_test->fetch();

if($data[0]!=0)
{
    header("Location: inscription.php");
    exit();
}
else
{

    $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("INSERT INTO utilisateur VALUES ('$email','$nom','$prenom','$adresse_actuelle','$ville_de_residence','$lien_linkedin','$date_naissance','$password','$biographie','$num_telephone','$photo_profil');");
    $req->execute();
}

?>